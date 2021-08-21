<?php
/**
 * Do not edit this file. Edit the config files found in the config/ dir instead.
 * This file is required in the root directory so WordPress can find it.
 * WP is hardcoded to look in its own directory or one directory up for wp-config.php.
 */

if ( ! defined( 'WP_MEMORY_LIMIT' ) ) {
	define( "WP_MEMORY_LIMIT", '512M' );
}

require_once dirname( __DIR__ ) . '/vendor/autoload.php';
require_once dirname( __DIR__ ) . '/config/application.php';
require_once ABSPATH . 'wp-settings.php';

define( 'DB_PREFIX', 'site_' );
