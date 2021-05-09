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

require_once __DIR__ . '/init.php';

add_action( 'acf/init', 'my_acf_init' );

function my_acf_init() {
	// Bail out if function doesn’t exist.
	if ( ! function_exists( 'acf_register_block' ) ) {
		return;
	}

	// Register a new block.

}

/**
 *  This is the callback that displays the block.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block content (emtpy string).
 * @param bool   $is_preview True during AJAX preview.
 */
function my_acf_block_render_callback( $block, $content = '', $is_preview = false ) {
	$context = Timber::context();

	// Store block values.
	$context['block'] = $block;

	// Store field values.
	$context['fields'] = get_fields();

	// Store $is_preview value.
	$context['is_preview'] = $is_preview;

	// Render the block.
	Timber::render( 'block/example-block.twig', $context );
}