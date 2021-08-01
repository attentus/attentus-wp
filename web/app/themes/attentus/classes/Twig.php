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

use Timber;
use Twig\TwigFilter;
use Twig\TwigFunction;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

class Twig extends \Timber\Twig {
	public function __construct() {
		add_filter( 'timber/context', [ $this, 'add_to_context' ] );
		add_filter( 'timber/twig', [ $this, 'add_twig_filters' ] );
		add_filter( 'timber/twig', [ $this, 'add_twig_functions' ] );
		add_filter( 'timber/post/classmap', [ $this, 'edit_post_class_map' ] );
	}

	/**
	 * @param $class_map
	 *
	 * @return array
	 *
	 * @since 0.0.1
	 */
	public function edit_post_class_map( $class_map ): array {
		$custom_class_map = [
			'Post' => Timber\Post::class
		];

		return array_merge( $class_map, $custom_class_map );
	}

	/**
	 * @param array $context
	 *
	 * @return array
	 *
	 * @since 0.0.1
	 */
	public function add_to_context( array $context ): array {
		$context['site']     = new Site();
		$context['ajax_url'] = get_admin_url( 0, 'admin-ajax.php' );

		return $context;
	}

	/**
	 * @param $twig
	 *
	 * @return mixed
	 */
	public function add_twig_filters( $twig ): object {
		/*$twig->addFilter(
			new TwigFilter( 'edit_post_link', [ $this, 'twig_filter_edit_post_link' ] )
		);*/

		$twig->addFilter(
			new TwigFilter( 'json_decode', [ $this, 'twig_filter_json_decode' ] )
		);

		return $twig;
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
		return json_decode( $json, true, 512, JSON_THROW_ON_ERROR );
	}

	public function add_twig_functions( $twig ): object {
		$twig->addFunction(
			new TwigFunction( 'log', [ $this, 'twig_function_log' ] )
		);

		$twig->addFunction(
			new TwigFunction( 'd', [ $this, 'twig_function_d' ] )
		);

		$twig->addFunction(
			new TwigFunction( 'Taxonomy', [ $this, 'twig_function_taxonomy' ] )
		);

		return $twig;
	}

	/**
	 * @param string $text The text that is to be logged
	 * @param string $type Log type (warning|error)
	 */
	public function twig_function_log( string $text, string $type = 'warnings' ): void {
		error_log( trim( $text ) );
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