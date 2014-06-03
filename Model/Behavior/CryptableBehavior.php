<?php

class CryptableBehavior extends ModelBehavior {
	var $settings = array();
 
	function setup(Model $model, $settings = array()) {
		if (!isset($this->settings[$model->alias])) {
			$this->settings[$model->alias] = array(
				'fields' => array()
			);
		}
		$this->settings[$model->alias] = array_merge($this->settings[$model->alias], $settings);
	}
 
	function beforeFind(Model $model, $queryData) {
		foreach ($this->settings[$model->alias]['fields'] AS $field) {
			if (isset($queryData['conditions'][$model->alias.'.'.$field])) {
				$queryData['conditions'][$model->alias.'.'.$field] = $this->encrypt($queryData['conditions'][$model->alias.'.'.$field]);
			}
		}
		return $queryData;
	}
 
	function afterFind(Model $model, $results, $primary = false) {
		foreach ($this->settings[$model->alias]['fields'] AS $field) {
			if ($primary) {
				foreach ($results AS $key => $value) {
					if (isset($value[$model->alias][$field])) {
						$results[$key][$model->alias][$field] = $this->decrypt($value[$model->alias][$field]);
					}
				}
			} else {
				if (isset($results[$field])) {
					$results[$field] = $this->decrypt($results[$field]);
				}
			}
		}
 
		return $results;
	}
 
	function beforeSave(Model $model, $options = array()) {
		foreach ($this->settings[$model->alias]['fields'] AS $field) {
			if (isset($model->data[$model->alias][$field])) {
				//$model->data[$model->alias]['cleartext_'.$field] = $model->data[$model->alias][$field];
				$model->data[$model->alias][$field] = $this->encrypt($model->data[$model->alias][$field]);
			}
		}
		return true;
	}
 
	public function encrypt($data) {
		if ($data !== '') {
			return Security::rijndael($data, Configure::read('Security.rijndaelKey'), 'encrypt');
		} else {
			return '';
		}
	}
 
	public function decrypt($data) {
		if ($data != '') {
			return Security::rijndael($data, Configure::read('Security.rijndaelKey'), 'decrypt');
		} else {
			return '';
		}
	}
     
}


?>

