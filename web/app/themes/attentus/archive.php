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

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access to theme files is not allowed.' );
}

get_template_part( 'pages/archive/page' );