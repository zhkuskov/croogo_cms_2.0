<?php
App::uses('FileManagerAppController', 'FileManager.Controller');
/**
 * Pdfs Controller
 * @category FileManager.Controller
 * @property Pdf $Pdf
 * @property PaginatorComponent $Paginator
 * @property Logging.LoggingComponent $Logging.Logging
 */
class PdfsController extends FileManagerAppController {

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
    public $uses = array('PdfViewer.Pdf');

/**
 * Helpers used by the Controller
 *
 * @var array
 * @access public
 */
    public $helpers = array('FileManager.FileManager', 'Text', 'Croogo.Image');

/**
 * Provides backwards compatibility access to the deprecated properties
 */
    public function __get($name) {
        switch ($name) {
            case 'type':
            case 'uploadsDir':
                return $this->Pdf->{$name};
                break;
            default:
                return parent::__get($name);
        }
    }

/**
 * Provides backwards compatibility access for settings values to deprecated
 * properties
 */
    public function __set($name, $val) {
        switch ($name) {
            case 'type':
            case 'uploadsDir':
                return $this->Pdf->{$name} = $val;
                break;
            default:
                return parent::__set($name, $val);
        }
    }

/**
 * Components
 *
 * @var array
 */
	public $components = array(
        'Paginator',
        'Logging.Logging',
        'Security',
    );

/**
 * Before executing controller actions
 *
 * @return void
 * @access public
 */
    public function beforeFilter() {
        parent::beforeFilter();

        // Comment, Category, Tag not needed
        $this->Pdf->unbindModel(array(
                'hasMany' => array('Comment'),
                'hasAndBelongsToMany' => array('Category', 'Tag'))
        );

        $this->Pdf->type = $this->type;
        $this->Pdf->Behaviors->attach('Tree', array(
            'scope' => array(
                $this->Pdf->alias . '.type' => $this->type,
            )
        ));
        $this->set('type', $this->Pdf->type);

        if ($this->request->action == 'admin_add') {
            $this->Security->csrfCheck = false;
        }
    }
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Pdf->recursive = 0;
		$this->set('pdfs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Pdf->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid pdf'));
		}
		$options = array('conditions' => array('Pdf.' . $this->Pdf->primaryKey => $id));
		$this->set('pdf', $this->Pdf->find('first', $options));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Pdf->recursive = 0;
		$this->set('pdfs', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Pdf->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid pdf'));
		}
		$options = array('conditions' => array('Pdf.' . $this->Pdf->primaryKey => $id));
		$this->set('pdf', $this->Pdf->find('first', $options));
	}

/**
 * Admin add
 *
 * @return void
 * @access public
 */
	public function admin_add() {
        $this->set('title_for_layout', __d('croogo', 'Add Pdf'));

        if (isset($this->request->params['named']['editor'])) {
            $this->layout = 'admin_popup';
        }

        if ($this->request->is('post') || !empty($this->request->data)) {

            if (empty($this->data['Pdf'])) {
                $this->Pdf->invalidate('file', __d('croogo', 'Upload failed. Please ensure size does not exceed the server limit.'));
                return;
            }

            $this->Pdf->create();
            if ($this->Pdf->save($this->request->data)) {

                $this->Session->setFlash(__d('croogo', 'The Pdf has been saved'), 'default', array('class' => 'success'));

                if (isset($this->request->params['named']['editor'])) {
                    $this->redirect(array('action' => 'browse'));
                } else {
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash(__d('croogo', 'The Pdf could not be saved. Please, try again.'), 'default', array('class' => 'error'));
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
		if (!$this->Pdf->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid pdf'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Pdf->save($this->request->data)) {
				$this->Session->setFlash(__d('croogo', 'The pdf has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('croogo', 'The pdf could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Pdf.' . $this->Pdf->primaryKey => $id));
			$this->request->data = $this->Pdf->find('first', $options);
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
		$this->Pdf->id = $id;
		if (!$this->Pdf->exists()) {
			throw new NotFoundException(__d('croogo', 'Invalid pdf'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Pdf->delete()) {
			$this->Session->setFlash(__d('croogo', 'Pdf deleted'), 'default', array('class' => 'success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__d('croogo', 'Pdf was not deleted'), 'default', array('class' => 'error'));
		$this->redirect(array('action' => 'index'));
	}}
