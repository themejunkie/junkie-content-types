<?php
/**
 * Service metaboxes.
 */

/**
 * Replace 'Featured Image' title.
 */
function junkie_types_feature_replace_featured_image_title() {

	// Check current screen.
	if ( 'feature' != get_current_screen()->post_type )
		return;

    remove_meta_box( 'postimagediv', 'feature', 'side' );
    add_meta_box( 'postimagediv', __( 'Feature Picture', 'junkie-types' ), 'post_thumbnail_meta_box', 'feature', 'side', 'default' );

}
add_action( 'do_meta_boxes', 'junkie_types_feature_replace_featured_image_title' );