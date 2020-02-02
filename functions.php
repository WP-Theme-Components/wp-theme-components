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
