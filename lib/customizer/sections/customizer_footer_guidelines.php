<?php

function footer_guideline_link_register($wp_customize) {

	$wp_customize->add_section(
		'guidelines_section',
			array(
				'title'       => 'Footer Guidelines',
			)
	);

	$wp_customize->add_setting('guidelines');

	$wp_customize->add_control(
		new WP_Customize_Upload_Control(
			$wp_customize,
			'guidelines',
			array(
				'label'       => 'Footer Guidelines',
				'description' => 'Upload the full guidelines here.',
				'section'     => 'guidelines_section',
				'settings'    => 'guidelines',
			)
		)
	);

}
add_action( 'customize_register', 'footer_guideline_link_register' );