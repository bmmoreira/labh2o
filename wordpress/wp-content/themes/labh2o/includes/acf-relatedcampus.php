<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_63e6a7b84518b',
	'title' => 'Related Campus',
	'fields' => array(
		array(
			'key' => 'field_63e6a7b99b8f6',
			'label' => 'Related	Campus(es)',
			'name' => 'related_campus',
			'aria-label' => '',
			'type' => 'relationship',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'campus',
			),
			'taxonomy' => '',
			'filters' => array(
				0 => 'search',
			),
			'return_format' => 'object',
			'min' => '',
			'max' => '',
			'elements' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'program',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
));

endif;		