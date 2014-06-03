<?php
App::uses('VideosAppModel', 'Videos.Model');
/**
 * Videoplayer Model
 *
 * @property Video $Video
 */
class Videoplayer extends VideosAppModel {

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
		'playerkey' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Video' => array(
			'className' => 'Videos.Video',
			'foreignKey' => 'videoplayer_id',
			'dependent' => false,
		)
	);

}
