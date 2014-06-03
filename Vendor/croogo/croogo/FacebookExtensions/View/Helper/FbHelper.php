<?php

App::uses('AppHelper', 'View/Helper');

/**
 * Fb Helper
 * 
 * helps to get the right markup for several facebook items
 *
 * @category Helper
 * @package  CakeCMS.FacebookExtensions.View.Helper
 * @version  1.0
 * @author   Björn Wahle <bjoern.wahlet@sonymusicexternal.com>
 */
class FbHelper extends AppHelper {
    
    protected $options = array(
        "post-class"             => "fb-post",
    );

    public function post($post, $options = array()) {
        $type = $post['type'];
        switch($type) {
            case "link":
                $html = $this->_link($post, $options);
                break;
            case "status":
                $html = $this->_status($post, $options);
                break;
            case "photo":
                $html = $this->_photo($post, $options);
                break;
            case "video":
                $html = $this->_video($post, $options);
                break;
            default:
                $html = "";
                break;
        }
        return $html;
    }
    
    public function posts($posts = array(), $options = array()) {
        $options = array_merge_recursive( $options, $this->options );
        $html = "";
        foreach($posts as $post) {
            $html .= $this->post($post, $options);
        }
        return $html;
    }
    
    protected function _link($post, $options = array()) {
        $html = "<div class='".$options['post-class']." fb-link'>
                    <span>". $this->_shortText($post['message']) ."</span>
                    <a target='_blank' href='".$post['link']."'>Link</a>
                 </div>";
        return $html;
    }
    
    protected function _status($post, $options = array()) {
        if(!empty($post['message'])) {
           $message = $this->_shortText($post['message']);
        } else {
           $message = "";
        }
        $html = "<div class='".$options['post-class']." fb-status'>
                    <span>". $message ."</span>
                 </div>";
        return $html;
    }
    
    protected function _photo($post, $options = array()) {
        if(!empty($post['message'])) {
           $message = $this->_shortText($post['message']);
        } else {
           $message = "";
        }
        $html = "<div class='".$options['post-class']." fb-photo'>
                    <img class='fb-feed-picture' src='". $post['picture']. "'/>
                    <span>". $message ."</span>
                 </div>";
        return $html;
    }
    
    protected function _video($post, $options = array()) {
        $html = "<div class='".$options['post-class']." fb-video'>

                 </div>";
        return $html;
    }
    
    protected function _shortText($text, $length = 100) {
        if(strlen($text) > $length) {
            $text = substr($text, 0, $length)."... <a href='#'>mehr anzeigen</a>";
        }
        return $text;
    }
    
}

