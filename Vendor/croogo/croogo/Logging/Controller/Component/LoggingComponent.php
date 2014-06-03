<?php

App::uses('Component', 'Controller');

/**
 * LoggingComponent
 * @author Björn Wahle <bjoern.wahle@sonymusicexternal.com>
 */
class LoggingComponent extends Component {

/**
 * _controller
 *
 * @var Controller
 */
	protected $_controller = null;
    
        
        public function startup(Controller $controller) {
            if(key_exists('Logging.Loggable', $controller->{$controller->modelClass}->actsAs) || in_array('Logging.Loggable', $controller->{$controller->modelClass}->actsAs)) {
                $this->controller = $controller;
                
                if($this->controller->request->params['action'] == "admin_edit") {

                    $this->_addHistoryTab();

                    if($this->controller->name == "Users") {
                        $this->_addUserActivityTab();
                    }
                }
            } else {
                throw new CakeException(__d('croogo', 'LoggableBehavior has to be attached to the model to use this component!'));
            }
            
        }
        
        protected function _addHistoryTab() {
            $title = __d('croogo', 'History');
            $element = 'Logging.admin/history';
            $options= array(
                "data" => array(
                    'modelAlias' => $this->controller->modelClass,
                    'modelId'    => $this->controller->request->params['pass'][0]
                )
            );
            Croogo::hookAdminTab($this->controller->name.'/admin_edit', $title, $element, $options);
        }
        
        protected function _addUserActivityTab() {
            $title = __d('croogo', 'User Activity');
            $element = 'Logging.admin/user_activity';
            $options= array(
                "data" => array(
                    'userId'    => $this->controller->request->params['pass'][0]
                )
            );
            Croogo::hookAdminTab($this->controller->name.'/admin_edit', $title, $element, $options);
        }
}

