<?php

CroogoNav::add('content.children.facebook', array(
	'title' => 'Facebook',
	'url' => array(
		'plugin' => 'facebook_extensions',
		'admin' => true,
		'controller' => 'facebook_feeds',
		'action' => 'index',
	),
	'children' => array(
		'feeds' => array(
			'title' => 'Feeds',
			'url' => '#',
			'children' => array(
				'list' => array(
					'title' => __d('facebook_extensions', 'List feeds'),
					'url' => array(
						'plugin' => 'facebook_extensions',
						'admin' => true,
						'controller' => 'facebook_feeds',
						'action' => 'index',
					),
				),
				'new' => array(
					'title' => __d('facebook_extensions', 'New feed'),
					'url' => array(
						'plugin' => 'facebook_extensions',
						'admin' => true,
						'controller' => 'facebook_feeds',
						'action' => 'add',
					),
				),
			)
                    )
            )
    )
 );
