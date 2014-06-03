<?php

CroogoNav::add('settings.children.trackings', array(
    'title' => 'Tracking',
    'url' => '#',
    'children' => array(
        'show' => array(
            'title' => 'Show Trackings',
            'url' => array(
                'admin' => true,
                'plugin' => 'trackings',
                'controller' => 'trackings',
                'action' => 'index',
            ),
        ),
        'add' => array(
            'title' => 'Add Tracking',
            'url' => array(
                'admin' => true,
                'plugin' => 'trackings',
                'controller' => 'trackings',
                'action' => 'add',
            ),
        ),
    ),
));