<?php
App::uses('LogItemChange', 'Logging.Model');

/**
 * LogItemChange Test Case
 *
 */
class LogItemChangeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.logging.log_item_change',
		'plugin.logging.log_item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LogItemChange = ClassRegistry::init('Logging.LogItemChange');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LogItemChange);

		parent::tearDown();
	}

}
