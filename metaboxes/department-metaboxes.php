<?php
/**
 * Department metaboxes.
 */

/**
 * Replace 'Featured Image' title.
 */
function junkie_types_department_replace_featured_image_title() {

	// Check current screen.
	if ( 'department' != get_current_screen()->post_type )
		return;

    remove_meta_box( 'postimagediv', 'department', 'side' );
    add_meta_box( 'postimagediv', __( "Department's Picture or Icon", 'junkie-types' ), 'post_thumbnail_meta_box', 'department', 'side', 'default' );

}
add_action( 'do_meta_boxes', 'junkie_types_department_replace_featured_image_title' );