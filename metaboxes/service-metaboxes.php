<?php
/**
 * Service metaboxes.
 */

/**
 * Replace 'Featured Image' title.
 */
function junkie_types_service_replace_featured_image_title() {

	// Check current screen.
	if ( 'service' != get_current_screen()->post_type )
		return;

    remove_meta_box( 'postimagediv', 'service', 'side' );
    add_meta_box( 'postimagediv', __( 'Service Picture', 'junkie-types' ), 'post_thumbnail_meta_box', 'service', 'side', 'default' );

}
add_action( 'do_meta_boxes', 'junkie_types_service_replace_featured_image_title' );