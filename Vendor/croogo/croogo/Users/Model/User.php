<?php

App::uses('UsersAppModel', 'Users.Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * User
 *
 * @category Model
 * @package  Croogo.Users.Model
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class User extends UsersAppModel {

/**
 * Model name
 *
 * @var string
 * @access public
 */
	public $name = 'User';

/**
 * Order
 *
 * @var string
 * @access public
 */
	public $order = 'User.name ASC';

	/**
	 * Behaviors used by the Model
	 *
	 * @var array
	 * @access public
	 */
	public $actsAs = array(
			'Logging.Loggable' => array(
					'hashed'        => array(
							'password'
					),
					'encrypted'     => array(
							'email',
					)
	
			),
			'Cryptable' => array(
					'fields' => array(
							'email',
					)
			),
			'Acl' => array(
					'className' => 'Croogo.CroogoAcl',
					'type' => 'requester',
			),
			'Search.Searchable',
			'Croogo.Trackable',
	);

/**
 * Model associations: belongsTo
 *
 * @var array
 * @access public
 */
	public $belongsTo = array('Users.Role');
	
	public $hasMany = array('Users.UserActivity');

/**
 * Validation
 *
 * @var array
 * @access public
 */
	public $validate = array(
		'username' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'The username has already been taken.',
				'last' => true,
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'This field cannot be left blank.',
				'last' => true,
			),
			'validAlias' => array(
				'rule' => 'validAlias',
				'message' => 'This field must be alphanumeric',
				'last' => true,
			),
		),
		'email' => array(
			//'email' => array(
			//	'rule' => 'email',
			//	'message' => 'Please provide a valid email address.',
			//	'last' => true,
			//),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Email address already in use.',
				'last' => true,
			),
		),
		'password' => array(
                        'length' => array(
                          'rule' => array('minLength', 12),
                          'message' => 'Passwords must be at least 12 characters long.',
                        ),
                        'digits' => array(
                          'rule' => array('contains', 'digits', 2),
                          'message' => 'Passwords must contain at least 2 digits'
                        ),
                        'lowercase letters' => array(
                          'rule' => array('contains', 'lowercase letters', 2),
                          'message' => 'Passwords must contain at least 2 lowercase letters.'
                        ),
                        'uppercase letters' => array(
                          'rule' => array('contains', 'uppercase letters', 2),
                          'message' => 'Passwords must contain at least 2 uppercase letters.'
                        ),
                        'special characters' => array(
                          'rule' => array('contains', 'special characters', 2),
                          'message' => 'Passwords must contain at least 2 special characters.'
                        )
		),
		'verify_password' => array(
			'rule' => 'validIdentical',
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'This field cannot be left blank.',
				'last' => true,
			),
			'validName' => array(
				'rule' => 'validName',
				'message' => 'This field must be alphanumeric',
				'last' => true,
			),
		),
		'website' => array(
			'url' => array(
				'rule' => 'url',
				'message' => 'This field must be a valid URL',
				'allowEmpty' => true,
			),
		),
	);


/**
 * Filter search fields
 *
 * @var array
 * @access public
 */
	public $filterArgs = array(
		'name' => array('type' => 'like', 'field' => array('User.name', 'User.username')),
		'role_id' => array('type' => 'value'),
	);

/**
 * Display fields for this model
 *
 * @var array
 */
	protected $_displayFields = array(
		'id',
		'Role.title' => 'Role',
		'username',
		'name',
		'status' => array('type' => 'boolean'),
		'email',
	);

/**
 * Edit fields for this model
 *
 * @var array
 */
	protected $_editFields = array(
		'role_id',
		'username',
		'name',
		'email',
		'website',
		'status',
	);

/**
 * beforeDelete
 *
 * @param boolean $cascade
 * @return boolean
 */
	public function beforeDelete($cascade = true) {
		$this->Role->Behaviors->attach('Croogo.Aliasable');
		$adminRoleId = $this->Role->byAlias('admin');

		$current = AuthComponent::user();
		if (!empty($current['id']) && $current['id'] == $this->id) {
			return false;
		}
		if ($this->field('role_id') == $adminRoleId) {
			$count = $this->find('count', array(
				'conditions' => array(
					'User.id <>' => $this->id,
					'User.role_id' => $adminRoleId,
					'User.status' => true,
				)
			));
			return ($count > 0);
		}
		return true;
	}

/**
 * beforeSave
 *
 * @param array $options
 * @return boolean
 */
	public function beforeSave($options = array()) {
		if (!empty($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
	}

/**
 * _identical
 *
 * @param string $check
 * @return boolean
 * @deprecated Protected validation methods are no longer supported
 */
	protected function _identical($check) {
		return $this->validIdentical($check);
	}

/**
 * validIdentical
 *
 * @param string $check
 * @return boolean
 */
	public function validIdentical($check) {
		if (isset($this->data['User']['password'])) {
			if ($this->data['User']['password'] != $check['verify_password']) {
				return __d('croogo', 'Passwords do not match. Please, try again.');
			}
		}
		return true;
	}
	
	/**
	 * checks if the given data contains at least a speficic number of specific characters
	 * @param string $check, string $charSet, int $min
	 * @return boolean
	 */
	public function contains($check, $charSetName, $min) {
		$array = array_values($check);
		$check = $array[0];
	
		switch($charSetName) {
			case "digits":
				$charSet = "/[0-9]/";
				break;
			case "lowercase letters":
				$charSet = "/[a-z]/";
				break;
			case "uppercase letters":
				$charSet = "/[A-Z]/";
				break;
			case "special characters":
				$symbolCount = 0;
				for($i = 0; $i < strlen($check); $i++) {
					$char = ord($check{$i});
					$symbolCount += $isSymbol = (!in_array($char, range(48, 57)) && !in_array($char, range(65, 90)) && !in_array($char, range(97, 122)));
				}
				return $symbolCount >= $min;
				break;
			default:
				throw new CakeException(__d('croogo', $charSetName . " is not a supported charset name!"));
				break;
	
		}
		return preg_match_all($charSet, $check, $matches) >= $min;
	}

}
