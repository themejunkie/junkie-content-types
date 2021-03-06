<?php
/**
 * Department post type.
 */

/**
 * Register the post type
 */
function junkie_types_register_department_post_type() {

	if ( post_type_exists( 'department' ) ) {
		return;
	}

	$labels = array(
		'name'               => esc_html__( 'Departments',                   'junkie-types' ),
		'singular_name'      => esc_html__( 'Department',                    'junkie-types' ),
		'menu_name'          => esc_html__( 'Departments',                   'junkie-types' ),
		'all_items'          => esc_html__( 'All Departments',               'junkie-types' ),
		'add_new'            => esc_html__( 'Add New',                       'junkie-types' ),
		'add_new_item'       => esc_html__( 'Add New Department',            'junkie-types' ),
		'edit_item'          => esc_html__( 'Edit Department',               'junkie-types' ),
		'new_item'           => esc_html__( 'New Department',                'junkie-types' ),
		'view_item'          => esc_html__( 'View Department',               'junkie-types' ),
		'search_items'       => esc_html__( 'Search Departments',            'junkie-types' ),
		'not_found'          => esc_html__( 'No Departments found',          'junkie-types' ),
		'not_found_in_trash' => esc_html__( 'No Departments found in Trash', 'junkie-types' ),
	);

	$args = array(
		'labels' => apply_filters( 'junkie_types_department_labels', $labels ),
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'excerpt',
			'revisions',
			'page-attributes',
		),
		'rewrite' => array(
			'slug'       => 'department',
			'with_front' => false,
			'feeds'      => true,
			'pages'      => true,
		),
		'public'              => true,
		'exclude_from_search' => true,
		'show_ui'             => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-clipboard',
		'capability_type'     => 'page',
		'map_meta_cap'        => true,
		'has_archive'         => true,
		'query_var'           => true,
	);

	register_post_type( 'department', apply_filters( 'junkie_types_department_args', $args ) );

}
add_action( 'init', 'junkie_types_register_department_post_type' );

/**
 * Change ‘Enter Title Here’ text for the Departments post type.
 */
function junkie_types_change_department_default_title( $title ) {
	$screen = get_current_screen();

	if ( 'department' == $screen->post_type ) {
		$title = esc_html__( "Enter the department's name here", 'junkie-types' );
	}

	return $title;
}
add_filter( 'enter_title_here', 'junkie_types_change_department_default_title' );

/**
 * Update messages for the Departments admin.
 */
function junkie_types_department_updated_messages( $messages ) {
	global $post;

	$messages['department'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => sprintf( __( 'Department updated. <a href="%s">View Department</a>', 'junkie-types'), esc_url( get_permalink( $post->ID ) ) ),
		2  => esc_html__( 'Custom field updated.', 'junkie-types' ),
		3  => esc_html__( 'Custom field deleted.', 'junkie-types' ),
		4  => esc_html__( 'Department updated.', 'junkie-types' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Department restored to revision from %s', 'junkie-types'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Department published. <a href="%s">View department</a>', 'junkie-types' ), esc_url( get_permalink( $post->ID ) ) ),
		7  => esc_html__( 'Department saved.', 'junkie-types' ),
		8  => sprintf( __( 'Department submitted. <a target="_blank" href="%s">Preview department</a>', 'junkie-types'), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post->ID ) ) ) ),
		9  => sprintf( __( 'Department scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview department</a>', 'junkie-types' ),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i', 'junkie-types' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post->ID ) ) ),
		10 => sprintf( __( 'Department draft updated. <a target="_blank" href="%s">Preview department</a>', 'junkie-types' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post->ID ) ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'junkie_types_department_updated_messages' );

/**
 * Change ‘Title’ column label
 * Add Featured Image column
 */
function junkie_types_edit_department_admin_columns( $columns ) {
	unset( $columns['title'] );

	$new_columns = array(
		'cb'    => '<input type="checkbox" />',
		'title' => __( 'Name', 'junkie-types' )
	);

	if ( current_theme_supports( 'post-thumbnails' ) ) {
		$new_columns['thumbnail'] = __( 'Picture', 'junkie-types' );
	}

	return array_merge( $new_columns, $columns );

	return $columns;
}
add_filter( 'manage_edit-department_columns', 'junkie_types_edit_department_admin_columns' );

/**
 * Add featured image to column
 */
function junkie_types_department_image_column( $column, $post_id ) {
	global $post;

	switch ( $column ) {
		case 'thumbnail':
			echo get_the_post_thumbnail( $post_id, 'junkie-types-column-image' );
			break;
	}
}
add_filter( 'manage_department_posts_custom_column', 'junkie_types_department_image_column', 10, 2 );