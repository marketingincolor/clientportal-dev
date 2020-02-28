<?php
/**
 * Customizer sections.
 *
 * @package Client Portal
 */

/**
 * Register the section sections.
 *
 * @author WDS
 * @param object $wp_customize Instance of WP_Customize_Class.
 */
function client_portal_customize_sections( $wp_customize ) {

	// Register additional scripts section.
	$wp_customize->add_section(
		'client_portal_additional_scripts_section',
		array(
			'title'    => esc_html__( 'Additional Scripts', 'client-portal' ),
			'priority' => 10,
			'panel'    => 'site-options',
		)
	);

	// Register a social links section.
	$wp_customize->add_section(
		'client_portal_social_links_section',
		array(
			'title'       => esc_html__( 'Social Media', 'client-portal' ),
			'description' => esc_html__( 'Links here power the display_social_network_links() template tag.', 'client-portal' ),
			'priority'    => 90,
			'panel'       => 'site-options',
		)
	);

	// Register a header section.
	$wp_customize->add_section(
		'client_portal_header_section',
		array(
			'title'    => esc_html__( 'Header Customizations', 'client-portal' ),
			'priority' => 90,
			'panel'    => 'site-options',
		)
	);

	// Register a footer section.
	$wp_customize->add_section(
		'client_portal_footer_section',
		array(
			'title'    => esc_html__( 'Footer Customizations', 'client-portal' ),
			'priority' => 90,
			'panel'    => 'site-options',
		)
	);
}
add_action( 'customize_register', 'client_portal_customize_sections' );
