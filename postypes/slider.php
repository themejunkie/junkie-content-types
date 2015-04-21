<?php
/**
 * Slider post type.
 */

/**
 * Register the post type
 */
function junkie_types_register_slider_post_type() {

	if ( post_type_exists( 'slider' ) ) {
		return;
	}

	$labels = array(
		'name'               => esc_html__( 'Sliders',                   'junkie-types' ),
		'singular_name'      => esc_html__( 'Slider',                    'junkie-types' ),
		'menu_name'          => esc_html__( 'Sliders',                   'junkie-types' ),
		'all_items'          => esc_html__( 'All Sliders',               'junkie-types' ),
		'add_new'            => esc_html__( 'Add New',                   'junkie-types' ),
		'add_new_item'       => esc_html__( 'Add New Slider',            'junkie-types' ),
		'edit_item'          => esc_html__( 'Edit Slider',               'junkie-types' ),
		'new_item'           => esc_html__( 'New Slider',                'junkie-types' ),
		'view_item'          => esc_html__( 'View Slider',               'junkie-types' ),
		'search_items'       => esc_html__( 'Search Sliders',            'junkie-types' ),
		'not_found'          => esc_html__( 'No Sliders found',          'junkie-types' ),
		'not_found_in_trash' => esc_html__( 'No Sliders found in Trash', 'junkie-types' ),
	);

	$args = array(
		'labels' => apply_filters( 'junkie_types_slider_labels', $labels ),
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
			'page-attributes',
		),
		'rewrite'             => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-images-alt',
		'capability_type'     => 'page',
		'has_archive'         => false,
		'query_var'           => false,
	);

	register_post_type( 'slider', apply_filters( 'junkie_types_slider_args', $args ) );

}
add_action( 'init', 'junkie_types_register_slider_post_type' );

/**
 * Change ‘Enter Title Here’ text for the Sliders post type.
 */
function junkie_types_change_slider_default_title( $title ) {
	$screen = get_current_screen();

	if ( 'slider' == $screen->post_type ) {
		$title = esc_html__( 'Enter the slider name here', 'junkie-types' );
	}

	return $title;
}
add_filter( 'enter_title_here', 'junkie_types_change_slider_default_title' );

/**
 * Update messages for the Sliders admin.
 */
function junkie_types_slider_updated_messages( $messages ) {
	global $post;

	$messages['slider'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => sprintf( __( 'Slider updated. <a href="%s">View Slider</a>', 'junkie-types'), esc_url( get_permalink( $post->ID ) ) ),
		2  => esc_html__( 'Custom field updated.', 'junkie-types' ),
		3  => esc_html__( 'Custom field deleted.', 'junkie-types' ),
		4  => esc_html__( 'Slider updated.', 'junkie-types' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Slider restored to revision from %s', 'junkie-types'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Slider published. <a href="%s">View slider</a>', 'junkie-types' ), esc_url( get_permalink( $post->ID ) ) ),
		7  => esc_html__( 'Slider saved.', 'junkie-types' ),
		8  => sprintf( __( 'Slider submitted. <a target="_blank" href="%s">Preview slider</a>', 'junkie-types'), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post->ID ) ) ) ),
		9  => sprintf( __( 'Slider scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview slider</a>', 'junkie-types' ),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i', 'junkie-types' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post->ID ) ) ),
		10 => sprintf( __( 'Slider draft updated. <a target="_blank" href="%s">Preview slider</a>', 'junkie-types' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post->ID ) ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'junkie_types_slider_updated_messages' );

/**
 * Change ‘Title’ column label
 * Add Featured Image column
 */
function junkie_types_edit_slider_admin_columns( $columns ) {
	unset( $columns['title'] );

	$new_columns = array(
		'cb'    => '<input type="checkbox" />',
		'title' => __( 'Name', 'junkie-types' )
	);

	if ( current_theme_supports( 'post-thumbnails' ) ) {
		$new_columns['thumbnail'] = __( 'Image', 'junkie-types' );
	}

	return array_merge( $new_columns, $columns );

	return $columns;
}
add_filter( 'manage_edit-slider_columns', 'junkie_types_edit_slider_admin_columns' );

/**
 * Add featured image to column
 */
function junkie_types_slider_image_column( $column, $post_id ) {
	global $post;

	switch ( $column ) {
		case 'thumbnail':
			echo get_the_post_thumbnail( $post_id, 'junkie-types-column-image' );
			break;
	}
}
add_filter( 'manage_slider_posts_custom_column', 'junkie_types_slider_image_column', 10, 2 );