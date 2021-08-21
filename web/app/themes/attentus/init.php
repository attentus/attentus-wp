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

/**
 * This file takes care of initialization of Bedrock,
 * Timber, and Twig Template Engine. It loads the vendor files
 * via /vendor/autoload.php and checks whether the loaded files
 * are compatible with the current version WordPress.
 */

namespace attentus\attentus_WP;

use ACF;
use Timber\Timber;
use WP_Theme;
use function Env\env;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access to theme files is not allowed.' );
}

$autoload_path = ABSPATH . '/../../vendor/autoload.php';
$theme         = new WP_Theme( get_stylesheet_directory(), '/' );
$link_url      = 'mailto:' . get_bloginfo( 'admin_email' );
$link_url      .= '?subject=' . 'ERROR: Plugin missing on ' . get_bloginfo( 'name' );
$link_url      .= ' (' . env( 'WP_HOME' ) . ')';
$link_url      .= '&body=The plugin %plugin% is missing and/or cannot be loaded';

/** Arguments for default wp_die() calls */
$default_wp_die_arguments = [
	'link_text' => 'Report error to the administrator &raquo;',
	'link_url'  => $link_url,
	'response'  => 404
];

/** Stop if autoload path can't be found and print error message */
if ( ! file_exists( $autoload_path ) ) {
	wp_die(
		'The theme <strong>' . $theme->get(
			'Name'
		) . '</strong> requires additional dependencies installed through PHP Composer. Please make sure to run <code>composer install</code> and <code>composer update</code>.',
		'ERROR: Could not find autoload.php',
		$default_wp_die_arguments
	);
} else {
	require_once $autoload_path;

	$required_classes = [
		'Timber'                     => Timber::class,
		'Advanced Custom Fields Pro' => ACF::class
	];

	foreach ( $required_classes as $plugin => $required_class ) {
		$default_wp_die_arguments['link_url'] = str_replace( '%plugin%', $plugin, $default_wp_die_arguments['link_url'] );

		if ( ! class_exists( $required_class ) ) {
			wp_die(
				'ERROR: The plugin or library <strong>' . $plugin . '</strong> was not loaded. Please make sure all PHP Composer packages have been installed by rerunning <code>composer install</code> and <code>composer update</code>. If the error still persists, there may be a problem with PHP Composer itself.',
				sprintf( __( 'ERROR: Could not load plugin %s', TEXTDOMAIN ), $plugin ),
				$default_wp_die_arguments
			);
		}
	}

	if ( ! class_exists( ACF::class ) ) {
		wp_die(
			'<strong>' . $theme->get(
				'Name'
			) . sprintf(
				'</strong> could not load <a href="%s" target="_blank">Advanced Custom Fields</a> plugin. Make sure all Composer dependencies have been installed and are using the set version defined in <code>composer.json</code>.',
				'https://gitlab.com/wordpress-premium/advanced-custom-fields-pro'
			),
			'ERROR: Could not load ACF',
			$default_wp_die_arguments
		);
	}
}

/** Initialize Timber and define default directories */
$timber           = new Timber();
$timber::$dirname = [ 'pages', 'views' ];

$include_directories = [
	'classes',
	'includes'
];

/** Loop through the set directories */
foreach ( $include_directories as $include_directory ) {
	$include_directory = plugin_dir_path( __FILE__ ) . $include_directory;

	/** Skip directory if it's not a valid directory */
	if ( ! is_dir( $include_directory ) ) {
		continue;
	}

	/** Gather all .php files within the current directory */
	$include_files = glob( $include_directory . "/*.php" );
	foreach ( $include_files as $include_file ) {
		/** Skip file if file is not valid */
		if ( ! is_file( $include_file ) ) {
			continue;
		}

		/** Make the file path readable for get_template_part() */
		$include_file = str_replace(
			[ get_stylesheet_directory(), ".php" ],
			"",
			$include_file
		);

		/** Include current file */
		get_template_part( $include_file );
	}
}

if ( ! isset( $content_width ) ) {
	$content_width = 1140;
}