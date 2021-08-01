<?php
/**
 * Copyright (C) 2021 by attentus GmbH
 * All Rights Reserved
 * https://www.attentus.com
 * info@attentus.com
 *
 * This source code is proprietary and confidential. Unauthorized
 * copying of this file via any medium is strictly prohibited.
 *
 * @package attentus WP
 * @author  Kolja Nolte <nolte@attentus.com>
 */

namespace attentus\attentus_WP;

use Jigsaw;
use Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

class Site extends Timber\Site {
	/** @var string $version The theme's version, alias of $this->theme->version */
	public string $version;

	public function __construct() {
		parent::__construct();

		$this->version = $this->theme->version ?: '1.0.0';

		add_action( 'wp_enqueue_scripts', [ $this, 'add_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'add_scripts' ] );
		add_action( 'after_setup_theme', [ $this, 'add_theme_support' ] );
		add_action( 'after_setup_theme', [ $this, 'add_acf_options_pages' ] );
		add_action( 'admin_menu', [ $this, 'remove_admin_pages' ] );
		add_action( 'after_setup_theme', [ $this, 'extend_admin_toolbar' ] );
		add_action( 'after_setup_theme', [ $this, 'extend_users_table' ] );
	}

	/**
	 * Adds the registration date of a user
	 * to the overview table.
	 *
	 * @sincee 0.0.1
	 */
	public function extend_users_table(): void {
		if ( ! class_exists( 'Jigsaw' ) ){
			return;
		}

		Jigsaw::add_user_column(
			__( 'Registriert', TEXTDOMAIN ),
			function ( $user_id ) {
				$user = Timber::get_user( $user_id );
				$time = mktime( $user->user_registered_ );
				$date = date(
					'j. M Y, H:i',
					$time
				);

				echo esc_html( trim( $date ) );
			},
			5
		);
	}

	/**
	 * Extends the admin toolbar.
	 *
	 * @since 0.0.1
	 */
	public function extend_admin_toolbar(): void {
		if ( ! class_exists( 'Jigsaw' ) ){
			return;
		}

		$optionOne         = new \stdClass();
		$optionOne->label  = 'Timber-Cache leeren';
		$optionOne->action = function () {
			global $root_dir;

			$loader = new Timber\Loader();
			$loader->clear_cache_twig();

			if ( is_dir( $root_dir . '/web/app/cache' ) ){
				rrmdir( $root_dir . '/web/app/cache' );
			}
		};

		Jigsaw::add_toolbar_group( 'Schnellaktionen', [ $optionOne ] );
	}

	/**
	 * @since 0.0.1
	 */
	public function add_styles(): void {
		$css_directory_url = $this->theme->link() . '/styles/css';

		wp_enqueue_style(
			'styles-main',
			$css_directory_url . '/main.min.css',
			[],
			$this->version
		);

		wp_enqueue_style(
			'styles-font-awesome',
			$css_directory_url . '/font-awesome.min.css',
			[],
			'6.0.0-alpha3'
		);
	}

	/**
	 * @since 0.0.1
	 */
	public function add_scripts(): void {
		$js_directory_url = $this->theme->link() . '/scripts/js';

		wp_enqueue_script(
			'scripts-main',
			$js_directory_url . '/main.min.js',
			[ 'jquery' ],
			$this->version
		);

		wp_enqueue_script(
			'scripts-bootstrap',
			$js_directory_url . '/bootstrap.min.js',
			[ 'jquery' ],
			'5.0.2'
		);
	}

	/**
	 * @since 0.0.1
	 */
	public function add_acf_options_pages(): void {
		if ( ! function_exists( 'acf_add_options_page' ) ){
			return;
		}

		acf_add_options_page( [
			'page_title'  => __( 'attentus WP', TEXTDOMAIN ),
			'menu_title'  => __( 'attentus WP', TEXTDOMAIN ),
			'parent_slug' => 'themes.php',
			'redirect'    => false
		] );
	}

	/**
	 * @since 0.0.1
	 */
	public function add_post_types(): void {

	}

	/**
	 * @since 0.0.1
	 */
	public function add_taxonomies(): void {

	}

	/**
	 * @since 0.0.1
	 */
	public function add_theme_support(): void {
		add_theme_support( 'soil', [
			'clean-up',
			'disable-asset-versioning',
			'disable-trackbacks',
			//	'google-analytics' => 'UA-XXXXX-Y',
			'js-to-footer',
			'nav-walker',
			'nice-search',
			'relative-urls'
		] );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'html5', [
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		] );

		add_theme_support( "wp-block-styles" );

		add_theme_support( "responsive-embeds" );

		add_theme_support( "custom-logo", [] );

		add_theme_support( "custom-header", [] );

		add_theme_support( "custom-background", [] );
	}

	/**
	 * @since 0.0.1
	 */
	public function remove_admin_pages(): void {
		$admin_pages = get_field( 'removed_admin_pages', 'options' );

		foreach ( $admin_pages as $admin_page ) {
			remove_menu_page( $admin_page );
		}
	}
}

new Site();