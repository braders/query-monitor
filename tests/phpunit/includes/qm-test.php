<?php

/**
 * @property \WP_UnitTest_Factory $factory
 */
abstract class QM_UnitTestCase extends WP_UnitTestCase {

	use \FalseyAssertEqualsDetector\Test;

	public function setUp() {
		if ( ! defined( 'WP_USE_THEMES' ) ) {
			define( 'WP_USE_THEMES', true );
		}

		if ( true !== WP_USE_THEMES ) {
			$this->fail( 'WP_USE_THEMES should not be false' );
		}

		parent::setUp();
	}

	/**
	 * @return string
	 */
	public function go_to_with_template( string $url ) {

		if ( ! isset( $_SERVER['REQUEST_METHOD'] ) ) {
			$_SERVER['REQUEST_METHOD'] = 'GET';
		}

		remove_action( 'template_redirect', 'redirect_canonical' );

		$this->go_to( $url );

		ob_start();
		require ABSPATH . WPINC . '/template-loader.php';
		return ob_get_clean();
	}

}
