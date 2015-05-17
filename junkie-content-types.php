<?php
/**
 * Plugin Name: Junkie Content Types
 * Plugin URI: https://wordpress.org/plugins/junkie-content-types/
 * Description: All-in-one custom content types.
 * Author: Theme Junkie
 * Version: 1.1.4
 * Author URI: http://www.theme-junkie.com/
 * License: GPL2+
 * Text Domain: junkie-types
 * Domain Path: /languages/
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Defines constants used by the plugin.
define( 'JUNKIE_TYPES_DIR',        trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'JUNKIE_TYPES_URI',        trailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'JUNKIE_TYPES_ADMIN',      JUNKIE_TYPES_DIR . trailingslashit( 'admin' ) );
define( 'JUNKIE_TYPES_TYPE',       JUNKIE_TYPES_DIR . trailingslashit( 'postypes' ) );
define( 'JUNKIE_TYPES_TAX',        JUNKIE_TYPES_DIR . trailingslashit( 'taxonomies' ) );
define( 'JUNKIE_TYPES_META',       JUNKIE_TYPES_DIR . trailingslashit( 'metaboxes' ) );
define( 'JUNKIE_TYPES_SHORTCODES', JUNKIE_TYPES_DIR . trailingslashit( 'shortcodes' ) );
define( 'JUNKIE_TYPES_INC',        JUNKIE_TYPES_DIR . trailingslashit( 'includes' ) );
define( 'JUNKIE_TYPES_WIDGETS',    JUNKIE_TYPES_DIR . trailingslashit( 'widgets' ) );
define( 'JUNKIE_TYPES_ASSETS',     JUNKIE_TYPES_URI . trailingslashit( 'assets' ) );

/**
 * Loads the translation files.
 */
function junkie_types_i18n() {
	load_plugin_textdomain( 'junkie-types', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'junkie_types_i18n' );

/**
 * Enqueue admin stylesheet.
 */
function junkie_types_enqueue_admin_styles( $hook ) {
	if ( 'post-new.php' == $hook || 'post.php' == $hook || 'edit.php' == $hook ) {
		wp_enqueue_style( 'junkie-types-style', trailingslashit( JUNKIE_TYPES_ASSETS ) . 'css/admin.css', array() );
	}
}
add_action( 'admin_enqueue_scripts', 'junkie_types_enqueue_admin_styles' );

/**
 * Remove rewrite rules and then recreate rewrite rules.
 */
function junkie_types_flush_rewrites() {
	flush_rewrite_rules();
}
register_activation_hook( __FILE__,   'junkie_types_flush_rewrites' );
register_deactivation_hook( __FILE__, 'junkie_types_flush_rewrites' );

/**
 * Plugin functions
 */
require_once( JUNKIE_TYPES_INC . 'functions.php' );

/**
 * Loads custom post type if the theme declare
 * 'add_theme_support( 'junkie-...' )'
 */
function junkie_types_theme_support() {

	/**
	 * Team post type, taxonomy, and metaboxes.
	 */
	if ( current_theme_supports( 'junkie-team' ) ) {
		require_once( JUNKIE_TYPES_TYPE . 'team.php' );
		require_once( JUNKIE_TYPES_TAX .  'team-tax.php' );
		require_once( JUNKIE_TYPES_META . 'team-metaboxes.php' );
	}

	/**
	 * Testimonial post type and metaboxes.
	 */
	if ( current_theme_supports( 'junkie-testimonial' ) ) {
		require_once( JUNKIE_TYPES_TYPE . 'testimonial.php' );
		require_once( JUNKIE_TYPES_META . 'testimonial-metaboxes.php' );
	}

	/**
	 * Doctors post type, taxonomy, and metaboxes.
	 */
	if ( current_theme_supports( 'junkie-doctor' ) ) {
		require_once( JUNKIE_TYPES_TYPE . 'doctor.php' );
		require_once( JUNKIE_TYPES_TAX .  'doctor-tax.php' );
		require_once( JUNKIE_TYPES_META . 'doctor-metaboxes.php' );
	}

	/**
	 * Departments post type and metaboxes.
	 */
	if ( current_theme_supports( 'junkie-department' ) ) {
		require_once( JUNKIE_TYPES_TYPE . 'department.php' );
		require_once( JUNKIE_TYPES_META . 'department-metaboxes.php' );
	}

	/**
	 * Services post type and metaboxes.
	 */
	if ( current_theme_supports( 'junkie-service' ) ) {
		require_once( JUNKIE_TYPES_TYPE . 'service.php' );
		require_once( JUNKIE_TYPES_META . 'service-metaboxes.php' );
	}

	/**
	 * Features post type and metaboxes.
	 */
	if ( current_theme_supports( 'junkie-feature' ) ) {
		require_once( JUNKIE_TYPES_TYPE . 'feature.php' );
		require_once( JUNKIE_TYPES_META . 'feature-metaboxes.php' );
	}

	/**
	 * Slider post type and metaboxes.
	 */
	if ( current_theme_supports( 'junkie-slider' ) ) {
		require_once( JUNKIE_TYPES_TYPE . 'slider.php' );
		require_once( JUNKIE_TYPES_META . 'slider-metaboxes.php' );
	}

}
add_action( 'init', 'junkie_types_theme_support', 1 );