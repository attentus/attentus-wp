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

namespace attentus\attentus_WP;

use Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

global $wp_query;

if ( is_archive() ){
	if ( is_post_type_archive() ){

	} elseif ( is_tax( 'category' ) ) {

	} elseif ( is_tax( 'post_tag' ) ) {

	}
}

$context          = Timber::context();
$context['posts'] = Timber::get_posts( $wp_query );
$templates        = [ "archive/view.twig" ];

Timber::render(
	$templates,
	$context,
	TIMBER_CACHE_TIMEOUT
);