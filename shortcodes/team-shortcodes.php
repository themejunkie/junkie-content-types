<?php
/**
 * Team post type shortcode
 */

/**
 * Our [team] shortcode.
 * Prints Portfolio data styled to look good on *any* theme.
 *
 * @return team_shortcode_html
 */
function junkie_types_teams_shortcode( $atts ) {

	// Default attributes
	$atts = shortcode_atts( array(
		'display_position'  => true,
		'display_social'    => true,
		'display_content'   => true,
		'include_position'  => false,
		'columns'           => 2,
		'showposts'         => -1,
		'order'             => 'desc',
		'orderby'           => 'date',
	), $atts, 'team' );

	// A little sanitization
	if ( $atts['display_position'] && 'true' != $atts['display_position'] ) {
		$atts['display_position'] = false;
	}

	if ( $atts['display_social'] && 'true' != $atts['display_social'] ) {
		$atts['display_social'] = false;
	}

	if ( $atts['display_content'] && 'true' != $atts['display_content'] ) {
		$atts['display_content'] = false;
	}

	if ( $atts['include_position'] ) {
		$atts['include_position'] = explode( ',', str_replace( ' ', '', $atts['include_position'] ) );
	}

	$atts['columns'] = absint( $atts['columns'] );

	$atts['showposts'] = intval( $atts['showposts'] );


	if ( $atts['order'] ) {
		$atts['order'] = urldecode( $atts['order'] );
		$atts['order'] = strtoupper( $atts['order'] );
		if ( 'ASC' != $atts['order'] ) {
			$atts['order'] = 'DESC';
		}
	}

	if ( $atts['orderby'] ) {
		$atts['orderby'] = urldecode( $atts['orderby'] );
		$atts['orderby'] = strtolower( $atts['orderby'] );
		$allowed_keys = array( 'date', 'title', 'rand', 'menu_order' );

		$parsed = array();
		foreach ( explode( ',', $atts['orderby'] ) as $portfolio_index_number => $orderby ) {
			if ( ! in_array( $orderby, $allowed_keys ) ) {
				continue;
			}
			$parsed[] = $orderby;
		}

		if ( empty( $parsed ) ) {
			unset( $atts['orderby'] );
		} else {
			$atts['orderby'] = implode( ' ', $parsed );
		}
	}

	// enqueue shortcode styles when shortcode is used
	wp_enqueue_style( 'junkie-types-frontend-style', trailingslashit( JUNKIE_TYPES_ASSETS ) . 'css/junkie-types.css', array() );

	return self::junkie_types_teams_shortcode_html( $atts );

}
add_shortcode( 'teams', 'junkie_types_teams_shortcode' );

/**
 * Query to retrieve entries from the Team post_type.
 *
 * @return object
 */
function junkie_types_teams_query( $atts ) {

	// Default query arguments
	$default = array(
		'order'          => $atts['order'],
		'orderby'        => $atts['orderby'],
		'posts_per_page' => $atts['showposts'],
	);

	$args = wp_parse_args( $atts, $default );
	$args['post_type'] = 'teams'; // Force this post type

	// If 'include_position' has been set use it on the main query
	if ( false != $atts['include_position'] ) {
		array_push( $args['tax_query'], array(
			'taxonomy' => 'position',
			'field'    => 'slug',
			'terms'    => $atts['include_position'],
		) );
	}

	// Run the query and return
	$query = new WP_Query( $args );
	return $query;
}

/**
 * The Team shortcode loop.
 *
 * @return html
 */
function junkie_types_teams_shortcode_html( $atts ) {

	$query = junkie_types_teams_query( $atts );
	$team_index_number = 0;

	if ( $query->have_posts() ) {

		ob_start(); ?>

		<div class="team-members column-<?php echo esc_attr( $atts['columns'] ); ?>">
			<ul class="members">

				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php $post_id = get_the_ID(); ?>

					<li class="member <?php echo esc_attr( get_project_class( $team_index_number, $atts['columns'] ) ); ?>">
						
						<div class="member-photo">
							<?php if ( has_post_thumbnail( $post_id ) ) : ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( apply_filters( 'junkie_types_teams_image_size', 'thumbnail' ), array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
							<?php endif; ?>

							<?php if ( false != $atts['display_social'] ) : ?>
								<ul class="member-social clearfix">
									<li><a href="<?php echo esc_url( get_post_meta( $post_id, 'junkie_types_teams_twitter_url', true ) ); ?>"><i class="fa fa-twitter"></i></a></li>
									<li><a href="<?php echo esc_url( get_post_meta( $post_id, 'junkie_types_teams_facebook_url', true ) ); ?>"><i class="fa fa-facebook"></i></a></li>
									<li><a href="<?php echo esc_url( get_post_meta( $post_id, 'junkie_types_teams_googleplus_url', true ) ); ?>"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="<?php echo esc_url( get_post_meta( $post_id, 'junkie_types_teams_linkedin_url', true ) ); ?>"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="<?php echo esc_url( get_post_meta( $post_id, 'junkie_types_teams_pinterest_url', true ) ); ?>"><i class="fa fa-pinterest"></i></a></li>
									<li><a href="<?php echo esc_url( get_post_meta( $post_id, 'junkie_types_teams_dribbble_url', true ) ); ?>"><i class="fa fa-dribbble"></i></a></li>
								</ul>
							<?php endif; ?>
						</div>

						<div class="member-content">
							<?php the_title( '<h3 class="member-name">', '</h3>' ); ?>

							<p class="member-position"><?php echo esc_attr( get_post_meta( get_the_ID(), 'tj_member_position', true ) ); ?></p>

							<?php if ( false != $atts['display_content'] ) : ?>
								<div class="member-desc"><?php the_content(); ?></div>
							<?php endif; ?>
						</div>

					</li>

					<?php $team_index_number++; ?>
				<?php endwhile; wp_reset_postdata(); ?>
			</ul>
		</div>

	<?php } else { ?>
		<p><em><?php _e( 'Your Portfolio Archive currently has no entries. You can start creating them on your dashboard.', 'jetpack' ); ?></p></em>
	<?php
	}
	$html = ob_get_clean();

	// If there is a [portfolio] within a [portfolio], remove the shortcode
	if ( has_shortcode( $html, 'portfolio' ) ){
		remove_shortcode( 'portfolio' );
	}

	// Return the HTML block
	return $html;
}