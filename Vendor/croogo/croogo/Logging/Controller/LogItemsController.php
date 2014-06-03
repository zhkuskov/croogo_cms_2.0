<?php
App::uses('LoggingAppController', 'Logging.Controller');
/**
 * LogItems Controller
 *
 * @property LogItem $LogItem
 * @property PaginatorComponent $Paginator
 */
class LogItemsController extends LoggingAppController {

/**
 * Components
 *
 * @var array
 */ 
        public $components = array(
		'Search.Prg' => array(
			'presetForm' => array(
				'paramType' => 'querystring',
			),
			'commonProcess' => array(
				'paramType' => 'querystring',
				'filterEmpty' => true,
			),
		),
                'RequestHandler',
                'Paginator',
	);

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->LogItem->recursive = 0;
		$this->set('logItems', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->LogItem->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid log item'));
		}
		$options = array('conditions' => array('LogItem.' . $this->LogItem->primaryKey => $id));
		$this->set('logItem', $this->LogItem->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->LogItem->create();
			if ($this->LogItem->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The log item has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The log item could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->LogItem->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid log item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->LogItem->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The log item has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The log item could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('LogItem.' . $this->LogItem->primaryKey => $id));
			$this->request->data = $this->LogItem->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->LogItem->id = $id;
		if (!$this->LogItem->exists()) {
			throw new NotFoundException(__d('croogo', 'Invalid log item'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->LogItem->delete()) {
			$this->Session->setFlash(__d('croogo', 'Log item deleted'), 'default', array('class' => 'success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__d('croogo', 'Log item was not deleted'), 'default', array('class' => 'error'));
		$this->redirect(array('action' => 'index'));
	}
        
        
        
        public function admin_get_log_items_by_model($modelAlias, $modelId) {
            $this->LogItem->recursive = 1;
            $this->paginate['conditions'] = array(
                                            'LogItem.model' => $modelAlias, 
                                            'LogItem.model_item_id' => $modelId
                                        );
            $this->paginate['order'] = array(
                                        'LogItem.created' => "desc"
            );
            $this->paginate['limit'] = 20;
            $this->Paginator->settings = $this->paginate;
            if(!empty($this->request->params['requested'])) {
                return array(
                        'logItems'  => $this->paginate('LogItem'),
                        'paging'    => $this->params['paging']
                );
            } else if($this->request->is('ajax')) {
                $this->set('logItems', $this->paginate('LogItem'));
                $this->set('modelAlias', $modelAlias);
                $this->set('modelId', $modelId);
                $this->layout = 'ajax';
                $this->render();
            }
        }
        
        public function admin_get_user_activity($userId) {            
            $this->LogItem->recursive = 1;
            $this->paginate['conditions'] = array(
                                        'LogItem.user_id' => $userId
                                    );
            $this->paginate['order'] = array(
                                        'LogItem.created' => "desc"
            );
            $this->paginate['limit'] = 20;
            $this->Paginator->settings = $this->paginate;
            if(!empty($this->request->params['requested'])) {
                return array(
                        'logItems'  => $this->paginate('LogItem'),
                        'paging'    => $this->params['paging']
                );
            } else if($this->request->is('ajax')) {
                $this->set('logItems', $this->paginate('LogItem'));
                $this->set('userId', $userId);
                $this->layout = 'ajax';
                $this->render();
            }
        }
}