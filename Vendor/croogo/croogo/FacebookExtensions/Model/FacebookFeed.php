<?php
App::uses('FacebookExtensionsAppModel', 'FacebookExtensions.Model');
/**
 * FacebookFeed Model
 *
 * @property FacebookPostType $FacebookPostType
 */
class FacebookFeed extends FacebookExtensionsAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'page';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
        public $hasMany = array(
            'FacebookPost'
        );
        
        public $actsAs = array('Logging.Loggable');
        
/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'FacebookPostType' => array(
			'className' => 'FacebookPostType',
			'joinTable' => 'facebook_feeds_facebook_post_types',
			'foreignKey' => 'facebook_feed_id',
			'associationForeignKey' => 'facebook_post_type_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
