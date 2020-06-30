<?php
/**
 * Our custom dashboard page
 */

/** WordPress Administration Bootstrap */
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );


/** Current User Customizations for Dashboard page */
$current_user = wp_get_current_user();
$user_metakey = 'user_' . $current_user->ID;
/*
 * @example Safe usage: $current_user = wp_get_current_user();
 * if ( ! ( $current_user instanceof WP_User ) ) {
 *     return;
 * }
 */
//printf( __( 'Username: %s <br />', 'textdomain' ), esc_html( $current_user->user_login ) );
//printf( __( 'User email: %s <br />', 'textdomain' ), esc_html( $current_user->user_email ) );
//printf( __( 'User first name: %s <br />', 'textdomain' ), esc_html( $current_user->user_firstname ) );
//printf( __( 'User last name: %s <br />', 'textdomain' ), esc_html( $current_user->user_lastname ) );
//printf( __( 'User display name: %s <br />', 'textdomain' ), esc_html( $current_user->display_name ) );
//printf( __( 'User ID: %s <br />', 'textdomain' ), esc_html( $current_user->ID ) );

if ( !empty( $current_user->roles ) && is_array( $current_user->roles ) ) {
	$roles = array();
	foreach ( $current_user->roles as $role ) {
		$roles[] .= translate_user_role( $role );
	}
}

if ( in_array('editor', $roles) || in_array('administrator', $roles) ) {
	//print('Staff<br />'); // is Staff Member
}
if ( in_array('subscriber', $roles) ) {
	//print('Client<br />'); // is Client
}

$term = get_field( 'company_name', $user_metakey );
if ( $term ):
	//printf( __( 'Company Name: %s <br />', 'textdomain' ), esc_html( $term->name ) );
	//printf( __( 'Slug: %s <br />', 'textdomain' ), esc_html( $term->slug ) );
endif;
?>



<!-- <?php if( current_user_can('editor') || current_user_can('administrator') ) : ?>

	<?php if( get_field('dash_title', 'client_options') ): ?>
	    <h2><?php the_field('dash_title', 'client_options'); ?></h2>
	<?php endif; ?>
	<?php if( get_field('dash_content', 'client_options') ): ?>
	    <?php the_field('dash_content', 'client_options'); ?>
	<?php endif; ?>

<?php endif; ?> -->


<?php 
if( current_user_can('editor') || current_user_can('administrator') ) { 
	$option_type = 'staff_options';
} else if( current_user_can('subscriber') ) {
	$option_type = 'client_options';
}
?>


<div id="main-nav" class="container align-center">
	<?php //the_custom_logo(); ?>
	<img src="<?php echo get_stylesheet_directory_uri() . '/images/rca-portal-logo.png'; ?>" class="dash-logo">
</div>

<div class="wrap about-wrap xcustom-wrap">

<?php if( get_field('dash_title', $option_type) ): ?>
    <h1><?php the_field('dash_title', $option_type); ?></h1>
<?php endif; ?>

<?php if( get_field('dash_about', $option_type) ): ?>
	<div class="about-text">
    <?php the_field('dash_about', $option_type); ?>
	</div>
<?php endif; ?>

	<div class="changelog">

		<div class="feature-section images-stagger-right">

		<?php if( get_field('dash_content', $option_type) ): ?>
		    <?php the_field('dash_content', $option_type); ?>
		<?php endif; ?>

<?php if( current_user_can('subscriber') ) : ?>
<!-- <a class="button button-primary button-hero XXXload-customize XXXhide-if-no-customize" href="./edit.php?post_type=report"><?php _e( 'View Reports' ); ?></a> -->

	<?php
	// using category slug
	$args = array(  
		'post_type' => 'report', 
		'posts_per_page' => -1, 
		'post_status' => 'publish',
		'orderby' => 'date', 
		'order' => 'DESC', 
		'tax_query' => array(
			array(
				'taxonomy' => 'clients',
				'field'    => 'slug', // term_id, slug  
				'terms'    => $term->slug,
			),
		)
	);
	$loop = new WP_Query($args);

	if ( $loop->have_posts() ) {
		echo '<h2>Current Reports</h2>';
	    echo '<ul>';
	    while ( $loop->have_posts() ) {
	        $loop->the_post();
	        echo '<li><a href="' . get_the_permalink() . '" class="custombutton">'  . get_the_title() . '</a>&nbsp;<a href="' . get_the_permalink() . '?output=pdf" class="custombutton">Download PDF</a></li>';
	    }
	    echo '</ul>';
	} else {
	    // no posts found
	}
	/* Restore original Post Data */
	wp_reset_postdata();?>


<?php endif; ?>

<?php if( current_user_can('editor') || current_user_can('administrator') ) : ?>
	<!-- <a class="button button-primary button-hero XXXload-customize XXXhide-if-no-customize" href="./edit.php?post_type=report"><?php _e( 'Manage Client Reports' ); ?></a> -->


	<h1 class="wp-heading-inline">Edit Reports</h1>
	<a href="<?php echo site_url(); ?>/wp-admin/post-new.php?post_type=report" class="page-title-action">Add New</a>
	<?php echo do_shortcode('[user_posts post_type="report" number="25"]'); ?>

<?php endif; ?>

		</div>
	</div>
</div>

<?php include( ABSPATH . 'wp-admin/admin-footer.php' );