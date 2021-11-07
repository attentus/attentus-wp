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

$install_path = dirname( __DIR__ );
$vendor_path  = $install_path . '/vendor/autoload.php';

if ( ! is_dir( $install_path ) ){
	echo new Error( 'FATAL ERROR: The installed directory does not exist or could not be found.' );

	die();
}

if ( ! is_file( $vendor_path ) ){
	echo new Error( 'FATAL ERROR: Required Composer vendors could not be found.' );

	die();
}

if ( ! file_exists( $install_path . '/.env' ) ){
	echo new Error( 'FATAL ERROR: Environment file .env could not be found in ' . $install_path . './.env' );

	die();
}

require_once $install_path . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createUnsafeImmutable( $install_path );

/** Loads the content of the .env file */
$dotenv->load();
/*
$db_host     = env( 'DB_HOST' );
$db_name     = env( 'DB_NAME' );
$db_user     = env( 'DB_USER' ) ?: 'root';
$db_password = env( 'DB_PASSWORD' ) ?: 'root';
$db_prefix   = env( 'DB_PREFIX' ) ?: 'site_';*/

$project_name = basename( dirname( __DIR__ ) );
$db_name      = $project_name;

$mysql = mysqli_connect(
	'localhost',
	'root',
	'root'
);

if ( ! $mysql->query( 'CREATE DATABASE `' . $db_name . '`' ) ){
	echo new Error(
		'FATAL ERROR: Could not create the database "' . $db_name . '". Please check your variables in your .env file.'
	);
}

exec( 'wp config create --dbname=' . $db_name . ' --dbuser=root --dbpass=root' );
var_dump(
	exec(
		"wp core install --url=https://$project_name.test --admin_user=admin --admin_email=admin@admin.de --title=$project_name --admin_password=admin"
	)
);