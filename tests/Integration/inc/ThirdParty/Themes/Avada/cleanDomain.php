<?php

namespace WP_Rocket\Tests\Integration\inc\ThirdParty\Themes\Avada;

use WP_Rocket\Tests\Integration\DBTrait;

/**
 * @covers \WP_Rocket\ThirdParty\Avada::clean_domain
 *
 * @group  AvadaTheme
 * @group  ThirdParty
 */
class Test_CleanDomain extends TestCase {
	use DBTrait;

	protected      $path_to_test_data = '/inc/ThirdParty/Themes/Avada/cleanDomain.php';

	public static function set_up_before_class() {
		parent::set_up_before_class();

		self::installFresh();
	}

	public static function tear_down_after_class() {
		self::uninstallAll();

		parent::tear_down_after_class();
	}

	public function testShouldCleanCacheWhenAvadaCacheIsCleaned() {
		$cache_exists = false;

		$this->assertSame( ! $cache_exists, $this->filesystem->exists( 'wp-content/cache/wp-rocket/example.org/index.html' ) );
		$this->assertSame( ! $cache_exists, $this->filesystem->exists( 'wp-content/cache/wp-rocket/example.org/index.html_gzip' ) );
		$this->assertSame( ! $cache_exists, $this->filesystem->exists( 'wp-content/cache/wp-rocket/example.org-wpmedia-594d03f6ae698691165999/about/index.html' ) );
		$this->assertSame( ! $cache_exists, $this->filesystem->exists( 'wp-content/cache/wp-rocket/example.org-wpmedia-594d03f6ae698691165999/about/index.html_gzip' ) );

		apply_filters( 'avada_clear_dynamic_css_cache', [], [] );

		$this->assertSame( $cache_exists, $this->filesystem->exists( 'wp-content/cache/wp-rocket/example.org/index.html' ) );
		$this->assertSame( $cache_exists, $this->filesystem->exists( 'wp-content/cache/wp-rocket/example.org/index.html_gzip' ) );
		$this->assertSame( $cache_exists, $this->filesystem->exists( 'wp-content/cache/wp-rocket/example.org-wpmedia-594d03f6ae698691165999/about/index.html' ) );
		$this->assertSame( $cache_exists, $this->filesystem->exists( 'wp-content/cache/wp-rocket/example.org-wpmedia-594d03f6ae698691165999/about/index.html_gzip' ) );
	}
}
