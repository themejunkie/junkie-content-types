<?php
/**
 * Additional metaboxes fields using ACF
 *
 */

if ( ! function_exists( 'acf_add_local_field_group' ) )
	return;

/* Skills */

acf_add_local_field_group(array (
	'key' => 'group_5755137eae144',
	'title' => esc_html__( 'Doctor Skills', 'junkie-types' ),
	'fields' => array (
		array (
			'key' => 'field_575514c561e87',
			'label' => esc_html__( "Doctor's Skills", 'junkie-types' ),
			'name' => 'tj_doctor_skill',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => '',
			'max' => '',
			'layout' => 'table',
			'button_label' => esc_html__( 'Add Skill', 'junkie-types' ),
			'sub_fields' => array (
				array (
					'key' => 'field_57551a2d61e88',
					'label' => esc_html__( 'Name', 'junkie-types' ),
					'name' => 'name',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_57551aa761e89',
					'label' => esc_html__( 'Rating (1-100)', 'junkie-types' ),
					'name' => 'rating',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => 1,
					'max' => 100,
					'step' => 1,
					'readonly' => 0,
					'disabled' => 0,
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'doctor',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'advanced',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => esc_html__( 'Additional fields for TJ Doctor Post Type', 'junkie-types' )
));