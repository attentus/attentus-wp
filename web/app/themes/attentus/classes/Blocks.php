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

class Blocks {
	public function __construct() {
		acf_register_block(
			[
				'name'            => 'example_block',
				'title'           => __( 'Example Block', 'your-text-domain' ),
				'description'     => __( 'A custom example block.', 'your-text-domain' ),
				'render_callback' => [ $this, 'block_example' ],
				'category'        => 'formatting',
				'icon'            => 'admin-comments',
				'keywords'        => [ 'example' ]
			]
		);
	}

	public function block_example() {

	}
}