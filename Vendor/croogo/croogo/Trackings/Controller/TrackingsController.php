<?php
App::uses('TrackingsAppController', 'Trackings.Controller');
/**
 * Trackings Controller
 *
 * @property Tracking $Tracking
 * @property PaginatorComponent $Paginator
 */
class TrackingsController extends TrackingsAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Logging.Logging');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Tracking->recursive = 0;
		$this->set('trackings', $this->paginate());
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Tracking->create();
			if ($this->Tracking->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The tracking has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The tracking could not be saved. Please, try again.'), 'default', array('class' => 'error'));
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
		if (!$this->Tracking->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid tracking'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tracking->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The tracking has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The tracking could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Tracking.' . $this->Tracking->primaryKey => $id));
			$this->request->data = $this->Tracking->find('first', $options);
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
		$this->Tracking->id = $id;
		if (!$this->Tracking->exists()) {
			throw new NotFoundException(__d('croogo', 'Invalid tracking'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tracking->delete()) {
			$this->Session->setFlash(__d('croogo', 'Tracking deleted'), 'default', array('class' => 'success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__d('croogo', 'Tracking was not deleted'), 'default', array('class' => 'error'));
		$this->redirect(array('action' => 'index'));
	}

    public function gettrackingcode($id = null) {

        $tracking = $this->Tracking->find('first', array(
            'conditions' => array('id' => $id)
        ));

        if (isset($this->params['requested'])) {
            return $tracking;
        }
        $this->set('title_for_layout', __d('trackings', 'Tracking %s', $tracking['Tracking']['type']));
        $this->set('tracking');
    }

}
