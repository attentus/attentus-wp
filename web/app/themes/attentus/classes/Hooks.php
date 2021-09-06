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

/**
 * WordPress hooks.
 *
 * @since 0.0.1
 */
class Hooks {
	private object $site;

	/**
	 * Constructor call.
	 */
	public function __construct() {
		$this->site = new Timber\Site();
		$this->load_custom_css();
		$this->load_custom_js();

		if ( get_field( 'random_file_names', 'options' ) === true ){
			add_filter( 'sanitize_file_name', [ $this, 'filter_rename_uploaded_file' ], 10, 1 );
		}

		if ( get_field( 'allow_svg_uploads', 'options' ) === true ){
			add_filter( 'upload_mimes', [ $this, 'filter_add_mime_types' ], 25 );
			add_filter( 'wp_check_filetype_and_ext', [ $this, 'filter_check_file_types' ], 10, 4 );
		}

		if ( get_field( 'jpeg_quality', 'options' ) !== 90 ){
			add_filter( 'jpeg_quality', [ $this, 'filter_set_jpeg_quality' ], 10, 0 );
		}

		if ( get_field( 'branding', 'options' ) === true ){
			add_action( 'login_enqueue_scripts', [ $this, 'add_attentus_login_logo' ] );

			add_filter( 'login_headerurl', function () {
				return 'https://www.attentus.com';
			} );

			add_action( 'wp_before_admin_bar_render', [ $this, 'add_attentus_dashboard_logo' ] );
		}

		add_filter( 'get_custom_logo', [ $this, 'filter_custom_logo' ] );
	}

	/**
	 * @since 1.0.1
	 */
	public function load_custom_css(): void {
		$custom_css      = get_field( 'custom_css', 'options' );
		$custom_css_code = $custom_css['code'];

		if ( $custom_css_code && strlen( $custom_css_code ) > 3 ){
			if ( $custom_css['load_position'] === 'footer' ){
				add_action( 'wp_footer', static function () use ( $custom_css_code ) {
					?>
					<style><?= $custom_css_code ?></style>
					<?php
				} );
			} else {
				add_action( 'wp_head', static function () use ( $custom_css_code ) {
					?>
					<style><?= $custom_css_code ?></style>
					<?php
				} );
			}
		}
	}

	/**
	 * @since 1.0.1
	 */
	public function load_custom_js(): void {
		$custom_js      = get_field( 'custom_js', 'options' );
		$custom_js_code = $custom_js['code'];

		if ( $custom_js_code && strlen( $custom_js_code ) > 3 ){
			if ( $custom_js['load_position'] === 'footer' ){
				add_action( 'wp_footer', static function () use ( $custom_js_code ) {
					?>
					<script type="text/javascript"><?= $custom_js_code ?></script>
					<?php
				} );
			} else {
				add_action( 'wp_head', static function () use ( $custom_js_code ) {
					?>
					<script type="text/javascript"><?= $custom_js_code ?></script>
					<?php
				} );
			}
		}
	}

	/**
	 * @param string $html
	 *
	 * @return string
	 *
	 * @since 0.0.1
	 */
	public function filter_custom_logo( string $html ): string {
		$alt  = esc_attr( get_bloginfo( 'name' ) . ' logo' );
		$html = str_replace( 'alt=""', 'alt="' . $alt . '"', $html );

		return trim( $html );
	}

	/**
	 * Replaces the WordPress logo see in the top left corner
	 * on the Dashboard with the attentus logo.
	 *
	 * @since 0.0.1
	 */
	public function add_attentus_dashboard_logo(): void {
		?>
		<style>
			#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
				background-image:    url(<?php echo $this->site->theme->link() ?>/images/logo-attentus-square-white.svg);
				background-position: 0 0;
				background-repeat:   no-repeat;
				top:                 5px;
				color:               rgba(0, 0, 0, 0);
			}
		</style>
		<?php
	}

	/**
	 * Replaces the WordPress logo on login
	 * pages with the attentus logo.
	 *
	 * @since 0.0.1
	 */
	public function add_attentus_login_logo(): void {
		?>
		<style>
			#login h1 a,
			.login h1 a {
				background-image: url(<?php echo $this->site->theme->link;
				?>/images/logo-attentus-square-black.svg) !important;
				height:           80px;
				margin-bottom:    60px;
			}
		</style>
		<?php
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

	public function filter_check_file_types( $checked, $file, $filename, $mimes ): array {
		if ( ! $checked['type'] ){
			$check_filetype  = wp_check_filetype( $filename, $mimes );
			$ext             = $check_filetype['ext'];
			$type            = $check_filetype['type'];
			$proper_filename = $filename;

			if ( $ext !== 'svg' && $type && 0 === strpos( $type, 'image/' ) ){
				$ext = $type = false;
			}

			$checked = compact(
				'ext',
				'type',
				'proper_filename'
			);
		}

		return $checked;
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
		if ( current_user_can( 'administrator' ) ){
			$mimes['svg']  = 'image/svg+xml';
			$mimes['svgz'] = 'image/svg+xml';
		}

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
