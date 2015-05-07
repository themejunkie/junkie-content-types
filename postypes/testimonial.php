<?php
/**
 * Testimonials post type.
 */

/**
 * Register the post type
 */
function junkie_types_register_testimonial_post_type() {

	if ( post_type_exists( 'testimonial' ) ) {
		return;
	}

	$labels = array(
		'name'               => esc_html__( 'Testimonials',                   'junkie-types' ),
		'singular_name'      => esc_html__( 'Testimonial',                    'junkie-types' ),
		'menu_name'          => esc_html__( 'Testimonials',                   'junkie-types' ),
		'all_items'          => esc_html__( 'All Testimonials',               'junkie-types' ),
		'add_new'            => esc_html__( 'Add New',                        'junkie-types' ),
		'add_new_item'       => esc_html__( 'Add New Testimonial',            'junkie-types' ),
		'edit_item'          => esc_html__( 'Edit Testimonial',               'junkie-types' ),
		'new_item'           => esc_html__( 'New Testimonial',                'junkie-types' ),
		'view_item'          => esc_html__( 'View Testimonial',               'junkie-types' ),
		'search_items'       => esc_html__( 'Search Testimonials',            'junkie-types' ),
		'not_found'          => esc_html__( 'No Testimonials found',          'junkie-types' ),
		'not_found_in_trash' => esc_html__( 'No Testimonials found in Trash', 'junkie-types' ),
	);

	$args = array(
		'labels' => apply_filters( 'junkie_types_testimonial_labels', $labels ),
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
			'page-attributes',
		),
		'rewrite' => array(
			'slug'       => 'testimonial',
			'with_front' => false,
			'feeds'      => true,
			'pages'      => true,
		),
		'public'              => true,
		'exclude_from_search' => true,
		'show_ui'             => true,
		'menu_position'       => 24,
		'menu_icon'           => 'dashicons-testimonial',
		'capability_type'     => 'page',
		'map_meta_cap'        => true,
		'has_archive'         => true,
		'query_var'           => true,
	);

	register_post_type( 'testimonial', apply_filters( 'junkie_types_testimonial_args', $args ) );

}
add_action( 'init', 'junkie_types_register_testimonial_post_type' );

/**
 * Change ‘Enter Title Here’ text for the Testimonials post type.
 */
function junkie_types_change_testimonial_default_title( $title ) {
	$screen = get_current_screen();

	if ( 'testimonial' == $screen->post_type ) {
		$title = esc_html__( "Enter the customer's name here", 'junkie-types' );
	}

	return $title;
}
add_filter( 'enter_title_here', 'junkie_types_change_testimonial_default_title' );

/**
 * Update messages for the Testimonials admin.
 */
function junkie_types_testimonial_updated_messages( $messages ) {
	global $post;

	$messages['testimonial'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => sprintf( __( 'Testimonial updated. <a href="%s">View Testimonial</a>', 'junkie-types'), esc_url( get_permalink( $post->ID ) ) ),
		2  => esc_html__( 'Custom field updated.', 'junkie-types' ),
		3  => esc_html__( 'Custom field deleted.', 'junkie-types' ),
		4  => esc_html__( 'Testimonial updated.', 'junkie-types' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Testimonial restored to revision from %s', 'junkie-types'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Testimonial published. <a href="%s">View testimonial</a>', 'junkie-types' ), esc_url( get_permalink( $post->ID ) ) ),
		7  => esc_html__( 'Testimonial saved.', 'junkie-types' ),
		8  => sprintf( __( 'Testimonial submitted. <a target="_blank" href="%s">Preview testimonial</a>', 'junkie-types'), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post->ID ) ) ) ),
		9  => sprintf( __( 'Testimonial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview testimonial</a>', 'junkie-types' ),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i', 'junkie-types' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post->ID ) ) ),
		10 => sprintf( __( 'Testimonial draft updated. <a target="_blank" href="%s">Preview testimonial</a>', 'junkie-types' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post->ID ) ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'junkie_types_testimonial_updated_messages' );

/**
 * Change ‘Title’ column label
 * Add Featured Image column
 */
function junkie_types_edit_testimonial_admin_columns( $columns ) {
	unset( $columns['title'] );

	$new_columns = array(
		'cb'    => '<input type="checkbox" />',
		'title' => __( 'Customer Name', 'junkie-types' )
	);

	if ( current_theme_supports( 'post-thumbnails' ) ) {
		$new_columns['thumbnail'] = __( 'Photo', 'junkie-types' );
	}

	return array_merge( $new_columns, $columns );

	return $columns;
}
add_filter( 'manage_edit-testimonial_columns', 'junkie_types_edit_testimonial_admin_columns' );

/**
 * Add featured image to column
 */
function junkie_types_testimonial_image_column( $column, $post_id ) {
	global $post;

	switch ( $column ) {
		case 'thumbnail':
			echo get_the_post_thumbnail( $post_id, 'junkie-types-column-image' );
			break;
	}
}
add_filter( 'manage_testimonial_posts_custom_column', 'junkie_types_testimonial_image_column', 10, 2 );