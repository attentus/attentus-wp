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
use WP_Taxonomy;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

/**
 * Handler class for retrieving
 * single taxonomies and its terms.
 *
 * @sincee 0.0.1
 */
class Taxonomy {
	/** @var string $taxonomy Name of the taxonomy */
	public string $taxonomy;

	/**
	 * Constructor.
	 *
	 * @param $taxonomy
	 */
	public function __construct( $taxonomy ) {
		if ( is_string( $taxonomy ) ){
			$this->taxonomy = $taxonomy;
		} elseif ( is_object( $taxonomy ) ) {
			$taxonomy       = new WP_Taxonomy( $taxonomy, 'any' );
			$this->taxonomy = $taxonomy->name;
		}
	}

	/**
	 * @return iterable
	 *
	 * @since 0.0.1
	 */
	public function get_terms(): iterable {
		return Timber::get_terms( [
			'taxonomy' => $this->taxonomy
		] );
	}
}