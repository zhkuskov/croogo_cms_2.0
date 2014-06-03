<?php

Croogo::hookHelper('Nodes', 'Musicplayer.Musicplayer');

CroogoNav::add('content.children.musicplayer', array(
	'title' => __d('musicplayer', 'Musicplayer'),
	'url' => array(
		'plugin' => 'musicplayer',
		'admin' => true,
		'controller' => 'musicplayers',
		'action' => 'index',
	),
        'children' => array(
                'list' => array(
                        'title' => __d('musicplayer', 'List Musicplayers'),
                        'url' => array(
                                'plugin' => 'musicplayer',
                                'admin' => true,
                                'controller' => 'musicplayers',
                                'action' => 'index',
                        ),
                ),
                'new' => array(
                        'title' => __d('musicplayer', 'New Musicplayer'),
                        'url' => array(
                                'plugin' => 'musicplayer',
                                'admin' => true,
                                'controller' => 'musicplayers',
                                'action' => 'add',
                        ),
                ),
                'playlists' => array(
                    'title' => __d('musicplayer', 'Playlists'),
                        'url' => array(
                                'plugin' => 'musicplayer',
                                'admin' => true,
                                'controller' => 'playlists',
                                'action' => 'index',
                        ),
                        'children' => array(
                            'list' => array(
                                    'title' => __d('musicplayer', 'List Playlists'),
                                    'url' => array(
                                            'plugin' => 'musicplayer',
                                            'admin' => true,
                                            'controller' => 'playlists',
                                            'action' => 'index',
                                    ),
                            ), 
                            
                        )
                    
                )
        )
));


