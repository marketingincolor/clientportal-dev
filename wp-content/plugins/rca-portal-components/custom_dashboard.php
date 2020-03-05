<?php
/**
 * Our custom dashboard page
 */

/** WordPress Administration Bootstrap */
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );
?>

<div class="wrap about-wrap">
	<h1><?php _e( 'RCA Client Portal' ); ?></h1>

	<div class="about-text">
	<?php _e('Donec id elit non mi porta gravida at eget metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.' ); ?>
	</div>

	<!-- <h2 class="nav-tab-wrapper">
	<a href="#" class="nav-tab nav-tab-active">
	<?php _e( 'Step 1' ); ?>
	</a><a href="#" class="nav-tab">
	<?php _e( 'Step 2' ); ?>
	</a><a href="#" class="nav-tab">
	<?php _e( 'Step 3' ); ?>
	</a>
	</h2> -->

	<div class="changelog">
		<h3><?php _e( 'Morbi leo risus, porta ac consectetur' ); ?></h3>

		<div class="feature-section images-stagger-right">
			<h4><?php _e( 'Risus Consectetur Elit Sollicitudin' ); ?></h4>
			<p><?php _e( 'Cras mattis consectetur purus sit amet fermentum. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nulla vitae elit libero, a pharetra augue. Donec sed odio dui.' ); ?></p>
			<a class="button button-primary button-hero XXXload-customize XXXhide-if-no-customize" href="./edit.php?post_type=report"><?php _e( 'Manage Client Reports' ); ?></a>

			<h4><?php _e( 'Mattis Justo Purus' ); ?></h4>
			<p><?php _e( 'Aenean lacinia bibendum nulla sed consectetur. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.
			Cras mattis consectetur purus sit amet fermentum. Maecenas faucibus mollis interdum. Etiam porta sem malesuada magna mollis euismod. Maecenas faucibus mollis interdum. Curabitur blandit tempus porttitor. Cras justo odio, dapibus ac facilisis in, egestas eget quam.' ); ?></p>
		</div>
	</div>
</div>

<?php include( ABSPATH . 'wp-admin/admin-footer.php' );