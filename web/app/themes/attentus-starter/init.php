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

/**
 * This file takes care of initialization of Bedrock,
 * Timber, and Twig Template Engine. It loads the vendor files
 * via /vendor/autoload.php and checks whether the loaded files
 * are compatible with the current version WordPress.
 */

namespace Attentus;

use Timber\Timber;
use WP_Theme;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access to theme files is not allowed.' );
}

$autoload_path            = ABSPATH . '/../../vendor/autoload.php';
$theme                    = new WP_Theme( get_stylesheet_directory(), '/' );
$default_wp_die_arguments = [
	'link_text' => 'Report error to the administrator &raquo;',
	'link_url'  => 'mailto:' . get_bloginfo( 'admin_email' ) . '?subject=' . '[FATAL ERROR]: ' . get_bloginfo( 'name' ) . ' (' . $_ENV['WP_HOME'] . ')',
	'response'  => 404
];

if ( ! file_exists( $autoload_path ) ) {
	wp_die(
		'The theme <strong>' . $theme->get( 'Name' ) . '</strong> requires additional dependencies installed through PHP Composer. Please make sure to run <code>composer install</code> and <code>composer update</code>.',
		'[FATAL ERROR]: Could not find autoload.php',
		$default_wp_die_arguments
	);
} else {
	require_once $autoload_path;

	if ( ! class_exists( Timber::class ) ) {
		wp_die(
			'<strong>' . $theme->get( 'Name' ) . '</strong> could not load <em>Timber</em>. Make sure all Composer dependencies have been installed and are using the set version defined in <code>composer.json</code>.',
			'[FATAL ERROR]: Could not load Timber',
			$default_wp_die_arguments
		);
	}
}

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