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

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

/**
 * This class registers Ajax calls and
 * connects them with their action.
 *
 * @since 0.0.1
 */
class Ajax {
	public function __construct() {
		add_action( 'wp_ajax_get_theme_version', [ $this, 'get_theme_version' ] );
	}

	public function get_theme_version() {
		wp_send_json_success( [
			'theme_version' => esc_html( ( new Site() )->theme->version )
		] );
	}
}

//new Ajax();