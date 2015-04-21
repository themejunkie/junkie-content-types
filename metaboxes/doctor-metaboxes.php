<?php
/**
 * Doctor metaboxes.
 */

/**
 * Registers new meta boxes.
 */
function junkie_types_register_doctor_metaboxes() {

	// Check current screen.
	if ( 'doctor' != get_current_screen()->post_type )
		return;

	// Register the meta box.
	add_meta_box( 
		'junkie-types-doctor-metaboxes',
		esc_html__( 'Social Options', 'junkie-types' ),
		'junkie_types_doctor_metaboxes_display',
		'doctor',
		'normal',
		'high'
	);

}
add_action( 'add_meta_boxes', 'junkie_types_register_doctor_metaboxes' );

/**
 * Displays the content of the meta boxes.
 */
function junkie_types_doctor_metaboxes_display( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'junkie-types-doctor-metaboxes-nonce' ); ?>

	<?php do_action( 'junkie_types_doctor_metaboxes_before' ); ?>

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-doctor-twitter">
				<strong><?php _e( 'Twitter', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'Twitter URL.', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-doctor-twitter" id="junkie-types-doctor-twitter" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_doctor_twitter_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://twitter.com/username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-doctor-facebook">
				<strong><?php _e( 'Facebook', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'Facebook URL.', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-doctor-facebook" id="junkie-types-doctor-facebook" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_doctor_facebook_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'http://www.facebook.com/username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-doctor-gplus">
				<strong><?php _e( 'Google Plus', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'Google Plus URL.', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-doctor-gplus" id="junkie-types-doctor-gplus" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_doctor_googleplus_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://plus.google.com/+username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-doctor-linkedin">
				<strong><?php _e( 'LinkedIn', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'LinkedIn URL.', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-doctor-linkedin" id="junkie-types-doctor-linkedin" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_doctor_linkedin_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://www.linkedin.com/in/username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-doctor-pinterest">
				<strong><?php _e( 'Pinterest', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'Pinterest URL.', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-doctor-pinterest" id="junkie-types-doctor-pinterest" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_doctor_pinterest_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://pinterest.com/username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-doctor-dribbble">
				<strong><?php _e( 'Dribbble', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'Dribbble URL.', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-doctor-dribbble" id="junkie-types-doctor-dribbble" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_doctor_dribbble_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://dribbble.com/username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<?php do_action( 'junkie_types_doctor_metaboxes_after' ); ?>

	<?php
}

/**
 * Saves the metadata.
 */
function junkie_types_doctor_save_metaboxes( $post_id, $post ) {

	if ( ! isset( $_POST['junkie-types-doctor-metaboxes-nonce'] ) || ! wp_verify_nonce( $_POST['junkie-types-doctor-metaboxes-nonce'], basename( __FILE__ ) ) )
		return;

	if ( ! current_user_can( 'edit_post', $post_id ) )
		return;

	$meta = array(
		'junkie_types_doctor_twitter_url'    => esc_url_raw( $_POST['junkie-types-doctor-twitter'] ),
		'junkie_types_doctor_facebook_url'   => esc_url_raw( $_POST['junkie-types-doctor-facebook'] ),
		'junkie_types_doctor_googleplus_url' => esc_url_raw( $_POST['junkie-types-doctor-gplus'] ),
		'junkie_types_doctor_linkedin_url'   => esc_url_raw( $_POST['junkie-types-doctor-linkedin'] ),
		'junkie_types_doctor_pinterest_url'  => esc_url_raw( $_POST['junkie-types-doctor-pinterest'] ),
		'junkie_types_doctor_dribbble_url'   => esc_url_raw( $_POST['junkie-types-doctor-dribbble'] )
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
add_action( 'save_post', 'junkie_types_doctor_save_metaboxes', 10, 2 );

/**
 * Replace 'Featured Image' title.
 */
function junkie_types_doctor_replace_featured_image_title() {

	// Check current screen.
	if ( 'doctor' != get_current_screen()->post_type )
		return;

    remove_meta_box( 'postimagediv', 'doctor', 'side' );
    add_meta_box( 'postimagediv', __( "Doctor's Photo", 'junkie-types' ), 'post_thumbnail_meta_box', 'doctor', 'side', 'default' );

}
add_action( 'do_meta_boxes', 'junkie_types_doctor_replace_featured_image_title' );