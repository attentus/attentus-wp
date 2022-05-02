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

use Roots\WPConfig\Config;

const COMPRESS_CSS        = true;
const COMPRESS_SCRIPTS    = true;
const WP_LOCAL_DEV        = false;
const CONCATENATE_SCRIPTS = true;
const WP_CACHE            = true;

Config::define( 'WP_DEBUG', true );
Config::define( 'WP_DEBUG_DISPLAY', false );
Config::define( 'WP_DEBUG_LOG', true );
Config::define( 'DISALLOW_FILE_MODS', true );
Config::define( 'WP_DISABLE_FATAL_ERROR_HANDLER', false );