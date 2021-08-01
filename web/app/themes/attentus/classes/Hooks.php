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
 * WordPress hooks.
 *
 * @since 0.0.1
 */
class Hooks {
	/**
	 * Constructor call.
	 */
	public function __construct() {
		if ( get_field( 'random_file_names', 'options' ) === true ){
			add_filter( 'sanitize_file_name', [ $this, 'filter_rename_uploaded_file' ], 10, 1 );
		}

		if ( get_field( 'allow_svg_uploads', 'options' ) === true ){
			add_filter( 'upload_mimes', [ $this, 'filter_add_mime_types' ] );
			add_filter( 'wp_check_filetype_and_ext', [ $this, 'filter_check_file_types' ], 10, 4 );
		}

		if ( get_field( 'jpeg_quality', 'options' ) !== 90 ){
			add_filter( 'jpeg_quality', [ $this, 'filter_set_jpeg_quality' ], 10, 0 );
		}
	}

	/**
	 * Defines the compression rate of
	 * uploaded JPEG images (integer, as percentage).
	 *
	 * @return int
	 *
	 * @since 0.0.1
	 */
	public function filter_set_jpeg_quality(): int {
		return (int) get_field( 'jpeg_quality', 'options' );
	}

	/**
	 * @param $data
	 * @param $file
	 * @param $file_name
	 * @param $mimes
	 *
	 * @return array
	 *
	 * @since 0.0.1
	 */
	public function filter_check_file_types( $data, $file, $file_name, $mimes ): array {
		global $wp_version;
		if ( $wp_version !== '4.7.1' ){
			return $data;
		}

		$filetype = wp_check_filetype( $file_name, $mimes );

		return [
			'ext'             => $filetype['ext'],
			'type'            => $filetype['type'],
			'proper_filename' => $data['proper_filename']
		];
	}

	/**
	 * Adds .svg file types to the list of
	 * available mime types.
	 *
	 * @param $mimes
	 *
	 * @return array
	 *
	 * @since 0.0.1
	 */
	public function filter_add_mime_types( $mimes ): array {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	/**
	 * Renames uploaded files to the MD5 hash of the
	 * original file name (with extension).
	 *
	 * @param $file_name
	 *
	 * @return string
	 *
	 * @since 0.0.1
	 */
	public function filter_rename_uploaded_file( $file_name ): string {
		$file_info = pathinfo( $file_name );

		if ( isset( $file_info['filename'], $file_info['extension'] ) ){
			$new_file_name = md5( $file_name );
			$new_file_name = substr( $new_file_name, 0, 12 );

			return sanitize_title( $new_file_name ) . '.' . $file_info['extension'];
		}

		return $file_name;
	}
}

new Hooks();