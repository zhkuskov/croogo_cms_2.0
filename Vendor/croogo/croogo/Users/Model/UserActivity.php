<?php
App::uses('UsersAppModel', 'Users.Model');
/**
 * UserActivity Model
 *
 * @property User $User
 */
class UserActivity extends UsersAppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'user_activity';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

