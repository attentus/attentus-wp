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

use Roots\WPConfig\Config;
use Timber;
use Twig\TwigFilter;
use Twig\TwigFunction;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

class Twig extends Timber\Twig {
	public function __construct() {
		add_filter( 'timber/context', [ $this, 'add_to_context' ] );
		add_filter( 'timber/twig', [ $this, 'add_twig_filters' ] );
		add_filter( 'timber/twig', [ $this, 'add_twig_functions' ] );
		add_filter( 'timber/post/classmap', [ $this, 'class_map_post' ] );
		add_filter( 'timber/user/classmap', [ $this, 'class_map_user' ] );
		add_filter( 'timber/term/classmap', [ $this, 'class_map_term' ] );
		add_filter( 'timber/twig/environment/options', [ $this, 'set_twig_options' ] );
	}

	/**
	 * @param array $options
	 *
	 * @return array
	 */
	public function set_twig_options( array $options ): array {
		$options['cache'] = false;

		if ( WP_ENV === 'production' ){
			$options['cache'] = true;
		}

		return $options;
	}

	/**
	 * @param $class_map
	 *
	 * @return array
	 *
	 * @since 0.0.1
	 */
	public function class_map_post( $class_map ): array {
		$new_class_map = [
			'Post' => Timber\Post::class
		];

		return (array) array_merge( $class_map, $new_class_map );
	}

	public function class_map_user( $default_class ) {
		return $default_class;
	}

	public function class_map_term( array $class_map ): array {
		$new_class_map = [];

		return array_merge( $class_map, $new_class_map );
	}

	/**
	 * @param array $context
	 *
	 * @return array
	 *
	 * @since 0.0.1
	 */
	public function add_to_context( array $context ): array {
		$menus                 = get_registered_nav_menus();
		$context['site']       = new Site();
		$context['ajax_url']   = get_admin_url( get_current_blog_id(), 'admin-ajax.php' );
		$context['menus']      = [];
		$context['textdomain'] = TEXTDOMAIN;

		/**
		 * Loops through all registered menus and assigns them
		 * to the global context.
		 *
		 * @var string $menu        Menu name
		 * @var string $description Menu description
		 */
		foreach ( $menus as $menu => $description ) {
			$context['menus'][$menu] = Timber::get_menu( $menu );
		}

		return $context;
	}

	/**
	 * @param $twig
	 *
	 * @return mixed
	 */
	public function add_twig_filters( $twig ): object {
		$twig->addFilter(
			new TwigFilter( 'json_decode', [ $this, 'twig_filter_json_decode' ] )
		);

		$twig->addFilter(
			new TwigFilter( 'p', function ( string $text ): string {
				return wpautop( $text );
			} )
		);

		$twig->addFilter(
			new TwigFilter( 'int', [ $this, 'twig_filter_int' ] )
		);

		return $twig;
	}

	public function twig_filter_int( $string ) {
		return (int) $string;
	}

	/**
	 * @param string $json
	 *
	 * @return array
	 * @throws \JsonException
	 *
	 * @since 0.0.1
	 */
	public function twig_filter_json_decode( string $json ): array {
		return json_decode( $json, true, strlen( $json ) + 1, JSON_THROW_ON_ERROR );
	}

	public function add_twig_functions( $twig ): object {
		$twig->addFunction(
			new TwigFunction( 'env', [ $this, 'twig_function_env' ] )
		);

		$twig->addFunction(
			new TwigFunction( 'd', [ $this, 'twig_function_d' ] )
		);

		$twig->addFunction(
			new TwigFunction( 'taxonomy', [ $this, 'twig_function_taxonomy' ] )
		);

		$twig->addFunction(
			new TwigFunction( 'post', function ( $post ) {
				return Timber::get_post( $post );
			} )
		);

		$twig->addFunction(
			new TwigFunction( 'now', [ $this, 'twig_function_now' ] )
		);

		$twig->addFunction(
			new TwigFunction( 'meta', [ $this, 'twig_function_meta' ] )
		);

		return $twig;
	}

	/**
	 * @param string $field   Name of the field
	 * @param mixed  $post_id ID or 'options' if field is on ACF options page
	 *
	 * @return mixed
	 */
	public function twig_function_meta( string $field, $post_id = 0 ) {
		$post_id = $post_id ?: (int) get_the_ID();
		$value   = get_post_meta( $field, $post_id, true );

		if ( function_exists( 'get_field' ) ){
			$value = get_field( $field, $post_id );
		}

		return $value;
	}

	/**
	 * @param string $time_format
	 *
	 * @return string
	 */
	public function twig_function_now( string $time_format = '' ): string {
		$time_format = $time_format ?: (string) get_option( 'time_format' );

		return date( $time_format );
	}

	/**
	 * @param string $constant
	 *
	 * @return string
	 */
	public function twig_function_env( string $constant ) {
		return Config::get( $constant );
	}

	/**
	 * @param $taxonomy
	 *
	 * @return object
	 */
	public function twig_function_taxonomy( $taxonomy ): object {
		return new Taxonomy( $taxonomy );
	}

	/**
	 * @param $parameter mixed The to be inspected parameter.
	 *
	 * @since 0.0.1
	 */
	public function twig_function_d( $parameter ): void {
		if ( function_exists( 'd' ) ){
			d( $parameter );
		} else {
			var_dump( $parameter );
		}
	}
}

new Twig();