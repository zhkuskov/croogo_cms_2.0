<?php
App::uses('MusicplayerAppController', 'Musicplayer.Controller');
/**
 * Playlists Controller
 *
 * @property Playlist $Playlist
 * @property PaginatorComponent $Paginator
 * @property Logging.LoggingComponent $Logging.Logging
 */
class PlaylistsController extends MusicplayerAppController {

    
        public $helpers = array('Musicplayer.Track');
        
        public $components = array(
                'Paginator',
		'Search.Prg' => array(
			'presetForm' => array(
				'paramType' => 'querystring',
			),
			'commonProcess' => array(
				'paramType' => 'querystring',
			),
		),
                //'Logging.Logging',
	);
        
/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array('Musicplayer.Playlist');
        
        
        public function beforeFilter() {
            if (isset($this->request->params['admin'])) {
                if (!empty($this->request->data['Track'])) {
                    $unlockedFields = array();
                    foreach ($this->request->data['Track'] as $uuid => $fields) {
                            if(empty($fields['number'])) {
                                unset($this->request->data['Track'][$uuid]);
                            }
                            foreach ($fields as $field => $vals) {
                                    $unlockedFields[] = 'Track.' . $uuid . '.' . $field;
                            }
                    }
                    $this->Security->unlockedFields += $unlockedFields;
                }
            }
            parent::beforeFilter();
        }

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Playlist->recursive = 1;
		$this->set('playlists', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Playlist->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid playlist'));
		}
		$options = array('conditions' => array('Playlist.' . $this->Playlist->primaryKey => $id));
		$this->set('playlist', $this->Playlist->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Playlist->create();
			if ($this->Playlist->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The playlist has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The playlist could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
	}
        
        public function admin_add_track() {
                $this->layout = 'ajax';
        }

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
                $this->Playlist->recursive= -1;
		if (!$this->Playlist->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid playlist'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Playlist->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The playlist has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The playlist could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
                        $options = array('conditions' => array('Playlist.' . $this->Playlist->primaryKey => $id), 'contain' => array('Track' => array('order' => 'Track.number ASC')));
                        $this->request->data = $this->Playlist->find('first', $options);
		}
                $this->set('title_for_layout', __d('croogo', 'Edit %s: %s',$this->Playlist->alias, $this->request->data['Playlist']['name']));
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
		$this->Playlist->id = $id;
		if (!$this->Playlist->exists()) {
			throw new NotFoundException(__d('croogo', 'Invalid playlist'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Playlist->delete()) {
			$this->Session->setFlash(__d('croogo', 'Playlist deleted'), 'default', array('class' => 'success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__d('croogo', 'Playlist was not deleted'), 'default', array('class' => 'error'));
		$this->redirect(array('action' => 'index'));
	}
        
/**
 * Admin delete trac
 *
 * @param integer $id
 * @return void
 * @access public
 */
	public function admin_delete_track($id = null) {
		$success = false;
		if ($id != null && $this->Playlist->Track->delete($id)) {
			$success = true;
		} else {
                    if (!$this->Playlist->Track->exists($id)) {
                            $success = true;
                    }
		}

		$this->set(compact('success'));
	}
        
        public function get_tracks($id = null) {
            $this->Playlist->recursive = 1;
            if(!empty($this->request->params['requested'])) {
                $playlist = $this->Playlist->find('tracks', array(
			'id' => $id
		));
                return $playlist;
            }
        }
}
