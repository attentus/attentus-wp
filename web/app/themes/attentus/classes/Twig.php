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

//namespace Attentus;

use Timber\Site;

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

	public function edit_post_class_map( $class_map ) {
		$custom_class_map = [
			'Post' => Timber\Post::class
		];

		return array_merge( $class_map, $custom_class_map );
	}

	public function add_to_context( array $context ): array {
		$context['site'] = new Site();

		return $context;
	}

	public function add_to_globals( array $globals ): array {

	}

	public function add_twig_filters( $twig ) {
		/*$twig->addFunction(
			new Twig\TwigFunction(
				'edit_post_link', [ $this, 'xxx' ]
			)
		);*/

		return $twig;
	}

	public function add_twig_functions( $twig ) {

		return $twig;
	}

}

new Twig();