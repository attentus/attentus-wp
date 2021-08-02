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
 * @author Kolja Nolte <nolte@attentus.com>
 */

namespace attentus\attentus_WP;

use Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

$context          = Timber::context();
$context["post"] = Timber::get_post();
$templates        = [ "page/view.twig" ];

Timber::render(
	$templates,
	$context,
	TIMBER_CACHE_TIMEOUT
);