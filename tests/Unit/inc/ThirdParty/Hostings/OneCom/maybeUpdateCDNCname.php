<?php
namespace WP_Rocket\Tests\Unit\inc\ThirdParty\Hostings\OneCom;

use WP_Rocket\ThirdParty\Hostings\OneCom;
use WPMedia\PHPUnit\Unit\TestCase;
use Brain\Monkey\Functions;

/**
 * @covers \WP_Rocket\ThirdParty\Hostings\OneCom::maybe_enable_cdn_option
 * @group OneCom
 * @group ThirdParty
 */
class Test_MaybeUpdateCDNCname extends TestCase {
    private $onecom;

	public function setUp() : void {
		parent::setUp();

        $this->onecom = new OneCom();
	}

    public function tear_down() {
		parent::tear_down();

		// Reset after each test.
		unset( $_SERVER['ONECOM_DOMAIN_NAME'] );
		unset( $_SERVER['HTTP_HOST'] );
	}

	/**
	 * @dataProvider providerTestData
	 */
	public function testShouldReturnExpected( $config, $expected ) {

        Functions\expect( 'rest_sanitize_boolean' )
				->once()
				->andReturn( $config['oc_cdn_enabled'] );

        Functions\when( 'get_option' )
			->alias( function( $value ) use( $config ) {
				if ( 'oc_cdn_enabled' === $value ) {
                    return $config['oc_cdn_enabled'];
                }
			}
		);

        if ( $config['oc_cdn_enabled'] ) {
            $domain_name = $_SERVER['ONECOM_DOMAIN_NAME'] = $config['domain'];
            $http_host = $_SERVER['HTTP_HOST'] = $config['domain'];

            Functions\expect( 'wp_unslash' )
                ->times( 2 )
                ->andReturn( $domain_name, $http_host );

            Functions\expect( 'sanitize_text_field' )
                ->times( 2 )
                ->andReturn( $domain_name, $http_host );
        }

        $this->assertSame( $expected['return'], $this->onecom->maybe_update_cdn_cname( $config['cname'] ) );
	}

	public function providerTestData() {
		return $this->getTestData( __DIR__, 'maybeUpdateCDNCname' );
	}
}
