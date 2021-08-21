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

/** Stop executing files when accessing them directly */

if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

require_once __DIR__ . '/init.php';

/**
 * Generates labels for a taxonomy based on
 * the given singular and plural name.
 *
 * @param string $singular   Singular taxonomy name
 * @param string $plural     Plural taxonomy name
 * @param string $textdomain Textdomain for translations
 *
 * @return array
 *
 * @since 1.0.0
 */
function generate_taxonomy_labels( string $singular, string $plural, string $textdomain = TEXTDOMAIN ): array {
	$singular_lowercase = lcfirst( $singular );
	$plural_lowercase   = lcfirst( $plural );

	return [
		'name'              => _x( $plural, 'taxonomy general name', $textdomain ),
		'singular_name'     => _x( $singular, 'taxonomy singular name', $textdomain ),
		'search_items'      => __( 'Search ' . $plural_lowercase, $textdomain ),
		'all_items'         => __( 'All ' . $plural_lowercase, $textdomain ),
		'parent_item'       => __( 'Parent ' . $singular_lowercase, $textdomain ),
		'parent_item_colon' => __( 'Parent ' . $singular_lowercase . ':', $textdomain ),
		'edit_item'         => __( 'Edit ' . $singular_lowercase, $textdomain ),
		'update_item'       => __( 'Update ' . $singular_lowercase, $textdomain ),
		'add_new_item'      => __( 'Add New ' . $singular_lowercase, $textdomain ),
		'new_item_name'     => __( 'New ' . $singular_lowercase . ' Name', $textdomain ),
		'menu_name'         => __( $plural, $textdomain ),
	];
}

/**
 * Generates labels for a post type based on
 * the given singular and plural name.
 *
 * @param string $singular   Singular post type name
 * @param string $plural     Plural post type name
 * @param string $textdomain Textdomain for translations
 *
 * @return array
 *
 * @since 1.0.0
 */
function generate_post_type_labels( string $singular, string $plural, string $textdomain = TEXTDOMAIN ): array {
	$singular_lowercase = lcfirst( $singular );
	$plural_lowercase   = lcfirst( $plural );

	return [
		'name'                  => _x( $plural, 'Post type general name', $textdomain ),
		'singular_name'         => _x( $singular, 'Post type singular name', $textdomain ),
		'menu_name'             => _x( $plural, 'Admin Menu text', $textdomain ),
		'name_admin_bar'        => _x( $singular, 'Add New on Toolbar', $textdomain ),
		'add_new'               => __( 'Add New', $textdomain ),
		'add_new_item'          => __( 'Add New ' . $singular_lowercase, $textdomain ),
		'new_item'              => __( 'New ' . $singular_lowercase, $textdomain ),
		'edit_item'             => __( 'Edit ' . $singular_lowercase, $textdomain ),
		'view_item'             => __( 'View ' . $singular_lowercase, $textdomain ),
		'all_items'             => __( 'All ' . $plural, $textdomain ),
		'search_items'          => __( 'Search ' . $plural_lowercase, $textdomain ),
		'parent_item_colon'     => __( 'Parent ' . $singular_lowercase . ': ', $textdomain ),
		'not_found'             => __( 'No ' . $plural_lowercase . ' found.', $textdomain ),
		'not_found_in_trash'    => __(
			'No ' . $plural_lowercase . ' found in Trash.',
			$textdomain
		),
		'featured_image'        => _x(
			$singular . ' cover image',
			'Overrides the "Featured Image" phrase for this post type. Added in 4.3',
			$textdomain
		),
		'set_featured_image'    => _x(
			'Set cover image',
			'Overrides the "Set featured image" phrase for this post type. Added in 4.3',
			$textdomain
		),
		'remove_featured_image' => _x(
			'Remove cover image',
			'Overrides the "Remove featured image" phrase for this post type. Added in 4.3',
			$textdomain
		),
		'use_featured_image'    => _x(
			'Use as cover image',
			'Overrides the "Use as featured image" phrase for this post type. Added in 4.3',
			$textdomain
		),
		'archives'              => _x(
			$singular . ' archives',
			'The post type archive label used in nav menus. Default "Post Archives". Added in 4.4',
			$textdomain
		),
		'insert_into_item'      => _x(
			'Insert into ' . $singular_lowercase,
			'Overrides the "Insert into post"/"Insert into page" phrase (used when inserting media into a post). Added in 4.4',
			$textdomain
		),
		'uploaded_to_this_item' => _x(
			'Uploaded to this ' . $singular_lowercase,
			'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase (used when viewing media attached to a post). Added in 4.4',
			$textdomain
		),
		'filter_items_list'     => _x(
			'Filter ' . $plural_lowercase . ' list',
			'Screen reader text for the filter links heading on the post type listing screen. Default "Filter posts list"/"Filter pages list". Added in 4.4',
			$textdomain
		),
		'items_list_navigation' => _x(
			$plural . ' list navigation',
			'Screen reader text for the pagination heading on the post type listing screen. Default "Posts list navigation"/"Pages list navigation". Added in 4.4',
			$textdomain
		),
		'items_list'            => _x(
			$plural . ' list',
			'Screen reader text for the items list heading on the post type listing screen. Default "Posts list"/"Pages list". Added in 4.4',
			$textdomain
		),
	];
}

/**
 * @param string $pattern
 * @param mixed  $flags
 *
 * @return array
 */
function rglob( string $pattern, $flags = null ): array {
	$files = glob( $pattern, $flags );

	foreach ( glob( dirname( $pattern ) . '/*', GLOB_ONLYDIR | GLOB_NOSORT ) as $dir ) {
		$files = wp_parse_args(
			$files,
			rglob( $dir . '/' . basename( $pattern ), $flags )
		);
	}

	return (array) $files;
}
