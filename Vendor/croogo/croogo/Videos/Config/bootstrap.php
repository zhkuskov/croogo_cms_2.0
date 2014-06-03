<?php

CroogoNav::add('content.children.videos', array(
    'title' => 'Videos',
    'url' => '#',
    'children' => array(
        'videos' => array(
            'title' => 'Videos',
            'url' => '#',
            'children' => array(
                'show' => array(
                    'title' => 'Show Videos',
                    'url' => array(
                        'admin' => true,
                        'plugin' => 'videos',
                        'controller' => 'videos',
                        'action' => 'index',
                    ),
                ),
                'add' => array(
                    'title' => 'Add Video',
                    'url' => array(
                        'admin' => true,
                        'plugin' => 'videos',
                        'controller' => 'videos',
                        'action' => 'add',
                    ),
                ),
            )
        ),
        'player' => array(
            'title' => 'Player',
            'url' => '#',
            'children' => array(
                'show' => array(
                    'title' => 'Show Players',
                    'url' => array(
                        'admin' => true,
                        'plugin' => 'videos',
                        'controller' => 'videoplayers',
                        'action' => 'index',
                    ),
                ),
                'add' => array(
                    'title' => 'Add Player',
                    'url' => array(
                        'admin' => true,
                        'plugin' => 'videos',
                        'controller' => 'videoplayers',
                        'action' => 'add'
                    ),
                ),
            )
        )
    ),
));