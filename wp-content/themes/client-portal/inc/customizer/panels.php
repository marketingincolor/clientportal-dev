<?php
/**
 * Customizer panels.
 *
 * @package Client Portal
 */

/**
 * Add a custom panels to attach sections too.
 *
 * @author WDS
 * @param object $wp_customize Instance of WP_Customize_Class.
 */
function client_portal_customize_panels( $wp_customize ) {

	// Register a new panel.
	$wp_customize->add_panel(
		'site-options',
		array(
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Site Options', 'client-portal' ),
			'description'    => esc_html__( 'Other theme options.', 'client-portal' ),
		)
	);
}
add_action( 'customize_register', 'client_portal_customize_panels' );
