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

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access to theme files is not allowed.' );
}

class Site extends \Timber\Site {
	public function __construct() {
		parent::__construct();
	}

	public function add_styles(): void {

	}

	public function add_scripts(): void {

	}

}