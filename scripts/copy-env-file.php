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

$install_path  = dirname( __DIR__ ) . '/';
$env_file_path = "$install_path.env";

if ( ! file_exists( "$env_file_path.example" ) ){
	echo new Error( 'FATAL ERROR: Environment file .env could not be found in ' . $install_path . './.env' );

	die();
}

copy(
	$env_file_path . '.example',
	$env_file_path
);