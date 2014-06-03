<?php
$tracking = $this->requestAction(array('plugin' => 'trackings', 'controller' => 'trackings', 'action' => 'gettrackingcode'), array('pass' => array('id' => $id)));
echo $tracking['Tracking']['trackingcode'];



