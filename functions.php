<?php
/**
 * Twenty Twenty child theme for WP Theme Components
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Enqueue stylesheets
 */
function wp_theme_components_register_styles() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'twentytwenty-style', get_template_directory_uri() . '/style.css', array(), $theme_version );
	wp_enqueue_style( 'wp-theme-components-style', get_stylesheet_uri(), array( 'twentytwenty-style' ), $theme_version );
}

add_action( 'wp_enqueue_scripts', 'wp_theme_components_register_styles' );

/**
 * Add accordion script for Yoast SEO FAQ blocks
 */
function wp_theme_components_faq_script() {
	?>
	<script>
		jQuery( document ).ready( function() {
			jQuery( '.schema-faq-question' ).click( function() {
				var $this = jQuery( this );
				$this.siblings( '.schema-faq-answer' ).slideToggle();
				$this.toggleClass( 'schema-faq-question--active' );
			})
		});
	</script>
	<?php
}

add_action( 'wp_footer', 'wp_theme_components_faq_script' );

/**
 * Include other PHP files
 */
function wp_theme_components_files() {
	require_once 'components.php';
}

add_action( 'after_setup_theme', 'wp_theme_components_files', -1000 );

/**
 * Change the archive title for EDD downloads
 *
 * @param string $title Archive title.
 * @return string
 */
function wp_theme_components_downloads_archive_title( $title ) {
	if ( is_post_type_archive( 'download' ) ) {
		$title = 'Components Directory';
	}
	return $title;
}

add_filter( 'get_the_archive_title', 'wp_theme_components_downloads_archive_title', 11 );

/**
 * Redirect single downloads to the archive for now
 */
function wp_theme_components_redirect_single_download() {
	if ( is_singular( 'download' ) ) {
		wp_safe_redirect( get_post_type_archive_link( 'download' ) );
	}
}

add_action( 'template_redirect', 'wp_theme_components_redirect_single_download' );
