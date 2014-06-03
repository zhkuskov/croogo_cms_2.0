<?php
App::uses('FacebookPost', 'FacebookExtensions.Model');

/**
 * FacebookPost Test Case
 *
 */
class FacebookPostTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.facebook_extensions.facebook_post',
		'plugin.facebook_extensions.facebook_feed'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FacebookPost = ClassRegistry::init('FacebookExtensions.FacebookPost');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FacebookPost);

		parent::tearDown();
	}

}
