<?php
/**
 * Plugin functions
 */

/**
 * Register new image size
 */
function junkie_types_new_image_size() {
	add_image_size( 'junkie-types-column-image', 50, 50, true );
}
add_action( 'init', 'junkie_types_new_image_size' );

/**
 * Remove 'theme-layouts' meta box.
 */
function junkie_types_remove_metabox() {
	remove_post_type_support( 'team', 'theme-layouts' );
	remove_post_type_support( 'testimonial', 'theme-layouts' );
	remove_post_type_support( 'doctor', 'theme-layouts' );
	remove_post_type_support( 'department', 'theme-layouts' );
	remove_post_type_support( 'feature', 'theme-layouts' );
	remove_post_type_support( 'service', 'theme-layouts' );
	remove_post_type_support( 'slider', 'theme-layouts' );
}
add_action( 'init', 'junkie_types_remove_metabox', 11 );