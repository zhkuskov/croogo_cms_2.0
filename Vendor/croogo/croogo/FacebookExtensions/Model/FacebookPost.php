<?php
App::uses('FacebookExtensionsAppModel', 'FacebookExtensions.Model');
/**
 * FacebookPost Model
 *
 * @property FacebookFeed $FacebookFeed
 */
class FacebookPost extends FacebookExtensionsAppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'FacebookFeed' => array(
			'className' => 'FacebookFeed',
			'foreignKey' => 'facebook_feed_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public $actsAs = array('Logging.Loggable');
}
