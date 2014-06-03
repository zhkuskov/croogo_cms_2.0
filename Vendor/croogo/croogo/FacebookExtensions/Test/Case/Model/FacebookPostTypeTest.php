<?php
App::uses('FacebookPostType', 'FacebookExtensions.Model');

/**
 * FacebookPostType Test Case
 *
 */
class FacebookPostTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.facebook_extensions.facebook_post_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FacebookPostType = ClassRegistry::init('FacebookExtensions.FacebookPostType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FacebookPostType);

		parent::tearDown();
	}

}
