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

global $root_dir;

use Roots\WPConfig\Config;

const COMPRESS_CSS        = false;
const COMPRESS_SCRIPTS    = false;
const WP_LOCAL_DEV        = true;
const CONCATENATE_SCRIPTS = false;
const WP_CACHE            = false;

Config::define( 'SAVEQUERIES', true );
Config::define( 'WP_DEBUG', true );
Config::define( 'WP_DEBUG_DISPLAY', true );
Config::define( 'WP_DEBUG_LOG', true );
Config::define( 'WP_DISABLE_FATAL_ERROR_HANDLER', true );
Config::define( 'SCRIPT_DEBUG', true );
Config::define( 'DISALLOW_FILE_MODS', false );

ini_set( 'display_errors', '1' );

