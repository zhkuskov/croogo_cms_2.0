<?php

CroogoNav::add('content.children.example', array(
    'title' => 'Events / Concerts',
    'url' => '#',
    'children' => array(
        'show' => array(
            'title' => 'Show Events',
            'url' => array(
                'admin' => true,
                'plugin' => 'events',
                'controller' => 'events',
                'action' => 'index',
            ),
        ),
        'add' => array(
            'title' => 'Add Events',
            'url' => array(
                'admin' => true,
                'plugin' => 'events',
                'controller' => 'events',
                'action' => 'add',
            ),
        ),
    ),
));