<?php
App::uses('FacebookExtensionsAppController', 'FacebookExtensions.Controller');
/**
 * FacebookFeeds Controller
 *
 * @property FacebookFeed $FacebookFeed
 * @property PaginatorComponent $Paginator
 * @property Facebook.ApiComponent $Facebook.Api
 */
class FacebookFeedsController extends FacebookExtensionsAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Facebook.Api', 'Logging.Logging');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->FacebookFeed->recursive = 0;
		$this->set('facebookFeeds', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->FacebookFeed->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid facebook feed'));
		}
		$options = array('conditions' => array('FacebookFeed.' . $this->FacebookFeed->primaryKey => $id));
                $this->FacebookFeed->recursive = 1;
                $feedItem = $this->FacebookFeed->find('first', $options);
		$this->set('facebookFeed', $feedItem);
                $feed = $this->Api->FB->api('/'.$feedItem['FacebookFeed']['page'].'/feed');
                $this->set('posts', $feed['data']);
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->FacebookFeed->create();
			if ($this->FacebookFeed->save($this->request->data)) {
				$this->flash(__d('croogo', 'Facebookfeed saved.'), array('action' => 'index'));
			} else {
			}
		}
		$facebookPostTypes = $this->FacebookFeed->FacebookPostType->find('list');
		$this->set(compact('facebookPostTypes'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->FacebookFeed->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid facebook feed'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FacebookFeed->save($this->request->data)) {
				$this->flash(__d('croogo', 'The facebook feed has been saved.'), array('action' => 'index'));
			} else {
			}
		} else {
			$options = array('conditions' => array('FacebookFeed.' . $this->FacebookFeed->primaryKey => $id));
			$this->request->data = $this->FacebookFeed->find('first', $options);
		}
		$facebookPostTypes = $this->FacebookFeed->FacebookPostType->find('list');
		$this->set(compact('facebookPostTypes'));
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
		$this->FacebookFeed->id = $id;
		if (!$this->FacebookFeed->exists()) {
			throw new NotFoundException(__d('croogo', 'Invalid facebook feed'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FacebookFeed->delete()) {
			$this->flash(__d('croogo', 'Facebook feed deleted'), array('action' => 'index'));
		}
		$this->flash(__d('croogo', 'Facebook feed was not deleted'), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
        
        public function get_feed($id = null) {
                if(!empty($this->request->params['requested'])) {
                    $this->FacebookFeed->recursive = 1;
                    $feedItem = $this->FacebookFeed->findById($id);
                    $feed = $this->Api->FB->api('/'.$feedItem['FacebookFeed']['page'].'/feed');
                    $feed = $this->_filterFeed($feed['data'], $feedItem);
                    return array(
                        'feed'  => $feed
                    );
                }
        }
        
        public function admin_show_post($feedId, $postId) {
                $this->autoRender = false;
                $item = $this->FacebookFeed->FacebookPost->find('first', array('conditions' => array('facebook_id'=>$postId, 'facebook_feed_id' => $feedId)));
                if($item) {
                    $item['FacebookPost']['hidden'] = false;
                    $this->FacebookFeed->FacebookPost->save($item);
                }
                $this->redirect(array('action' => 'view', 'admin' => true, $feedId));
        }
        
        public function admin_hide_post($feedId, $postId) {
                $this->autoRender = false;
                if($this->FacebookFeed->FacebookPost->find('first', array('conditions' => array('FacebookPost.facebook_id' => $postId))) == null) {
                    $params = array(
                        'facebook_id'       => $postId,
                        'facebook_feed_id'  => $feedId,
                        'hidden'            => true
                    );
                    $this->FacebookFeed->FacebookPost->create($params);
                    $this->FacebookFeed->FacebookPost->save();
                }
                $this->redirect(array('action' => 'view', 'admin' => true, $feedId));
        }
        
        protected function _filterFeed($feed, $feedItem) {
                $facebookPostTypes = array_column($feedItem['FacebookPostType'], 'title');
                $hiddenPosts = array();
                foreach($feedItem['FacebookPost'] as $facebookPost) {
                    if($facebookPost['hidden']) {
                        $hiddenPosts[] = $facebookPost['facebook_id'];
                    }
                }
                foreach($feed as $key => &$post) {
                    if(!in_array($post['type'], $facebookPostTypes)) {
                        unset($feed[$key]);
                        continue;
                    }
                    if(in_array($post['id'], $hiddenPosts)) {
                        unset($feed[$key]);
                        continue;
                    }
                    
                    if($feedItem['FacebookFeed']['only_own_content']) {
                        if(array_key_exists('from', $post)) {
                            $post_id = explode("_" , $post['id']);
                            if($post['from']['id'] != $post_id[0]) {
                                unset($feed[$key]);
                            }
                        }
                    }
                }
                return $feed;
        }
}
