<?php
App::uses('Tracking', 'Trackings.Model');

/**
 * Tracking Test Case
 *
 */
class TrackingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.trackings.tracking'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tracking = ClassRegistry::init('Trackings.Tracking');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tracking);

		parent::tearDown();
	}

}
