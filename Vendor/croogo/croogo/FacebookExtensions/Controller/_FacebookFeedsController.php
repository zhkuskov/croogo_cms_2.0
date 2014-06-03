<?php
App::uses('FacebookExtensionsAppController', 'FacebookExtensions.Controller');
App::import('Lib', 'Facebook.FB');

class FacebookFeedsController extends FacebookExtensionsAppController {
    
    public $components = array("Facebook.Api");
    
    public function index () {
        $this->set('myFeed', $this->Api->FB->api("/NikP.Offiziell/feed"));
    }

    public function _getFeed($page_id) {
        
    }
}