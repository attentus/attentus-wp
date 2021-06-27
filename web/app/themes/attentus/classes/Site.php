<?php
/**
 * Copyright (C) 2021 by attentus mbH
 * All Rights Reserved
 * https://www.attentus.com
 * info@attentus.com
 *
 * This source code is proprietary and confidential. Unauthorized
 * copying of this file via any medium is strictly prohibited.
 *
 * @author Kolja Nolte <nolte@attentus.com>
 */

namespace Attentus;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

class Site extends \Timber\Site {
	public string $version = '';

	public function __construct() {
		parent::__construct();

		$this->version = $this->theme->version;

		add_action( 'init', [ $this, 'add_constants' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'add_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'add_scripts' ] );
		add_action( 'after_setup_theme', [ $this, 'add_theme_support' ] );
	}

	public function add_constants(): void {
		define( 'TEXTDOMAIN', $this->theme->slug );
		define( 'TIMBER_CACHE_TIMEOUT', 1 );
	}

	public function add_styles(): void {
		$css_directory_url = $this->theme->link() . '/styles/css';

		wp_enqueue_style(
			'styles-main',
			$css_directory_url . '/main.min.css',
			[],
			$this->version
		);
	}

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

	public function add_post_types(): void {

	}

	public function add_taxonomies(): void {

	}

	public function add_theme_support(): void {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			]
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			[
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			]
		);

		add_theme_support( 'menus' );
	}
}

new Site();