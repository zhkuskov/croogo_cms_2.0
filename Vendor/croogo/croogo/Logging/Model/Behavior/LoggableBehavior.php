<?php

App::uses('AuthComponent', 'Controller/Component');

class LoggableBehavior extends ModelBehavior {
    var $LogItem;
    var $LogItemChange;
    var $settings;
    var $activeUser;
    var $oldModel = array();
    var $newModel = array();
    
    
    public function setup(\Model $Model, $settings = array()) {
        App::import("Logging.Model", "LogItem");
        App::import("Logging.Model", "LogItemChange");
        $this->LogItem = new LogItem();
        $this->LogItemChange = new LogItemChange();
        
        $this->settings[$Model->alias] = array(
                'hashed' => array(),
                'encrypted' => array(),
                'except' => array('modified', 'created', 'updated'),
                'habtm' => count( $Model->hasAndBelongsToMany ) > 0
                            ? array_keys( $Model->hasAndBelongsToMany )
                            : array(),
        );

        $this->settings[$Model->alias] = array_merge_recursive($this->settings[$Model->alias], $settings);
        
        
        $this->activeUser = AuthComponent::user();
        
        foreach( $this->settings[$Model->alias]['habtm'] as $index => $model_name ) {
            if( !array_key_exists( $model_name, $Model->hasAndBelongsToMany ) || ( is_array($Model->$model_name->actsAs) && array_search( 'Loggable', $Model->$model_name->actsAs ) === true ) ) {
              unset( $this->settings[$Model->alias]['habtm'][$index] );
            }
          }
    }
    
    
    public function beforeSave(\Model $Model, $options = array()) {
        parent::beforeSave($Model, $options);
        if( !empty( $Model->id ) ) {
            $Model->recursive = 1;
            $this->oldModel = $Model->findById($Model->id);
        } else {
            $this->oldModel = array();
        }
        return true;
    }
    
    public function afterSave(\Model $Model, $created, $options = array()) {
        parent::afterSave($Model, $options);
        $action = $created ? "create" : "update";
        
        $Model->recursive = 1;
        $this->newModel = $Model->findById($Model->id);

        $this->_logChanges($Model, $this->_getChangesToLog($Model, $action, $this->newModel, $this->oldModel), $action);
    }
    
    public function beforeDelete(\Model $Model, $cascade = true) {
        $Model->recursive = 1;
        $this->oldModel = $Model->findById($Model->id);

        return true;
    }
    
    public function afterDelete(\Model $Model) {
        $action = "delete";
        $this->_logChanges($Model, $this->_getChangesToLog($Model, $action, array(), $this->oldModel), $action);
    }
    
    protected function _getChangesToLog(\Model $Model , $action , $newModel, $oldModel ) {        
        $changes = array();
        if($action != "update") {
            return $changes;
        }
        foreach($newModel[$Model->alias] as $field => $value):
            // check if field needs to be logged
            if(($Model->hasMethod( 'isVirtualField' ) && $Model->isVirtualField( $field )) || in_array($field, $this->settings[$Model->alias]['except'])) {
                continue;
            }
            // if action is update and field is encrypted it has to be decrypted to compare the values
            if(in_array($field, $this->settings[$Model->alias]['encrypted'])) {
                $oldModel[$Model->alias][$field] = Security::rijndael($oldModel[$Model->alias][$field], Configure::read('Security.rijndaelKey'), "decrypt");
                $newModel[$Model->alias][$field] = Security::rijndael($newModel[$Model->alias][$field], Configure::read('Security.rijndaelKey'), "decrypt");
            } 
            // if action ist create or update, we don't need to check for updates
            if($newModel[$Model->alias][$field] != $oldModel[$Model->alias][$field]) {
                $changes[$field] = array();
                $changes[$field]['old_value']   = null;
                $changes[$field]['new_value']   = null;
                $changes[$field]['encrypted']   = false;
                $changes[$field]['hashed']      = false;
                
                // if field is hashed
                if(in_array($field, $this->settings[$Model->alias]['hashed'])) {
                    $changes[$field]['hashed'] = true;
                }
                // encrypt values if needed
                if(in_array($field, $this->settings[$Model->alias]['encrypted'])) {
                    $changes[$field]['old_value'] = Security::rijndael($oldModel[$Model->alias][$field], Configure::read('Security.rijndaelKey'), "encrypt");
                    $changes[$field]['new_value'] = Security::rijndael($newModel[$Model->alias][$field], Configure::read('Security.rijndaelKey'), "encrypt");
                    $changes[$field]['encrypted'] = true;
                } else {
                    $changes[$field]['old_value'] =  $oldModel[$Model->alias][$field];
                    $changes[$field]['new_value'] =  $newModel[$Model->alias][$field];
                }   
            }
        endforeach;
        
        // check for new related items  (has-and-belongs-to-many)
        foreach($this->settings[$Model->alias]['habtm'] as $relatedModelName):
            if(array_key_exists( $relatedModelName, $Model->hasAndBelongsToMany)) {
                $relatedModelChanges = $this->_getRelatedChanges($relatedModelName, $this->newModel, $this->oldModel);
                if($relatedModelChanges != null) {
                    $changes[$relatedModelName] = $relatedModelChanges;
                }
            }
        endforeach;
        return $changes;
    }
       
    protected function _getRelatedChanges($relatedModelName, $newModel, $oldModel) {
        if(!empty($newModel) && isset($newModel[$relatedModelName]) && !empty($newModel[$relatedModelName])) {
            $newRelatedModel = $newModel[$relatedModelName];
            $newRelatedModelIds = $this->_simplifyRelatedModels($newRelatedModel);
        } else {
            $newRelatedModelIds = "";
        }
        
        if(!empty($oldModel) && isset($oldModel[$relatedModelName]) && !empty($oldModel[$relatedModelName])) {
            $oldRelatedModel = $oldModel[$relatedModelName];
            $oldRelatedModelIds = $this->_simplifyRelatedModels($oldRelatedModel);
        } else {
            $oldRelatedModelIds = "";
        }
        
        if($newRelatedModelIds != $oldRelatedModelIds) {
            return array(
                'old_value' => $oldRelatedModelIds,
                'new_value' => $newRelatedModelIds,
                'encrypted' => false,
                'hashed'    => false
            );
        } else {
            return null;
        }
    }
    
    protected function _logChanges($Model, $changes, $action) {
        /**
         * if the update didn't change anything, return true and don't create log
         */
        if($action == "update" && empty($changes)) {
            return true;
        }          
        /**
         * create log item
         */
        $this->LogItem->create(array(
                "model"                 =>  $Model->alias,
                "model_item_id"         =>  $Model->id,
                "user_id"               =>  $this->activeUser['id'],
                "json_encoded_item"     =>  json_encode($this->newModel),
                "action"                =>  $action,
        ));
        $this->LogItem->save();
        
        if($action != "update") {
            return true;
        }
        
        /**
         * save log item changes
         */
        foreach($changes as $field => $array):
            $params = array(
                "log_item_id"   =>  $this->LogItem->id,
                "field"         =>  $field,
                "old_value"     =>  $array['old_value'],
                "new_value"     =>  $array['new_value'],
                "encrypted"     =>  $array['encrypted'],
                "hashed"        =>  $array['hashed']
            );
            $this->LogItemChange->create($params);
            $this->LogItemChange->save();
        endforeach;
    }
     
    protected function _simplifyRelatedModels($models) {
        
        $related_ids = array_values(Set::combine(
          $models,
          '{n}.id',
          '{n}.id'
        ));
        sort( $related_ids );
        
        return implode(",",$related_ids);
    } 
}