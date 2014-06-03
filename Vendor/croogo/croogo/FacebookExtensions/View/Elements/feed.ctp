<?php
    $this->Fb = $this->Helpers->load('FacebookExtensions.Fb');
    $response = $this->requestAction(array('plugin' => 'facebook_extensions', 'controller' => 'facebook_feeds', 'action' => 'get_feed'), array('pass' => array('id' => $id)));
    $feed = $response['feed'];
    
    echo $this->Fb->posts($feed);
    



