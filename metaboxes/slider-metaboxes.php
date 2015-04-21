<?php
/**
 * Slider metaboxes.
 */

/**
 * Registers new meta boxes.
 */
function junkie_types_register_slider_metaboxes() {

	// Check current screen.
	if ( 'slider' != get_current_screen()->post_type )
		return;

	// Register the meta box.
	add_meta_box( 
		'junkie-types-slider-metaboxes',
		esc_html__( 'Slide URL', 'junkie-types' ),
		'junkie_types_slider_metaboxes_display',
		'slider',
		'side',
		'default'
	);

}
add_action( 'add_meta_boxes', 'junkie_types_register_slider_metaboxes' );

/**
 * Displays the content of the meta boxes.
 */
function junkie_types_slider_metaboxes_display( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'junkie-types-slider-metaboxes-nonce' ); ?>

	<?php do_action( 'junkie_types_slider_metaboxes_before' ); ?>
	
		<p>
			<input type="text" name="junkie-types-slider-url" id="junkie-types-slider-url" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_slider_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'http://' ); ?>" />
		</p>

	<?php do_action( 'junkie_types_slider_metaboxes_after' ); ?>

	<?php
}

/**
 * Saves the metadata.
 */
function junkie_types_slider_save_metaboxes( $post_id, $post ) {

	if ( ! isset( $_POST['junkie-types-slider-metaboxes-nonce'] ) || ! wp_verify_nonce( $_POST['junkie-types-slider-metaboxes-nonce'], basename( __FILE__ ) ) )
		return;

	if ( ! current_user_can( 'edit_post', $post_id ) )
		return;

	$meta = array(
		'junkie_types_slider_url'  => esc_url_raw( $_POST['junkie-types-slider-url'] ),
	);

	foreach ( $meta as $meta_key => $new_meta_value ) {

		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If there is no new meta value but an old value exists, delete it. */
		if ( current_user_can( 'delete_post_meta', $post_id, $meta_key ) && '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );

		/* If a new meta value was added and there was no previous value, add it. */
		elseif ( current_user_can( 'add_post_meta', $post_id, $meta_key ) && $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );

		/* If the new meta value does not match the old value, update it. */
		elseif ( current_user_can( 'edit_post_meta', $post_id, $meta_key ) && $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );
	}

}
add_action( 'save_post', 'junkie_types_slider_save_metaboxes', 10, 2 );

/**
 * Replace 'Featured Image' title.
 */
function junkie_types_slider_replace_featured_image_title() {

	// Check current screen.
	if ( 'slider' != get_current_screen()->post_type )
		return;

    remove_meta_box( 'postimagediv', 'slider', 'side' );
    add_meta_box( 'postimagediv', __( 'Slider Image', 'junkie-types' ), 'post_thumbnail_meta_box', 'slider', 'side', 'default' );

}
add_action( 'do_meta_boxes', 'junkie_types_slider_replace_featured_image_title' );