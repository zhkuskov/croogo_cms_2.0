<?php
App::uses('LogItem', 'Logging.Model');

/**
 * LogItem Test Case
 *
 */
class LogItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.logging.log_item',
		'plugin.logging.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LogItem = ClassRegistry::init('Logging.LogItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LogItem);

		parent::tearDown();
	}

}
