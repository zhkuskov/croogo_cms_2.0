<?php
App::uses('MusicplayerAppController', 'Musicplayer.Controller');
/**
 * Musicplayers Controller
 *
 * @property Musicplayer $Musicplayer
 * @property PaginatorComponent $Paginator
 */
class MusicplayersController extends MusicplayerAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Logging.Logging', 'Paginator');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Musicplayer->recursive = 0;
		$this->set('musicplayers', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Musicplayer->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid musicplayer'));
		}
		$options = array('conditions' => array('Musicplayer.' . $this->Musicplayer->primaryKey => $id));
		$this->set('musicplayer', $this->Musicplayer->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Musicplayer->create();
			if ($this->Musicplayer->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The musicplayer has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The musicplayer could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		$playlists = $this->Musicplayer->Playlist->find('list');
		$this->set(compact('playlists'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Musicplayer->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid musicplayer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Musicplayer->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The musicplayer has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The musicplayer could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Musicplayer.' . $this->Musicplayer->primaryKey => $id));
			$this->request->data = $this->Musicplayer->find('first', $options);
		}
		$playlists = $this->Musicplayer->Playlist->find('list');
		$this->set(compact('playlists'));
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
		$this->Musicplayer->id = $id;
		if (!$this->Musicplayer->exists()) {
			throw new NotFoundException(__d('croogo', 'Invalid musicplayer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Musicplayer->delete()) {
			$this->Session->setFlash(__d('croogo', 'Musicplayer deleted'), 'default', array('class' => 'success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__d('croogo', 'Musicplayer was not deleted'), 'default', array('class' => 'error'));
		$this->redirect(array('action' => 'index'));
	}
        
        /**
         * get a musicplayer with a specific id for musicplayer element
         * @param int $id
         * @return musicplayer
         */
        public function get_musicplayer($id = null) {
                if(!empty($this->request->params['requested'])) {
                    if($id != null) {
                        $options = array('conditions' => array('Musicplayer.' . $this->Musicplayer->primaryKey => $id), 'contain' => array(
                               'Playlist' => array('Track' => array(
                                   'order' => 'Track.number ASC'
                               ))
                        ));
                        return $this->Musicplayer->find('first', $options);
                    }
                }
        }
}