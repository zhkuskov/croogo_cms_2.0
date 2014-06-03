<?php
App::uses('VideosAppController', 'Videos.Controller');
/**
 * Videoplayers Controller
 *
 * @property Videoplayer $Videoplayer
 * @property PaginatorComponent $Paginator
 */
class VideoplayersController extends VideosAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array(
        'Paginator',
        'Logging.Logging',
    );

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Videoplayer->recursive = 0;
		$this->set('videoplayers', $this->paginate());
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Videoplayer->create();
			if ($this->Videoplayer->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The videoplayer has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The videoplayer could not be saved. Please, try again.'), 'default', array('class' => 'error'));
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
		if (!$this->Videoplayer->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid videoplayer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Videoplayer->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The videoplayer has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The videoplayer could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Videoplayer.' . $this->Videoplayer->primaryKey => $id));
			$this->request->data = $this->Videoplayer->find('first', $options);
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
		$this->Videoplayer->id = $id;
		if (!$this->Videoplayer->exists()) {
			throw new NotFoundException(__d('croogo', 'Invalid videoplayer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Videoplayer->delete()) {
			$this->Session->setFlash(__d('croogo', 'Videoplayer deleted'), 'default', array('class' => 'success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__d('croogo', 'Videoplayer was not deleted'), 'default', array('class' => 'error'));
		$this->redirect(array('action' => 'index'));
	}
}
