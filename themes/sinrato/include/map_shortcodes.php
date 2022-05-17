<?php
//Shortcodes for Visual Composer
add_action( 'vc_before_init', 'sinrato_vc_shortcodes' );
function sinrato_vc_shortcodes() { 
	//Site logo
	vc_map( array(
		'name' => esc_html__( 'Logo', 'sinrato'),
		'description' => __( 'Insert logo image', 'sinrato' ),
		'base' => 'roadlogo',
		'class' => '',
		'category' => esc_html__( 'Theme', 'sinrato'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params' => array(
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload logo image', 'sinrato' ),
				'description'=> esc_html__( 'Note: For retina screen, logo image size is at least twice as width and height (width is set below) to display clearly', 'sinrato' ),
				'param_name' => 'logo_image',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Insert logo link or not', 'sinrato' ),
				'param_name' => 'logo_link',
				'value'      => array(
					'Yes'	=> 'yes',
					'No'	=> 'no',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Logo width (unit: px)', 'sinrato' ),
				'description'=> esc_html__( 'Insert number. Leave blank if you want to use original image size', 'sinrato' ),
				'param_name' => 'logo_width',
				'value'      => esc_html__( '150', 'sinrato' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )  => 'style1',
					__( 'Style 2', 'sinrato' )  => 'style2',
				),
			),
		)
	) );
	//Main Menu
	vc_map( array(
		'name'        => esc_html__( 'Main Menu', 'sinrato'),
		'description' => __( 'Set Primary Menu in Apperance - Menus - Manage Locations', 'sinrato' ),
		'base'        => 'roadmainmenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'sinrato'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'holder'      => 'div',
				'class'       => '',
				'heading'     => __( 'Set Primary Menu in Apperance - Menus - Manage Locations', 'sinrato' ),
				'description' => esc_html__( 'More settings in Theme Options - Main Menu', 'sinrato' ),
				'param_name'  => 'no_settings',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )  => 'style1',
					__( 'Style 2', 'sinrato' )  => 'style2',
				),
			),
		),
	) );
	//Sticky Menu
	vc_map( array(
		'name'        => esc_html__( 'Sticky Menu', 'sinrato'),
		'description' => __( 'Set Sticky Menu in Apperance - Menus - Manage Locations', 'sinrato' ),
		'base'        => 'roadstickymenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'sinrato'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'holder'      => 'div',
				'class'       => '',
				'heading'     => __( 'Set Sticky Menu in Apperance - Menus - Manage Locations', 'sinrato' ),
				'description' => esc_html__( 'More settings in Theme Options - Main Menu', 'sinrato' ),
				'param_name'  => 'no_settings',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )  => 'style1',
					__( 'Style 2', 'sinrato' )  => 'style2',
				),
			),
		),
	) );
	//Mobile Menu
	vc_map( array(
		'name'        => esc_html__( 'Mobile Menu', 'sinrato'),
		'description' => __( 'Set Mobile Menu in Apperance - Menus - Manage Locations', 'sinrato' ),
		'base'        => 'roadmobilemenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'sinrato'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'holder'      => 'div',
				'class'       => '',
				'heading'     => __( 'Set Mobile Menu in Apperance - Menus - Manage Locations', 'sinrato' ),
				'description' => esc_html__( 'More settings in Theme Options - Main Menu', 'sinrato' ),
				'param_name'  => 'no_settings',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )  => 'style1',
					__( 'Style 2', 'sinrato' )  => 'style2',
				),
			),
		),
	) );
	//Categories Menu
	vc_map( array(
		'name'        => esc_html__( 'Categories Menu', 'sinrato'),
		'description' => __( 'Set Categories Menu in Apperance - Menus - Manage Locations', 'sinrato' ),
		'base'        => 'roadcategoriesmenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'sinrato'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'holder'      => 'div',
				'class'       => '',
				'heading'     => __( 'Set Categories Menu in Apperance - Menus - Manage Locations', 'sinrato' ),
				'description' => esc_html__( 'More settings in Theme Options - Categories Menu', 'sinrato' ),
				'param_name'  => 'no_settings',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Show full Categories in home page ?', 'sinrato' ),
				'description' => esc_html__( 'In inner pages, it only shows the toogle', 'sinrato' ),
				'param_name' => 'categories_show_home',
				'value'      => array(
					__( 'No', 'sinrato' )  => 'false',
					__( 'Yes', 'sinrato' ) => 'true',
				),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )  => 'style1',
					__( 'Style 2', 'sinrato' )  => 'style2',
				),
			),
		),
	) );
	//Social Icons
	vc_map( array(
		'name'        => esc_html__( 'Social Icons', 'sinrato'),
		'description' => __( 'Configure icons and links in Theme Options', 'sinrato' ),
		'base'        => 'roadsocialicons',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'sinrato'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Configure icons and links in Theme Options > Social Icons', 'sinrato' ),
				'param_name' => 'no_settings',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )  => 'style1',
				),
			),
		),
	) );
	//Mini Cart
	vc_map( array(
		'name'        => esc_html__( 'Mini Cart', 'sinrato'),
		'description' => __( 'Mini Cart', 'sinrato' ),
		'base'        => 'roadminicart',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'sinrato'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )  => 'style1',
					__( 'Style 2', 'sinrato' )  => 'style2',
					__( 'Style 3', 'sinrato' )  => 'style3',
				),
			),
		),
	) );
	//Wishlist
	vc_map( array(
		'name'        => esc_html__( 'Wishlist', 'sinrato'),
		'description' => __( 'Wishlist', 'sinrato' ),
		'base'        => 'roadwishlist',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'sinrato'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )  => 'style1',
					__( 'Style 2', 'sinrato' )  => 'style2',
				),
			),
		),
	) );
	//Products Search without dropdown
	vc_map( array(
		'name'        => esc_html__( 'Product Search (No dropdown)', 'sinrato'),
		'description' => __( 'Product Search (No dropdown)', 'sinrato' ),
		'base'        => 'roadproductssearch',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'sinrato'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )  => 'style1',
					__( 'Style 2', 'sinrato' )  => 'style2',
					__( 'Style 3', 'sinrato' )  => 'style3',
				),
			),
		),
	) );
	//Products Search with dropdown
	vc_map( array(
		'name'        => esc_html__( 'Product Search (Dropdown)', 'sinrato'),
		'description' => __( 'Product Search (Dropdown)', 'sinrato' ),
		'base'        => 'roadproductssearchdropdown',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'sinrato'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'This widget does not have settings', 'sinrato' ),
				'param_name' => 'no_settings',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )  => 'style1',
				),
			),
		),
	) );
	//Image slider
	vc_map( array(
		'name'        => esc_html__( 'Image slider', 'sinrato' ),
		'description' => __( 'Upload images and links in Theme Options', 'sinrato' ),
		'base'        => 'image_slider',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'sinrato'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of rows', 'sinrato' ),
				'param_name' => 'rows',
				'value'      => array(
					'1'	=> '1',
					'2'	=> '2',
					'3'	=> '3',
					'4'	=> '4',
					'5'	=> '5',
					'6'	=> '6',
				),
			),
			array(
				'type'       => 'textfield',
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
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 992px - 1199px)', 'sinrato' ),
				'param_name' => 'items_992_1199',
				'value'      => esc_html__( '4', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 768px - 991px)', 'sinrato' ),
				'param_name' => 'items_768_991',
				'value'      => esc_html__( '3', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 640px - 767px)', 'sinrato' ),
				'param_name' => 'items_640_767',
				'value'      => esc_html__( '2', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 480px - 639px)', 'sinrato' ),
				'param_name' => 'items_480_639',
				'value'      => esc_html__( '2', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: under 479px)', 'sinrato' ),
				'param_name' => 'items_0_479',
				'value'      => esc_html__( '1', 'sinrato' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Navigation', 'sinrato' ),
				'param_name' => 'navigation',
				'value'      => array(
					__( 'Yes', 'sinrato' ) => true,
					__( 'No', 'sinrato' )  => false,
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination', 'sinrato' ),
				'param_name' => 'pagination',
				'value'      => array(
					__( 'No', 'sinrato' )  => false,
					__( 'Yes', 'sinrato' ) => true,
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Item Margin (unit: pixel)', 'sinrato' ),
				'param_name' => 'item_margin',
				'value'      => 30,
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Slider speed number (unit: second)', 'sinrato' ),
				'param_name' => 'speed',
				'value'      => '500',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => __( 'Slider loop', 'sinrato' ),
				'param_name' => 'loop',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => __( 'Slider Auto', 'sinrato' ),
				'param_name' => 'auto',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )  => 'style1',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Navigation style', 'sinrato' ),
				'param_name'  => 'navigation_style',
				'value'       => array(
					__( 'Navigation top-right', 'sinrato' )          => 'navigation-style1',
					__( 'Navigation center horizontal', 'sinrato' )  => 'navigation-style2',
				),
			),
		),
	) );
	//Brand logos
	vc_map( array(
		'name'        => esc_html__( 'Brand Logos', 'sinrato' ),
		'description' => __( 'Upload images and links in Theme Options', 'sinrato' ),
		'base'        => 'ourbrands',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'sinrato'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of rows', 'sinrato' ),
				'param_name' => 'rows',
				'value'      => array(
					'1'	=> '1',
					'2'	=> '2',
					'3'	=> '3',
					'4'	=> '4',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'heading'    => __( 'Number of columns (screen: over 1500px)', 'sinrato' ),
				'param_name' => 'items_1500up',
				'value'      => esc_html__( '5', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 1200px - 1499px)', 'sinrato' ),
				'param_name' => 'items_1200_1499',
				'value'      => esc_html__( '5', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 992px - 1199px)', 'sinrato' ),
				'param_name' => 'items_992_1199',
				'value'      => esc_html__( '5', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 768px - 991px)', 'sinrato' ),
				'param_name' => 'items_768_991',
				'value'      => esc_html__( '4', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 640px - 767px)', 'sinrato' ),
				'param_name' => 'items_640_767',
				'value'      => esc_html__( '3', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 480px - 639px)', 'sinrato' ),
				'param_name' => 'items_480_639',
				'value'      => esc_html__( '2', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: under 479px)', 'sinrato' ),
				'param_name' => 'items_0_479',
				'value'      => esc_html__( '1', 'sinrato' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Navigation', 'sinrato' ),
				'param_name' => 'navigation',
				'value'      => array(
					__( 'Yes', 'sinrato' ) => true,
					__( 'No', 'sinrato' )  => false,
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination', 'sinrato' ),
				'param_name' => 'pagination',
				'value'      => array(
					__( 'No', 'sinrato' )  => false,
					__( 'Yes', 'sinrato' ) => true,
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Item Margin (unit: pixel)', 'sinrato' ),
				'param_name' => 'item_margin',
				'value'      => 0,
			),
			array(
				'type'       => 'textfield',
				'heading'    =>  __( 'Slider speed number (unit: second)', 'sinrato' ),
				'param_name' => 'speed',
				'value'      => '500',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => __( 'Slider loop', 'sinrato' ),
				'param_name' => 'loop',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => __( 'Slider Auto', 'sinrato' ),
				'param_name' => 'auto',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )       => 'style1',
				),
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Navigation style', 'sinrato' ),
				'param_name'  => 'navigation_style',
				'value'       => array(
					__( 'Navigation center horizontal', 'sinrato' )  => 'navigation-style1',
					__( 'Navigation top-right', 'sinrato' )          => 'navigation-style2',
				),
			),
		),
	) );
	//Latest posts
	vc_map( array(
		'name'        => esc_html__( 'Latest posts', 'sinrato' ),
		'description' => __( 'List posts', 'sinrato' ),
		'base'        => 'latestposts',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'sinrato'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of posts', 'sinrato' ),
				'param_name' => 'posts_per_page',
				'value'      => esc_html__( '10', 'sinrato' ),
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Category', 'sinrato' ),
				'param_name'  => 'category',
				'value'       => esc_html__( '0', 'sinrato' ),
				'description' => esc_html__( 'Slug of the category (example: slug-1, slug-2). Default is 0 : show all posts', 'sinrato' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Image scale', 'sinrato' ),
				'param_name' => 'image',
				'value'      => array(
					'Wide'	=> 'wide',
					'Square'=> 'square',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Excerpt length', 'sinrato' ),
				'param_name' => 'length',
				'value'      => esc_html__( '20', 'sinrato' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns', 'sinrato' ),
				'param_name' => 'colsnumber',
				'value'      => array(
					'1'	=> '1',
					'2'	=> '2',
					'3'	=> '3',
					'4'	=> '4',
					'5'	=> '5',
					'6'	=> '6',
				),
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Style', 'sinrato' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Style 1', 'sinrato' )           => 'style1',
					__( 'Style 2 (footer)', 'sinrato' )  => 'style2',
				),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Enable slider', 'sinrato' ),
				'param_name'  => 'enable_slider',
				'value'       => true,
				'save_always' => true, 
				'group'       => __( 'Slider Options', 'sinrato' ),
			),
			array(
				'type'       => 'dropdown',
				'class'      => '',
				'heading'    => esc_html__( 'Number of rows', 'sinrato' ),
				'param_name' => 'rowsnumber',
				'group'      => __( 'Slider Options', 'sinrato' ),
				'value'      => array(
						'1'	=> '1',
						'2'	=> '2',
						'3'	=> '3',
						'4'	=> '4',
					),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 1200px - 1499px)', 'sinrato' ),
				'param_name' => 'items_1200_1499',
				'group'      => __( 'Slider Options', 'sinrato' ),
				'value'      => esc_html__( '3', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 992px - 1199px)', 'sinrato' ),
				'param_name' => 'items_992_1199',
				'value'      => esc_html__( '3', 'sinrato' ),
				'group'      => __( 'Slider Options', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 768px - 991px)', 'sinrato' ),
				'param_name' => 'items_768_991',
				'value'      => esc_html__( '3', 'sinrato' ),
				'group'      => __( 'Slider Options', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 640px - 767px)', 'sinrato' ),
				'param_name' => 'items_640_767',
				'value'      => esc_html__( '2', 'sinrato' ),
				'group'      => __( 'Slider Options', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 480px - 639px)', 'sinrato' ),
				'param_name' => 'items_480_639',
				'value'      => esc_html__( '2', 'sinrato' ),
				'group'      => __( 'Slider Options', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: under 479px)', 'sinrato' ),
				'param_name' => 'items_0_479',
				'value'      => esc_html__( '1', 'sinrato' ),
				'group'      => __( 'Slider Options', 'sinrato' ),
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
					__( 'Navigation center horizontal', 'sinrato' )  => 'navigation-style1',
					__( 'Navigation top-right', 'sinrato' )          => 'navigation-style2',
				),
			),
		),
	) );
	//Testimonials
	vc_map( array(
		'name'        => esc_html__( 'Testimonials', 'sinrato' ),
		'description' => __( 'Testimonial slider', 'sinrato' ),
		'base'        => 'testimonials',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'sinrato'),
		"icon"     	  => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of testimonial', 'sinrato' ),
				'param_name' => 'limit',
				'value'      => esc_html__( '10', 'sinrato' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Display Author', 'sinrato' ),
				'param_name' => 'display_author',
				'value'      => array(
					'Yes'	=> '1',
					'No'	=> '0',
				),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Display Avatar', 'sinrato' ),
				'param_name' => 'display_avatar',
				'value'      => array(
					'Yes'=> '1',
					'No' => '0',
				),
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Avatar image size', 'sinrato' ),
				'param_name'  => 'size',
				'value'       => '150',
				'description' => esc_html__( 'Avatar image size in pixels. Default is 150', 'sinrato' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Display URL', 'sinrato' ),
				'param_name' => 'display_url',
				'value'      => array(
					'Yes'	=> '1',
					'No'	=> '0',
				),
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Category', 'sinrato' ),
				'param_name'  => 'category',
				'value'       => esc_html__( '0', 'sinrato' ),
				'description' => esc_html__( 'Slug of the category. Default is 0 : show all testimonials', 'sinrato' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Navigation', 'sinrato' ),
				'param_name' => 'navigation',
				'value'      => array(
					__( 'No', 'sinrato' )  => false,
					__( 'Yes', 'sinrato' ) => true,
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination', 'sinrato' ),
				'param_name' => 'pagination',
				'value'      => array(
					__( 'Yes', 'sinrato' ) => true,
					__( 'No', 'sinrato' )  => false,
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    =>  __( 'Slider speed number (unit: second)', 'sinrato' ),
				'param_name' => 'speed',
				'value'      => '500',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => __( 'Slider loop', 'sinrato' ),
				'param_name' => 'loop',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => __( 'Slider Auto', 'sinrato' ),
				'param_name' => 'auto',
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Style', 'sinrato' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Style 1', 'sinrato' )                => 'style1',
					__( 'Style 2 (about page)', 'sinrato' )   => 'style-about-page',
				),
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Navigation style', 'sinrato' ),
				'param_name'  => 'navigation_style',
				'value'       => array(
					__( 'Navigation top-right', 'sinrato' )          => 'navigation-style1',
					__( 'Navigation center horizontal', 'sinrato' )  => 'navigation-style2',
				),
			),
		),
	) );
	//Counter
	vc_map( array(
		'name'     => esc_html__( 'Counter', 'sinrato' ),
		'description' => __( 'Counter', 'sinrato' ),
		'base'     => 'sinrato_counter',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'sinrato'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'        => 'attach_image',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Image icon', 'sinrato' ),
				'param_name'  => 'image',
				'value'       => '',
				'description' => esc_html__( 'Upload icon image', 'sinrato' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number', 'sinrato' ),
				'param_name' => 'number',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Text', 'sinrato' ),
				'param_name' => 'text',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )  => 'style1',
				),
			),
		),
	) );
	//Heading title
	vc_map( array(
		'name'     => esc_html__( 'Heading Title', 'sinrato' ),
		'description' => __( 'Heading Title', 'sinrato' ),
		'base'     => 'roadthemes_title',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'sinrato'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Heading title element', 'sinrato' ),
				'param_name' => 'heading_title',
				'value'      => 'Title',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Heading sub-title element', 'sinrato' ),
				'param_name' => 'sub_heading_title',
				'value'      => '',
			),
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload heading title image', 'sinrato' ),
				'param_name' => 'heading_image',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'     => esc_html__( 'Style', 'sinrato' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Style 1 (Default)', 'sinrato' )             => 'style1',
					__( 'Style 2 (sidebar, smaller)', 'sinrato' )    => 'style2',
					__( 'Style 3 (Footer title)', 'sinrato' )        => 'style3',
				),
			),
		),
	) );
	//Countdown
	vc_map( array(
		'name'     => esc_html__( 'Countdown', 'sinrato' ),
		'description' => __( 'Countdown', 'sinrato' ),
		'base'     => 'roadthemes_countdown',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'sinrato'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'End date (day)', 'sinrato' ),
				'param_name' => 'countdown_day',
				'value'      => '1',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'End date (month)', 'sinrato' ),
				'param_name' => 'countdown_month',
				'value'      => '1',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'End date (year)', 'sinrato' ),
				'param_name' => 'countdown_year',
				'value'      => '2020',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'sinrato' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'sinrato' )  => 'style1',
				),
			),
		),
	) );
	//Mailchimp newsletter
	vc_map( array(
		'name'     => esc_html__( 'Mailchimp Newsletter', 'sinrato' ),
		'description' => __( 'Mailchimp Newsletter ', 'sinrato' ),
		'base'     => 'roadthemes_newsletter',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'sinrato'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'        => 'textarea',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Newsletter title', 'sinrato' ),
				'param_name'  => 'newsletter_title',
				'value'       => '',
			),
			array(
				'type'        => 'textarea',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Newsletter sub-title', 'sinrato' ),
				'param_name'  => 'newsletter_sub_title',
				'value'       => '',
			),
			array(
				'type'        => 'attach_image',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Upload newsletter title image', 'sinrato' ),
				'param_name'  => 'newsletter_image',
				'value'       => '',
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Insert id of Mailchimp Form', 'sinrato' ),
				'description' => esc_html__( 'See id in admin -> MailChimp for WP -> Form, under the form title', 'sinrato' ),
				'param_name'  => 'newsletter_form_id',
				'value'       => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'     => esc_html__( 'Style', 'sinrato' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Style 1 (Default)', 'sinrato' )    => 'style1',
					__( 'Style 2', 'sinrato' )              => 'style2',
				),
			),
		),
	) );
	//Custom Menu
	$custom_menus = array();
	if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		if ( is_array( $menus ) && ! empty( $menus ) ) {
			foreach ( $menus as $single_menu ) {
				if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
					$custom_menus[ $single_menu->name ] = $single_menu->term_id;
				}
			}
		}
	}
	vc_map( array(
		'name'     => esc_html__( 'Custom Menu', 'sinrato' ),
		'description' => __( 'Custom Menu', 'sinrato' ),
		'base'     => 'roadthemes_menu',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'sinrato'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload menu image', 'sinrato' ),
				'param_name' => 'menu_image',
				'value'      => '',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Menu title', 'sinrato' ),
				'param_name' => 'menu_title',
				'value'      => 'Title',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Choose Menu', 'sinrato' ),
				'param_name'  => 'nav_menu',
				'value'       => $custom_menus,
				'description' => empty( $custom_menus ) ? __( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'sinrato' ) : __( 'Select menu to display.', 'sinrato' ),
				'admin_label' => true,
				'save_always' => true,
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Menu text', 'sinrato' ),
				'param_name' => 'menu_text',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Menu link text', 'sinrato' ),
				'param_name' => 'menu_link_text',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Menu link url', 'sinrato' ),
				'param_name' => 'menu_link_url',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Style', 'sinrato' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Style 1 (Default)', 'sinrato' )    => 'style1',
				),
			),
		),
	) );
}
?>