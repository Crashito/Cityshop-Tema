<?php 

if( ! function_exists( 'road_get_slider_setting' ) ) {
	function road_get_slider_setting() {
		return array(
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Style', 'sinrato' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Grid view', 'sinrato' )                    => 'product-grid',
					__( 'List view 1', 'sinrato' )                  => 'product-list',
					__( 'List view 2', 'sinrato' )                  => 'product-list-2',
					__( 'Grid view with countdown', 'sinrato' )     => 'product-grid-countdown',
				),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Enable slider', 'sinrato' ),
				'description' => __( 'If slider is enabled, the "column" ins General group is the number of rows ', 'sinrato' ),
				'param_name'  => 'enable_slider',
				'value'       => true,
				'save_always' => true, 
				'group'       => __( 'Slider Options', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'heading'    => __( 'Number of columns (screen: over 1500px)', 'sinrato' ),
				'param_name' => 'items_1500up',
				'group'      => __( 'Slider Options', 'sinrato' ),
				'value'      => esc_html__( '4', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 1200px - 1499px)', 'sinrato' ),
				'param_name' => 'items_1200_1499',
				'group'      => __( 'Slider Options', 'sinrato' ),
				'value'      => esc_html__( '4', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 992px - 1199px)', 'sinrato' ),
				'param_name' => 'items_992_1199',
				'group'      => __( 'Slider Options', 'sinrato' ),
				'value'      => esc_html__( '4', 'sinrato' ),
			), 
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 768px - 991px)', 'sinrato' ),
				'param_name' => 'items_768_991',
				'group'      => __( 'Slider Options', 'sinrato' ),
				'value'      => esc_html__( '3', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 640px - 767px)', 'sinrato' ),
				'param_name' => 'items_640_767',
				'group'      => __( 'Slider Options', 'sinrato' ),
				'value'      => esc_html__( '2', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 480px - 639px)', 'sinrato' ),
				'param_name' => 'items_480_639',
				'group'      => __( 'Slider Options', 'sinrato' ),
				'value'      => esc_html__( '2', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: under 479px)', 'sinrato' ),
				'param_name' => 'items_0_479',
				'group'      => __( 'Slider Options', 'sinrato' ),
				'value'      => esc_html__( '1', 'sinrato' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Navigation', 'sinrato' ),
				'param_name'  => 'navigation',
				'save_always' => true,
				'group'       => __( 'Slider Options', 'sinrato' ),
				'value'       => array(
					__( 'Yes', 'sinrato' ) => true,
					__( 'No', 'sinrato' )  => false,
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Pagination', 'sinrato' ),
				'param_name'  => 'pagination',
				'save_always' => true,
				'group'       => __( 'Slider Options', 'sinrato' ),
				'value'       => array(
					__( 'No', 'sinrato' )  => false,
					__( 'Yes', 'sinrato' ) => true,
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Item Margin (unit: pixel)', 'sinrato' ),
				'param_name'  => 'item_margin',
				'value'       => 30,
				'save_always' => true,
				'group'       => __( 'Slider Options', 'sinrato' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Slider speed number (unit: second)', 'sinrato' ),
				'param_name'  => 'speed',
				'value'       => '500',
				'save_always' => true,
				'group'       => __( 'Slider Options', 'sinrato' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Slider loop', 'sinrato' ),
				'param_name'  => 'loop',
				'value'       => true,
				'group'       => __( 'Slider Options', 'sinrato' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Slider Auto', 'sinrato' ),
				'param_name'  => 'auto',
				'value'       => true,
				'group'       => __( 'Slider Options', 'sinrato' ),
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Navigation style', 'sinrato' ),
				'param_name'  => 'navigation_style',
				'group'       => __( 'Slider Options', 'sinrato' ),
				'value'       => array(
					'Navigation center horizontal'	=> 'navigation-style1',
					'Navigation top right'	        => 'navigation-style2',
				),
			),
		);
	}
}