<?php
App::uses('VideosAppModel', 'Videos.Model');
/**
 * Video Model
 *
 * @property Videoplayer $Videoplayer
 */
class Video extends VideosAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

    public $actsAs = array(
        'Logging.Loggable',
    );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'videoplayer_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'slug' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'videourl' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Videoplayer' => array(
			'className' => 'Videos.Videoplayer',
			'foreignKey' => 'videoplayer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
