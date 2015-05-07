<?php
/**
 * Team metaboxes.
 */

/**
 * Registers new meta boxes.
 */
function junkie_types_register_team_metaboxes() {

	// Check current screen.
	if ( 'team' != get_current_screen()->post_type )
		return;

	// Register the meta box.
	add_meta_box( 
		'junkie-types-team-metaboxes',
		esc_html__( 'Social Options', 'junkie-types' ),
		'junkie_types_team_metaboxes_display',
		'team',
		'normal',
		'default'
	);

}
add_action( 'add_meta_boxes', 'junkie_types_register_team_metaboxes' );

/**
 * Displays the content of the meta boxes.
 */
function junkie_types_team_metaboxes_display( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'junkie-types-team-metaboxes-nonce' ); ?>

	<?php do_action( 'junkie_types_team_metaboxes_before' ); ?>

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-team-twitter">
				<strong><?php _e( 'Twitter', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'Twitter URL.', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-team-twitter" id="junkie-types-team-twitter" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_team_twitter_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://twitter.com/username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-team-facebook">
				<strong><?php _e( 'Facebook', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'Facebook URL.', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-team-facebook" id="junkie-types-team-facebook" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_team_facebook_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'http://www.facebook.com/username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-team-gplus">
				<strong><?php _e( 'Google Plus', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'Google Plus URL.', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-team-gplus" id="junkie-types-team-gplus" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_team_googleplus_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://plus.google.com/+username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-team-linkedin">
				<strong><?php _e( 'LinkedIn', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'LinkedIn URL.', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-team-linkedin" id="junkie-types-team-linkedin" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_team_linkedin_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://www.linkedin.com/in/username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-team-pinterest">
				<strong><?php _e( 'Pinterest', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'Pinterest URL.', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-team-pinterest" id="junkie-types-team-pinterest" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_team_pinterest_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://pinterest.com/username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-team-dribbble">
				<strong><?php _e( 'Dribbble', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'Dribbble URL.', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-team-dribbble" id="junkie-types-team-dribbble" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_team_dribbble_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://dribbble.com/username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<?php do_action( 'junkie_types_team_metaboxes_after' ); ?>

	<?php
}

/**
 * Saves the metadata.
 */
function junkie_types_team_save_metaboxes( $post_id, $post ) {

	if ( ! isset( $_POST['junkie-types-team-metaboxes-nonce'] ) || ! wp_verify_nonce( $_POST['junkie-types-team-metaboxes-nonce'], basename( __FILE__ ) ) )
		return;

	if ( ! current_user_can( 'edit_post', $post_id ) )
		return;

	$meta = array(
		'junkie_types_team_twitter_url'    => esc_url_raw( $_POST['junkie-types-team-twitter'] ),
		'junkie_types_team_facebook_url'   => esc_url_raw( $_POST['junkie-types-team-facebook'] ),
		'junkie_types_team_googleplus_url' => esc_url_raw( $_POST['junkie-types-team-gplus'] ),
		'junkie_types_team_linkedin_url'   => esc_url_raw( $_POST['junkie-types-team-linkedin'] ),
		'junkie_types_team_pinterest_url'  => esc_url_raw( $_POST['junkie-types-team-pinterest'] ),
		'junkie_types_team_dribbble_url'   => esc_url_raw( $_POST['junkie-types-team-dribbble'] )
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
add_action( 'save_post', 'junkie_types_team_save_metaboxes', 10, 2 );

/**
 * Replace 'Featured Image' title.
 */
function junkie_types_team_replace_featured_image_title() {

	// Check current screen.
	if ( 'team' != get_current_screen()->post_type )
		return;

    remove_meta_box( 'postimagediv', 'team', 'side' );
    add_meta_box( 'postimagediv', __( "Team's Photo", 'junkie-types' ), 'post_thumbnail_meta_box', 'team', 'side', 'default' );

}
add_action( 'do_meta_boxes', 'junkie_types_team_replace_featured_image_title' );