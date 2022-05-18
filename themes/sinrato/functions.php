<?php
/**
 * Sinrato functions and definitions
 */
/**
* Require files
*/ 
	//Init the Redux Framework
if ( class_exists( 'ReduxFramework' ) && !isset( $redux_demo ) && file_exists( get_template_directory().'/theme-config.php' ) ) {
	require_once( get_template_directory().'/theme-config.php' );
}
	// Theme files
if ( file_exists( get_template_directory().'/include/wooajax.php' ) ) {
	require_once( get_template_directory().'/include/wooajax.php' );
}
if ( file_exists( get_template_directory().'/include/map_shortcodes.php' ) ) {
	require_once( get_template_directory().'/include/map_shortcodes.php' );
}
if ( file_exists( get_template_directory().'/include/shortcodes.php' ) ) {
	require_once( get_template_directory().'/include/shortcodes.php' );
}
define('PLUGIN_REQUIRED_PATH','http://roadthemes.com/plugins');
Class Sinrato_Class {
	/**
	* Global values
	*/
	static function sinrato_post_odd_event(){
		global $wp_session;
		if(!isset($wp_session["sinrato_postcount"])){
			$wp_session["sinrato_postcount"] = 0;
		}
		$wp_session["sinrato_postcount"] = 1 - $wp_session["sinrato_postcount"];
		return $wp_session["sinrato_postcount"];
	}
	static function sinrato_post_thumbnail_size($size){
		global $wp_session;
		if($size!=''){
			$wp_session["sinrato_postthumb"] = $size;
		}
		return $wp_session["sinrato_postthumb"];
	}
	static function sinrato_shop_class($class){
		global $wp_session;
		if($class!=''){
			$wp_session["sinrato_shopclass"] = $class;
		}
		return $wp_session["sinrato_shopclass"];
	}
	static function sinrato_show_view_mode(){
		$sinrato_opt = get_option( 'sinrato_opt' );
		$sinrato_viewmode = 'grid-view';
		if(isset($sinrato_opt['default_view'])) {
			$sinrato_viewmode = $sinrato_opt['default_view'];
		}
		if(isset($_GET['view']) && $_GET['view']!=''){
			$sinrato_viewmode = $_GET['view'];
		}
		return $sinrato_viewmode;
	}
	static function sinrato_shortcode_products_count(){
		global $wp_session;
		$sinrato_productsfound = 0;
		if(isset($wp_session["sinrato_productsfound"])){
			$sinrato_productsfound = $wp_session["sinrato_productsfound"];
		}
		return $sinrato_productsfound;
	}
	/**
	* Constructor
	*/
	function __construct() {
		// Register action/filter callbacks
			//WooCommerce - action/filter
		add_theme_support( 'woocommerce' );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
		add_filter( 'get_product_search_form', array($this, 'sinrato_woo_search_form'));
		add_filter( 'woocommerce_shortcode_products_query', array($this, 'sinrato_woocommerce_shortcode_count'));
		add_action( 'woocommerce_share', array($this, 'sinrato_woocommerce_social_share'), 35 );
		add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
		    return array(
		        'width'  => 150,
		        'height' => 150,
		        'crop'   => 1,
		    );
		} );
			//move message to top
		remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
		add_action( 'woocommerce_show_message', 'wc_print_notices', 10 );
			//remove add to cart button after item
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			//Single product organize
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			//remove cart total under cross sell
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
		add_action( 'cart_totals', 'woocommerce_cart_totals', 5 );
			//Theme actions
		add_action( 'after_setup_theme', array($this, 'sinrato_setup')); 
		add_action( 'wp_enqueue_scripts', array($this, 'sinrato_scripts_styles') );
		add_action( 'wp_head', array($this, 'sinrato_custom_code_header'));
		add_action( 'widgets_init', array($this, 'sinrato_widgets_init'));
		add_action( 'save_post', array($this, 'sinrato_save_meta_box_data'));
		add_action('comment_form_before_fields', array($this, 'sinrato_before_comment_fields'));
		add_action('comment_form_after_fields', array($this, 'sinrato_after_comment_fields'));
		add_action( 'customize_register', array($this, 'sinrato_customize_register'));
		add_action( 'customize_preview_init', array($this, 'sinrato_customize_preview_js'));
		add_action('admin_enqueue_scripts', array($this, 'sinrato_admin_style'));
			//Theme filters
		add_filter( 'loop_shop_per_page', array($this, 'sinrato_woo_change_per_page'), 20 );
		add_filter( 'woocommerce_output_related_products_args', array($this, 'sinrato_woo_related_products_limit'));
		add_filter( 'get_search_form', array($this, 'sinrato_search_form'));
		add_filter('excerpt_more', array($this, 'sinrato_new_excerpt_more'));
		add_filter( 'excerpt_length', array($this, 'sinrato_change_excerpt_length'), 999 );
		add_filter('wp_nav_menu_objects', array($this, 'sinrato_first_and_last_menu_class'));
		add_filter( 'wp_page_menu_args', array($this, 'sinrato_page_menu_args'));
		add_filter('dynamic_sidebar_params', array($this, 'sinrato_widget_first_last_class'));
		add_filter('dynamic_sidebar_params', array($this, 'sinrato_mega_menu_widget_change'));
		add_filter( 'dynamic_sidebar_params', array($this, 'sinrato_put_widget_content'));
		add_filter( 'the_content_more_link', array($this, 'sinrato_modify_read_more_link'));
		//Adding theme support
		if ( ! isset( $content_width ) ) {
			$content_width = 625;
		}
	}
	/**
	* Filter callbacks
	* ----------------
	*/
	// read more link 
	function sinrato_modify_read_more_link() {
		$sinrato_opt = get_option( 'sinrato_opt' );
		if(isset($sinrato_opt['readmore_text']) && $sinrato_opt['readmore_text'] != ''){
			$readmore_text = esc_html($sinrato_opt['readmore_text']);
		} else { 
			$readmore_text = esc_html('Read more','sinrato');
		};
	    return '<div><a class="readmore" href="'. get_permalink().' ">'.$readmore_text.'</a></div>';
	}
	// Change products per page
	function sinrato_woo_change_per_page() {
		$sinrato_opt = get_option( 'sinrato_opt' );
		return $sinrato_opt['product_per_page'];
	}
	//Change number of related products on product page. Set your own value for 'posts_per_page'
	function sinrato_woo_related_products_limit( $args ) {
		global $product;
		$sinrato_opt = get_option( 'sinrato_opt' );
		$args['posts_per_page'] = $sinrato_opt['related_amount'];
		return $args;
	}
	// Count number of products from shortcode
	function sinrato_woocommerce_shortcode_count( $args ) {
		$sinrato_productsfound = new WP_Query($args);
		$sinrato_productsfound = $sinrato_productsfound->post_count;
		global $wp_session;
		$wp_session["sinrato_productsfound"] = $sinrato_productsfound;
		return $args;
	}
	//Change search form
	function sinrato_search_form( $form ) {
		if(get_search_query()!=''){
			$search_str = get_search_query();
		} else {
			$search_str = esc_html__( 'Search... ', 'sinrato' );
		}
		$form = '<form role="search" method="get" class="searchform blogsearchform" action="' . esc_url(home_url( '/' ) ). '" >
		<div class="form-input">
			<input type="text" placeholder="'.esc_attr($search_str).'" name="s" class="input_text ws">
			<button class="button-search searchsubmit blogsearchsubmit" type="submit">' . esc_html__('Search', 'sinrato') . '</button>
			<input type="hidden" name="post_type" value="post" />
			</div>
		</form>';
		return $form;
	}
	//Change woocommerce search form
	function sinrato_woo_search_form( $form ) {
		global $wpdb;
		if(get_search_query()!=''){
			$search_str = get_search_query();
		} else {
			$search_str = esc_html__( 'Search product...', 'sinrato' );
		}
		$form = '<form role="search" method="get" class="searchform productsearchform" action="'.esc_url( home_url( '/'  ) ).'">';
			$form .= '<div class="form-input">';
				$form .= '<input type="text" placeholder="'.esc_attr($search_str).'" name="s" class="ws"/>';
				$form .= '<button class="button-search searchsubmit productsearchsubmit" type="submit">' . esc_html__('Search', 'sinrato') . '</button>';
				$form .= '<input type="hidden" name="post_type" value="product" />';
			$form .= '</div>';
		$form .= '</form>';
		return $form;
	}
	// Replaces the excerpt "more" text by a link
	function sinrato_new_excerpt_more($more) {
		return '';
	}
	//Change excerpt length
	function sinrato_change_excerpt_length( $length ) {
		$sinrato_opt = get_option( 'sinrato_opt' );
		if(isset($sinrato_opt['excerpt_length'])){
			return $sinrato_opt['excerpt_length'];
		}
		return 50;
	}
	//Add 'first, last' class to menu
	function sinrato_first_and_last_menu_class($items) {
		$items[1]->classes[] = 'first';
		$items[count($items)]->classes[] = 'last';
		return $items;
	}
	/**
	 * Filter the page menu arguments.
	 *
	 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
	 *
	 * @since Sinrato 1.0
	 */
	function sinrato_page_menu_args( $args ) {
		if ( ! isset( $args['show_home'] ) )
			$args['show_home'] = true;
		return $args;
	}
	//Add first, last class to widgets
	function sinrato_widget_first_last_class($params) {
		global $my_widget_num;
		$class = '';
		$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
		$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	
		if(!$my_widget_num) {// If the counter array doesn't exist, create it
			$my_widget_num = array();
		}
		if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
			return $params; // No widgets in this sidebar... bail early.
		}
		if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
			$my_widget_num[$this_id] ++;
		} else { // If not, create it starting with 1
			$my_widget_num[$this_id] = 1;
		}
		if($my_widget_num[$this_id] == 1) { // If this is the first widget
			$class .= ' widget-first ';
		} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
			$class .= ' widget-last ';
		}
		$params[0]['before_widget'] = str_replace('first_last', ' '.$class.' ', $params[0]['before_widget']);
		return $params;
	}
	//Change mega menu widget from div to li tag
	function sinrato_mega_menu_widget_change($params) {
		$sidebar_id = $params[0]['id'];
		$pos = strpos($sidebar_id, '_menu_widgets_area_');
		if ( !$pos == false ) {
			$params[0]['before_widget'] = '<li class="widget_mega_menu">'.$params[0]['before_widget'];
			$params[0]['after_widget'] = $params[0]['after_widget'].'</li>';
		}
		return $params;
	}
	// Push sidebar widget content into a div
	function sinrato_put_widget_content( $params ) {
		global $wp_registered_widgets;
		if( $params[0]['id']=='sidebar-category' ){
			$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
			$settings = $settings_getter->get_settings();
			$settings = $settings[ $params[1]['number'] ];
			if($params[0]['widget_name']=="Text" && isset($settings['title']) && $settings['text']=="") { // if text widget and no content => don't push content
				return $params;
			}
			if( isset($settings['title']) && $settings['title']!='' ){
				$params[0][ 'after_title' ] .= '<div class="widget_content">';
				$params[0][ 'after_widget' ] = '</div>'.$params[0][ 'after_widget' ];
			} else {
				$params[0][ 'before_widget' ] .= '<div class="widget_content">';
				$params[0][ 'after_widget' ] = '</div>'.$params[0][ 'after_widget' ];
			}
		}
		return $params;
	}
	/**
	* Action hooks
	* ----------------
	*/
	/**
	 * Sinrato setup.
	 *
	 * Sets up theme defaults and registers the various WordPress features that
	 * Sinrato supports.
	 *
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_editor_style() To add a Visual Editor stylesheet.
	 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
	 * 	custom background, and post formats.
	 * @uses register_nav_menu() To add support for navigation menus.
	 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
	 *
	 * @since Sinrato 1.0
	 */
	function sinrato_setup() {
		/*
		 * Makes Sinrato available for translation.
		 *
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on Sinrato, use a find and replace
		 * to change 'sinrato' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sinrato', get_template_directory() . '/languages' );
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		// This theme supports a variety of post formats.
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );
		// Register menus
		register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'sinrato' ) );
		register_nav_menu( 'stickymenu', esc_html__( 'Sticky Menu', 'sinrato' ) );
		register_nav_menu( 'mobilemenu', esc_html__( 'Mobile Menu', 'sinrato' ) );
		register_nav_menu( 'categories', esc_html__( 'Categories Menu', 'sinrato' ) );
		/*
		 * This theme supports custom background color and image,
		 * and here we also set up the default background color.
		 */
		add_theme_support( 'custom-background', array(
			'default-color' => 'e6e6e6',
		) );
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		// This theme uses a custom image size for featured images, displayed on "standard" posts.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1395, 9999 ); // Unlimited height, soft crop
		add_image_size( 'sinrato-category-thumb', 300, 165, true ); // (cropped) (post carousel)
		add_image_size( 'sinrato-post-thumb', 700, 550, true ); // (cropped) (blog sidebar)
		add_image_size( 'sinrato-post-thumbwide', 1395, 957, true ); // (cropped) (blog large img)
	}
	//Display social sharing on product page
	function sinrato_woocommerce_social_share(){
		$sinrato_opt = get_option( 'sinrato_opt' );
	?>
		<?php if (isset($sinrato_opt['share_code']) && $sinrato_opt['share_code']!='') { ?>
			<div class="share_buttons">
				<?php 
					echo wp_kses($sinrato_opt['share_code'], array(
						'div' => array(
							'class' => array()
						),
						'span' => array(
							'class' => array(),
							'displayText' => array()
						),
					));
				?>
			</div>
		<?php } ?>
	<?php
	}
	/**
	 * Enqueue scripts and styles for front-end.
	 *
	 * @since Sinrato 1.0
	 */
	function sinrato_scripts_styles() {
		global $wp_styles, $wp_scripts;
		$sinrato_opt = get_option( 'sinrato_opt' );
		/*
		 * Adds JavaScript to pages with the comment form to support
		 * sites with threaded comments (when in use).
		*/
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		// Add Bootstrap JavaScript
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.1.1', true );
		// Add Owl files
		wp_enqueue_script( 'owl', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '2.3.4', true );
		wp_enqueue_style( 'owl', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), '2.3.4' );
		// Add Chosen js files
		wp_enqueue_script( 'chosen', get_template_directory_uri() . '/js/chosen/chosen.jquery.min.js', array('jquery'), '1.3.0', true );
		wp_enqueue_script( 'chosenproto', get_template_directory_uri() . '/js/chosen/chosen.proto.min.js', array('jquery'), '1.3.0', true );
		wp_enqueue_style( 'chosen', get_template_directory_uri() . '/js/chosen/chosen.min.css', array(), '1.3.0' );
		// Add parallax script files
		//Superfish
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish/superfish.min.js', array('jquery'), '1.3.15', true );
		//Add Shuffle js
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.min.js', array('jquery'), '2.6.2', true );
		wp_enqueue_script( 'shuffle', get_template_directory_uri() . '/js/jquery.shuffle.min.js', array('jquery'), '3.0.0', true );
		//Add mousewheel
		wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel.min.js', array('jquery'), '3.1.12', true );
		// Add jQuery countdown file
		wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array('jquery'), '2.0.4', true );
		// Add jQuery counter files
		wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'counterup', get_template_directory_uri() . '/js/jquery.counterup.min.js', array('jquery'), '1.0', true );
		// Add variables.js file
		wp_enqueue_script( 'variables', get_template_directory_uri() . '/js/variables.js', array('jquery'), '20140826', true );
		wp_enqueue_script( 'sinrato', get_template_directory_uri() . '/js/theme-sinrato.js', array('jquery'), '20140826', true );
		$font_url = $this->sinrato_get_font_url();
		if ( ! empty( $font_url ) )
			wp_enqueue_style( 'sinrato-fonts', esc_url_raw( $font_url ), array(), null );
		// Loads our main stylesheet.
		wp_enqueue_style( 'sinrato-style', get_stylesheet_uri() );
		// Mega Main Menu
		wp_enqueue_style( 'megamenu', get_template_directory_uri() . '/css/megamenu_style.css', array(), '2.0.4' );
		// Load fontawesome css
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0' );
		// Load Ionicons css
		wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/css/ionicons.min.css', array(), null );
		// Load Stroke-Gap-Icons css
		wp_enqueue_style( 'stroke-gap-icons', get_template_directory_uri() . '/css/stroke-gap-icons.css', array(), null );
		// Load Linearicons-Free css
		wp_enqueue_style( 'linearicons-free', get_template_directory_uri() . '/css/linearicons-free.css', array(), '1.0.0' );
		// Load bootstrap css
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.1' );
		// Compile Less to CSS
		$previewpreset = (isset($_REQUEST['preset']) ? $_REQUEST['preset'] : null);
			//get preset from url (only for demo/preview)
		if($previewpreset){
			$_SESSION["preset"] = $previewpreset;
		}
		$presetopt = 1; /*change default preset 1 and 209-binhthuongg*/
		if(!isset($_SESSION["preset"])){
			$_SESSION["preset"] = 1;
		}
		if($_SESSION["preset"] != 1) {
			$presetopt = $_SESSION["preset"];
		} else { /* if no preset varialbe found in url, use from theme options */
			if(isset($sinrato_opt['preset_option'])){
				$presetopt = $sinrato_opt['preset_option'];
			}
		}
		if(!isset($presetopt)) $presetopt = 1; /* in case first time install theme, no options found */
		if(isset($sinrato_opt['enable_less'])){
			if($sinrato_opt['enable_less']){
				$themevariables = array(
					'product_bg'                     => $sinrato_opt['product_bg'],
					
					'body_font'                      => $sinrato_opt['bodyfont']['font-family'],
					'text_color'                     => $sinrato_opt['bodyfont']['color'],
					'text_selected_bg'               => $sinrato_opt['text_selected_bg'],
					'text_selected_color'            => $sinrato_opt['text_selected_color'],
					'text_size'                      => $sinrato_opt['bodyfont']['font-size'],
					'border_color'                   => $sinrato_opt['border_color']['border-color'],
					'page_content_background'        => $sinrato_opt['page_content_background']['background-color'],
					'row_space'                      => $sinrato_opt['row_space'],
					'carousel_topright_position'     => $sinrato_opt['carousel_topright_position'],
					'heading_font'                   => $sinrato_opt['headingfont']['font-family'],
					'heading_color'                  => $sinrato_opt['headingfont']['color'],
					'heading_font_weight'            => $sinrato_opt['headingfont']['font-weight'],
					'dropdown_font'                  => $sinrato_opt['dropdownfont']['font-family'],
					'dropdown_color'                 => $sinrato_opt['dropdownfont']['color'],
					'dropdown_font_size'             => $sinrato_opt['dropdownfont']['font-size'],
					'dropdown_font_weight'           => $sinrato_opt['dropdownfont']['font-weight'],
					'dropdown_bg'                    => $sinrato_opt['dropdown_bg'],
					'menu_font'                      => $sinrato_opt['menufont']['font-family'],
					'menu_color'                     => $sinrato_opt['menufont']['color'],
					'menu_font_size'                 => $sinrato_opt['menufont']['font-size'],
					'menu_font_weight'               => $sinrato_opt['menufont']['font-weight'],
					'sub_menu_font'                  => $sinrato_opt['submenufont']['font-family'],
					'sub_menu_color'                 => $sinrato_opt['submenufont']['color'],
					'sub_menu_font_size'             => $sinrato_opt['submenufont']['font-size'],
					'sub_menu_font_weight'           => $sinrato_opt['submenufont']['font-weight'],
					'sub_menu_bg'                    => $sinrato_opt['sub_menu_bg'],
					'categories_font'                => $sinrato_opt['categoriesfont']['font-family'],
					'categories_font_size'           => $sinrato_opt['categoriesfont']['font-size'],
					'categories_font_weight'         => $sinrato_opt['categoriesfont']['font-weight'],
					'categories_color'               => $sinrato_opt['categoriesfont']['color'],
					'categories_menu_label_bg'       => $sinrato_opt['categories_menu_label_bg'],
					'categories_menu_bg'             => $sinrato_opt['categories_menu_bg'],
					'categories_sub_menu_font'       => $sinrato_opt['categoriessubmenufont']['font-family'],
					'categories_sub_menu_font_size'  => $sinrato_opt['categoriessubmenufont']['font-size'],
					'categories_sub_menu_font_weight'=> $sinrato_opt['categoriessubmenufont']['font-weight'],
					'categories_sub_menu_color'      => $sinrato_opt['categoriessubmenufont']['color'],
					'categories_sub_menu_bg'         => $sinrato_opt['categories_sub_menu_bg'],
					'link_color'                     => $sinrato_opt['link_color']['regular'],
					'link_hover_color'               => $sinrato_opt['link_color']['hover'],
					'link_active_color'              => $sinrato_opt['link_color']['active'],
					'primary_color'                  => $sinrato_opt['primary_color'],
					'sale_color'                     => $sinrato_opt['sale_color'],
					'saletext_color'                 => $sinrato_opt['saletext_color'],
					'rate_color'                     => $sinrato_opt['rate_color'],
					'price_font'                     => $sinrato_opt['pricefont']['font-family'],
					'price_color'                    => $sinrato_opt['pricefont']['color'],
					'price_font_size'                => $sinrato_opt['pricefont']['font-size'],
					'price_font_weight'              => $sinrato_opt['pricefont']['font-weight'],
					'topbar_color'                   => $sinrato_opt['topbar_color'],
					'topbar_link_color'              => $sinrato_opt['topbar_link_color']['regular'],
					'topbar_link_hover_color'        => $sinrato_opt['topbar_link_color']['hover'],
					'topbar_link_active_color'       => $sinrato_opt['topbar_link_color']['active'],
					'header_bg'                      => $sinrato_opt['header_bg'],
					'header_color'                   => $sinrato_opt['header_color'],
					'header_link_color'              => $sinrato_opt['header_link_color']['regular'],
					'header_link_hover_color'        => $sinrato_opt['header_link_color']['hover'],
					'header_link_active_color'       => $sinrato_opt['header_link_color']['active'],
					'footer_bg'                      => $sinrato_opt['footer_bg'],
					'footer_color'                   => $sinrato_opt['footer_color'],
					'footer_link_color'              => $sinrato_opt['footer_link_color']['regular'],
					'footer_link_hover_color'        => $sinrato_opt['footer_link_color']['hover'],
					'footer_link_active_color'       => $sinrato_opt['footer_link_color']['active'],
				);
				if(isset($sinrato_opt['header_sticky_bg']['rgba']) && $sinrato_opt['header_sticky_bg']['rgba']!="") {
					$themevariables['header_sticky_bg'] = $sinrato_opt['header_sticky_bg']['rgba'];
				} else {
					$themevariables['header_sticky_bg'] = 'rgba(255, 255, 255, 0.95)';
				}
				switch ($presetopt) {
					case 2:
						$themevariables['row_space'] = '55px';
					break;
					case 3:
						$themevariables['topbar_color'] = '#777777';
						$themevariables['topbar_link_color'] = '#777777';
					break;
					case 4:
						$themevariables['categories_menu_label_bg'] = '#fedc19';
					break;
				}
				if(function_exists('compileLessFile')){
					compileLessFile('theme.less', 'theme'.$presetopt.'.css', $themevariables);
				}
			}
		}
		// Load main theme css style files
		wp_enqueue_style( 'sinrato-theme', get_template_directory_uri() . '/css/theme'.$presetopt.'.css', array('bootstrap'), '1.0.0' );
		wp_enqueue_style( 'sinrato-custom', get_template_directory_uri() . '/css/opt_css.css', array('sinrato-theme'), '1.0.0' );
		if(function_exists('WP_Filesystem')){
			if ( ! WP_Filesystem() ) {
				$url = wp_nonce_url();
				request_filesystem_credentials($url, '', true, false, null);
			}
			global $wp_filesystem;
			//add custom css, sharing code to header
			if($wp_filesystem->exists(get_template_directory(). '/css/opt_css.css')){
				$customcss = $wp_filesystem->get_contents(get_template_directory(). '/css/opt_css.css');
				if(isset($sinrato_opt['custom_css']) && $customcss!=$sinrato_opt['custom_css']){ //if new update, write file content
					$wp_filesystem->put_contents(
						get_template_directory(). '/css/opt_css.css',
						$sinrato_opt['custom_css'],
						FS_CHMOD_FILE // predefined mode settings for WP files
					);
				}
			} else {
				$wp_filesystem->put_contents(
					get_template_directory(). '/css/opt_css.css',
					$sinrato_opt['custom_css'],
					FS_CHMOD_FILE // predefined mode settings for WP files
				);
			}
		}
		//add javascript variables
		ob_start(); ?>
		"use strict";
		var sinrato_brandnumber = <?php if(isset($sinrato_opt['brandnumber'])) { echo esc_js($sinrato_opt['brandnumber']); } else { echo '6'; } ?>,
			sinrato_brandscrollnumber = <?php if(isset($sinrato_opt['brandscrollnumber'])) { echo esc_js($sinrato_opt['brandscrollnumber']); } else { echo '2';} ?>,
			sinrato_brandpause = <?php if(isset($sinrato_opt['brandpause'])) { echo esc_js($sinrato_opt['brandpause']); } else { echo '3000'; } ?>,
			sinrato_brandanimate = <?php if(isset($sinrato_opt['brandanimate'])) { echo esc_js($sinrato_opt['brandanimate']); } else { echo '700';} ?>;
		var sinrato_brandscroll = false;
			<?php if(isset($sinrato_opt['brandscroll'])){ ?>
				sinrato_brandscroll = <?php echo esc_js($sinrato_opt['brandscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var sinrato_categoriesnumber = <?php if(isset($sinrato_opt['categoriesnumber'])) { echo esc_js($sinrato_opt['categoriesnumber']); } else { echo '6'; } ?>,
			sinrato_categoriesscrollnumber = <?php if(isset($sinrato_opt['categoriesscrollnumber'])) { echo esc_js($sinrato_opt['categoriesscrollnumber']); } else { echo '2';} ?>,
			sinrato_categoriespause = <?php if(isset($sinrato_opt['categoriespause'])) { echo esc_js($sinrato_opt['categoriespause']); } else { echo '3000'; } ?>,
			sinrato_categoriesanimate = <?php if(isset($sinrato_opt['categoriesanimate'])) { echo esc_js($sinrato_opt['categoriesanimate']); } else { echo '700';} ?>;
		var sinrato_categoriesscroll = 'false';
			<?php if(isset($sinrato_opt['categoriesscroll'])){ ?>
				sinrato_categoriesscroll = <?php echo esc_js($sinrato_opt['categoriesscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var sinrato_blogpause = <?php if(isset($sinrato_opt['blogpause'])) { echo esc_js($sinrato_opt['blogpause']); } else { echo '3000'; } ?>,
			sinrato_bloganimate = <?php if(isset($sinrato_opt['bloganimate'])) { echo esc_js($sinrato_opt['bloganimate']); } else { echo '700'; } ?>;
		var sinrato_blogscroll = false;
			<?php if(isset($sinrato_opt['blogscroll'])){ ?>
				sinrato_blogscroll = <?php echo esc_js($sinrato_opt['blogscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var sinrato_testipause = <?php if(isset($sinrato_opt['testipause'])) { echo esc_js($sinrato_opt['testipause']); } else { echo '3000'; } ?>,
			sinrato_testianimate = <?php if(isset($sinrato_opt['testianimate'])) { echo esc_js($sinrato_opt['testianimate']); } else { echo '700'; } ?>;
		var sinrato_testiscroll = false;
			<?php if(isset($sinrato_opt['testiscroll'])){ ?>
				sinrato_testiscroll = <?php echo esc_js($sinrato_opt['testiscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var sinrato_catenumber = <?php if(isset($sinrato_opt['catenumber'])) { echo esc_js($sinrato_opt['catenumber']); } else { echo '6'; } ?>,
			sinrato_catescrollnumber = <?php if(isset($sinrato_opt['catescrollnumber'])) { echo esc_js($sinrato_opt['catescrollnumber']); } else { echo '2';} ?>,
			sinrato_catepause = <?php if(isset($sinrato_opt['catepause'])) { echo esc_js($sinrato_opt['catepause']); } else { echo '3000'; } ?>,
			sinrato_cateanimate = <?php if(isset($sinrato_opt['cateanimate'])) { echo esc_js($sinrato_opt['cateanimate']); } else { echo '700';} ?>;
		var sinrato_catescroll = false;
			<?php if(isset($sinrato_opt['catescroll'])){ ?>
				sinrato_catescroll = <?php echo esc_js($sinrato_opt['catescroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var sinrato_menu_number = <?php if(isset($sinrato_opt['categories_menu_items'])) { echo esc_js((int)$sinrato_opt['categories_menu_items']); } else { echo '9';} ?>;
		var sinrato_sticky_header = false;
			<?php if(isset($sinrato_opt['sticky_header'])){ ?>
				sinrato_sticky_header = <?php echo esc_js($sinrato_opt['sticky_header'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		jQuery(document).ready(function(){
			jQuery(".ws").on('focus', function(){
				if(jQuery(this).val()=="<?php esc_html__( 'Search product...', 'sinrato' );?>"){
					jQuery(this).val("");
				}
			});
			jQuery(".ws").on('focusout', function(){
				if(jQuery(this).val()==""){
					jQuery(this).val("<?php esc_html__( 'Search product...', 'sinrato' );?>");
				}
			});
			jQuery(".wsearchsubmit").on('click', function(){
				if(jQuery("#ws").val()=="<?php esc_html__( 'Search product...', 'sinrato' );?>" || jQuery("#ws").val()==""){
					jQuery("#ws").focus();
					return false;
				}
			});
			jQuery(".search_input").on('focus', function(){
				if(jQuery(this).val()=="<?php esc_html__( 'Search...', 'sinrato' );?>"){
					jQuery(this).val("");
				}
			});
			jQuery(".search_input").on('focusout', function(){
				if(jQuery(this).val()==""){
					jQuery(this).val("<?php esc_html__( 'Search...', 'sinrato' );?>");
				}
			});
			jQuery(".blogsearchsubmit").on('click', function(){
				if(jQuery("#search_input").val()=="<?php esc_html__( 'Search...', 'sinrato' );?>" || jQuery("#search_input").val()==""){
					jQuery("#search_input").focus();
					return false;
				}
			});
		});
		<?php
		$jsvars = ob_get_contents();
		$jsvars = preg_replace( '/\s*/m', '', $jsvars);
		$jsvars = str_replace( 'var', 'var ', $jsvars);
		ob_end_clean();
		if(function_exists('WP_Filesystem')){
			if($wp_filesystem->exists(get_template_directory(). '/js/variables.js')){
				$jsvariables = $wp_filesystem->get_contents(get_template_directory(). '/js/variables.js');
				if($jsvars!=$jsvariables){ //if new update, write file content
					$wp_filesystem->put_contents(
						get_template_directory(). '/js/variables.js',
						$jsvars,
						FS_CHMOD_FILE // predefined mode settings for WP files
					);
				}
			} else {
				$wp_filesystem->put_contents(
					get_template_directory(). '/js/variables.js',
					$jsvars,
					FS_CHMOD_FILE // predefined mode settings for WP files
				);
			}
		}
		//add css for footer, header templates
		$jscomposer_templates_args = array(
			'orderby'          => 'title',
			'order'            => 'ASC',
			'post_type'        => 'templatera',
			'post_status'      => 'publish',
			'posts_per_page'   => 30,
		);
		$jscomposer_templates = get_posts( $jscomposer_templates_args );
		if(count($jscomposer_templates) > 0) {
			foreach($jscomposer_templates as $jscomposer_template){ 
				$jscomposer_template_css = get_post_meta ( $jscomposer_template->ID, '_wpb_shortcodes_custom_css', false );
				if(isset($jscomposer_template_css[0]))
				wp_add_inline_style( 'sinrato-custom', $jscomposer_template_css[0] ); 
			}
		}
		//page width
		$sinrato_opt = get_option( 'sinrato_opt' );
		if(isset($sinrato_opt['box_layout_width'])){
			wp_add_inline_style( 'sinrato-custom', '.wrapper.box-layout {max-width: '.$sinrato_opt['box_layout_width'].'px;}' );
		}
	}
	//add sharing code to header
	function sinrato_custom_code_header() {
		global $sinrato_opt;
		if ( isset($sinrato_opt['share_head_code']) && $sinrato_opt['share_head_code']!='') {
			echo wp_kses($sinrato_opt['share_head_code'], array(
				'script' => array(
					'type' => array(),
					'src' => array(),
					'async' => array()
				),
			));
		}
	}
	/**
	 * Register sidebars.
	 *
	 * Registers our main widget area and the front page widget areas.
	 *
	 * @since Sinrato 1.0
	 */
	function sinrato_widgets_init() {
		$sinrato_opt = get_option( 'sinrato_opt' );
		register_sidebar( array(
			'name' => esc_html__( 'Blog Sidebar', 'sinrato' ),
			'id' => 'sidebar-1',
			'description' => esc_html__( 'Sidebar on blog page', 'sinrato' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'Shop Sidebar', 'sinrato' ),
			'id' => 'sidebar-shop',
			'description' => esc_html__( 'Sidebar on shop page (only sidebar shop layout)', 'sinrato' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'Single product Sidebar', 'sinrato' ),
			'id' => 'sidebar-single_product',
			'description' => esc_html__( 'Sidebar on product details page', 'sinrato' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'Pages Sidebar', 'sinrato' ),
			'id' => 'sidebar-page',
			'description' => esc_html__( 'Sidebar on content pages', 'sinrato' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		if(isset($sinrato_opt['custom-sidebars']) && $sinrato_opt['custom-sidebars']!=""){
			foreach($sinrato_opt['custom-sidebars'] as $sidebar){
				$sidebar_id = str_replace(' ', '-', strtolower($sidebar));
				if($sidebar_id!='') {
					register_sidebar( array(
						'name' => $sidebar,
						'id' => $sidebar_id,
						'description' => $sidebar,
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget' => '</aside>',
						'before_title' => '<h3 class="widget-title"><span>',
						'after_title' => '</span></h3>',
					) );
				}
			}
		}
	}
	static function sinrato_meta_box_callback( $post ) {
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'sinrato_meta_box', 'sinrato_meta_box_nonce' );
		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$value = get_post_meta( $post->ID, '_sinrato_post_intro', true );
		echo '<label for="sinrato_post_intro">';
		esc_html_e( 'This content will be used to replace the featured image, use shortcode here', 'sinrato' );
		echo '</label><br />';
		wp_editor( $value, 'sinrato_post_intro', $settings = array() );
	}
	static function sinrato_custom_sidebar_callback( $post ) {
		global $wp_registered_sidebars;
		$sinrato_opt = get_option( 'sinrato_opt' );
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'sinrato_meta_box', 'sinrato_meta_box_nonce' );
		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		//show sidebar dropdown select
		$csidebar = get_post_meta( $post->ID, '_sinrato_custom_sidebar', true );
		echo '<label for="sinrato_custom_sidebar">';
		esc_html_e( 'Select a custom sidebar for this post/page', 'sinrato' );
		echo '</label><br />';
		echo '<select id="sinrato_custom_sidebar" name="sinrato_custom_sidebar">';
			echo '<option value="">'.esc_html__('- None -', 'sinrato').'</option>';
			foreach($wp_registered_sidebars as $sidebar){
				$sidebar_id = $sidebar['id'];
				if($csidebar == $sidebar_id){
					echo '<option value="'.$sidebar_id.'" selected="selected">'.$sidebar['name'].'</option>';
				} else {
					echo '<option value="'.$sidebar_id.'">'.$sidebar['name'].'</option>';
				}
			}
		echo '</select><br />';
		//show custom sidebar position
		$csidebarpos = get_post_meta( $post->ID, '_sinrato_custom_sidebar_pos', true );
		echo '<label for="sinrato_custom_sidebar_pos">';
		esc_html_e( 'Sidebar position', 'sinrato' );
		echo '</label><br />';
		echo '<select id="sinrato_custom_sidebar_pos" name="sinrato_custom_sidebar_pos">'; ?>
			<option value="left" <?php if($csidebarpos == 'left') {echo 'selected="selected"';}?>><?php echo esc_html__('Left', 'sinrato'); ?></option>
			<option value="right" <?php if($csidebarpos == 'right') {echo 'selected="selected"';}?>><?php echo esc_html__('Right', 'sinrato'); ?></option>
		<?php echo '</select>';
	}
	function sinrato_save_meta_box_data( $post_id ) {
		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */
		// Check if our nonce is set.
		if ( ! isset( $_POST['sinrato_meta_box_nonce'] ) ) {
			return;
		}
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['sinrato_meta_box_nonce'], 'sinrato_meta_box' ) ) {
			return;
		}
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}
		/* OK, it's safe for us to save the data now. */
		// Make sure that it is set.
		if ( ! ( isset( $_POST['sinrato_post_intro'] ) || isset( $_POST['sinrato_custom_sidebar'] ) ) )  {
			return;
		}
		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['sinrato_post_intro'] );
		// Update the meta field in the database.
		update_post_meta( $post_id, '_sinrato_post_intro', $my_data );
		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['sinrato_custom_sidebar'] );
		// Update the meta field in the database.
		update_post_meta( $post_id, '_sinrato_custom_sidebar', $my_data );
		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['sinrato_custom_sidebar_pos'] );
		// Update the meta field in the database.
		update_post_meta( $post_id, '_sinrato_custom_sidebar_pos', $my_data );
	}
	//Change comment form
	function sinrato_before_comment_fields() {
		echo '<div class="comment-input">';
	}
	function sinrato_after_comment_fields() {
		echo '</div>';
	}
	/**
	 * Register postMessage support.
	 *
	 * Add postMessage support for site title and description for the Customizer.
	 *
	 * @since Sinrato 1.0
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer object.
	 */
	function sinrato_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
	/**
	 * Enqueue Javascript postMessage handlers for the Customizer.
	 *
	 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
	 *
	 * @since Sinrato 1.0
	 */
	function sinrato_customize_preview_js() {
		wp_enqueue_script( 'sinrato-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
	}
	function sinrato_admin_style() {
	  wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css');
	}
	/**
	* Utility methods
	* ---------------
	*/
	//Add breadcrumbs
	static function sinrato_breadcrumb() {
		global $post;
		$sinrato_opt = get_option( 'sinrato_opt' );
		$brseparator = '<span class="separator">/</span>';
		if (!is_home()) {
			echo '<div class="breadcrumbs">';
			echo '<a href="';
			echo esc_url( home_url( '/' ));
			echo '">';
			echo esc_html__('Home', 'sinrato');
			echo '</a>'.$brseparator;
			if (is_category() || is_single()) {
				if( is_category() ) {
	                single_term_title();
	            } elseif (is_single() ) {
					$categories = get_the_category();
					echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
					if ( count( $categories ) > 0 ) { echo ''.$brseparator; }
					the_title();
				}
			} elseif (is_page()) {
				if($post->post_parent){
					$anc = get_post_ancestors( $post->ID );
					$title = get_the_title();
					foreach ( $anc as $ancestor ) {
						$output = '<a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a>'.$brseparator;
					}
					echo wp_kses($output, array(
							'a'=>array(
								'href' => array(),
								'title' => array(),
							),
							'span'=>array(
								'class'=>array(),
							)
						)
					);
					echo '<span title="'.esc_attr($title).'"> '.esc_html($title).'</span>';
				} else {
					echo '<span> '.get_the_title().'</span>';
				}
			}
			elseif (is_tag()) {single_tag_title();}
			elseif (is_day()) {printf( esc_html__( 'Archive for: %s', 'sinrato' ), '<span>' . get_the_date() . '</span>' );}
			elseif (is_month()) {printf( esc_html__( 'Archive for: %s', 'sinrato' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'sinrato' ) ) . '</span>' );}
			elseif (is_year()) {printf( esc_html__( 'Archive for: %s', 'sinrato' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'sinrato' ) ) . '</span>' );}
			elseif (is_author()) {echo "<span>".esc_html__('Archive for','sinrato'); echo'</span>';}
			elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<span>".esc_html__('Blog Archives','sinrato'); echo'</span>';}
			elseif (is_search()) {echo "<span>".esc_html__('Search Results','sinrato'); echo'</span>';}
			echo '</div>';
		} else {
			echo '<div class="breadcrumbs">';
			echo '<a href="';
			echo esc_url( home_url( '/' ) );
			echo '">';
			echo esc_html__('Home', 'sinrato');
			echo '</a>'.$brseparator;
			if(isset($sinrato_opt['blog_header_text']) && $sinrato_opt['blog_header_text']!=""){
				echo esc_html($sinrato_opt['blog_header_text']);
			} else {
				echo esc_html__('Blog', 'sinrato');
			}
			echo '</div>';
		}
	}
	static function sinrato_limitStringByWord ($string, $maxlength, $suffix = '') {
		if(function_exists( 'mb_strlen' )) {
			// use multibyte functions by Iysov
			if(mb_strlen( $string )<=$maxlength) return $string;
			$string = mb_substr( $string, 0, $maxlength );
			$index = mb_strrpos( $string, ' ' );
			if($index === FALSE) {
				return $string;
			} else {
				return mb_substr( $string, 0, $index ).$suffix;
			}
		} else {
			if(strlen( $string )<=$maxlength) return $string;
			$string = substr( $string, 0, $maxlength );
			$index = strrpos( $string, ' ' );
			if($index === FALSE) {
				return $string;
			} else {
				return substr( $string, 0, $index ).$suffix;
			}
		}
	}
	static function sinrato_excerpt_by_id($post, $length = 25, $tags = '<a><span><em><strong>') {
		if ( is_numeric( $post ) ) {
			$post = get_post( $post );
		} elseif( ! is_object( $post ) ) {
			return false;
		}
		if ( has_excerpt( $post->ID ) ) {
			$the_excerpt = $post->post_excerpt;
			return apply_filters( 'the_content', $the_excerpt );
		} else {
			$the_excerpt = $post->post_content;
		}

		$the_excerpt = strip_shortcodes( strip_tags( $the_excerpt, $tags ) );
		$the_excerpt = preg_split( '/\b/', $the_excerpt, $length * 2 + 1 );
		$excerpt_waste = array_pop( $the_excerpt );
		$the_excerpt = implode( $the_excerpt );
		return apply_filters( 'the_content', $the_excerpt );
	}
	/**
	 * Return the Google font stylesheet URL if available.
	 *
	 * The use of Work Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * @since Sinrato 1.2
	 *
	 * @return string Font stylesheet or empty string if disabled.
	 */
	function sinrato_get_font_url() {
		$fonts_url = '';
		/* Translators: If there are characters in your language that are not
		* supported by Work Sans, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$work_san = _x( 'on', 'Work Sans font: on or off', 'sinrato' );
		if ( 'off' !== $work_san ) {
			$font_families = array();
			if ( 'off' !== $work_san ) {
				$font_families[] = 'Work Sans:400,500,600,700,900';
			}
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);
			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}
		return esc_url_raw( $fonts_url );
	}
	/**
	 * Displays navigation to next/previous pages when applicable.
	 *
	 * @since Sinrato 1.0
	 */
	static function sinrato_content_nav( $html_id ) {
		global $wp_query;
		$html_id = esc_attr( $html_id );
		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav id="<?php echo esc_attr($html_id); ?>" class="navigation" role="navigation">
				<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'sinrato' ); ?></h3>
				<div class="nav-previous"><?php next_posts_link( wp_kses(__( '<span class="meta-nav">&larr;</span> Older posts', 'sinrato' ),array('span'=>array('class'=>array())) )); ?></div>
				<div class="nav-next"><?php previous_posts_link( wp_kses(__( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sinrato' ), array('span'=>array('class'=>array())) )); ?></div>
			</nav>
		<?php endif;
	}
	/* Pagination */
	static function sinrato_pagination() {
		global $wp_query, $paged;
		if(empty($paged)) $paged = 1;
		$pages = $wp_query->max_num_pages;
			if(!$pages || $pages == '') {
			   	$pages = 1;
			}
		if(1 != $pages) {
			echo '<div class="pagination">';
			$big = 999999999; // need an unlikely integer
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'prev_text'    => esc_html__('Previous', 'sinrato'),
				'next_text'    =>esc_html__('Next', 'sinrato')
			) );
			echo '</div>';
		}
	}
	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own sinrato_comment(), and that function will be used instead.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Sinrato 1.0
	 */
	static function sinrato_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php esc_html_e( 'Pingback:', 'sinrato' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'sinrato' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 50 ); ?>
				</div>
				<div class="comment-info">
					<header class="comment-meta comment-author vcard">
						<?php
							printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
								get_comment_author_link(),
								// If current post author is also comment author, make it known visually.
								( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( 'Post author', 'sinrato' ) . '</span>' : ''
							);
							printf( '<time datetime="%1$s">%2$s</time>',
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( esc_html__( '%1$s at %2$s', 'sinrato' ), get_comment_date(), get_comment_time() )
							);
						?>
						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'sinrato' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- .reply -->
					</header><!-- .comment-meta -->
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'sinrato' ); ?></p>
					<?php endif; ?>
					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php edit_comment_link( esc_html__( 'Edit', 'sinrato' ), '<p class="edit-link">', '</p>' ); ?>
					</section><!-- .comment-content -->
				</div>
			</article><!-- #comment-## -->
		<?php
			break;
		endswitch; // end comment_type check
	}
	/**
	 * Set up post entry meta.
	 *
	 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
	 *
	 * Create your own sinrato_entry_meta() to override in a child theme.
	 *
	 * @since Sinrato 1.0
	 */
	static function sinrato_entry_meta() {
		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', ', ' );
		$num_comments = (int)get_comments_number();
		$write_comments = '';
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = esc_html__('0 comments', 'sinrato');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . esc_html__(' comments', 'sinrato');
			} else {
				$comments = esc_html__('1 comment', 'sinrato');
			}
			$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
		}
		$utility_text = null;
		if ( ( post_password_required() || !comments_open() ) && ($tag_list != false && isset($tag_list) ) ) {
			$utility_text = esc_html__( 'Tags: %2$s', 'sinrato' );
		} elseif ( $tag_list != false && isset($tag_list) && $num_comments != 0 ) {
			$utility_text = esc_html__( '%1$s / Tags: %2$s', 'sinrato' );
		} elseif ( ($num_comments == 0 || !isset($num_comments) ) && $tag_list==true ) {
			$utility_text = esc_html__( 'Tags: %2$s', 'sinrato' );
		} else {
			$utility_text = esc_html__( '%1$s', 'sinrato' );
		}
		if ( ($tag_list != false && isset($tag_list)) || $num_comments != 0 ) { ?>
			<div class="entry-meta">
				<?php printf( $utility_text, $write_comments, $tag_list); ?>
			</div>
		<?php }
	}
	static function sinrato_entry_meta_small() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list(', ');
		$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( wp_kses(__( 'View all posts by %s', 'sinrato' ), array('a'=>array())), get_the_author() ) ),
			get_the_author()
		);
		$utility_text = esc_html__( 'Posted by %1$s / %2$s', 'sinrato' );
		printf( $utility_text, $author, $categories_list );
	}
	static function sinrato_entry_comments() {
		$date = sprintf( '<time class="entry-date" datetime="%3$s">%4$s</time>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
		$num_comments = (int)get_comments_number();
		$write_comments = '';
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = wp_kses(__('<span>0</span> comments', 'sinrato'), array('span'=>array()));
			} elseif ( $num_comments > 1 ) {
				$comments = '<span>'.$num_comments .'</span>'. esc_html__(' comments', 'sinrato');
			} else {
				$comments = wp_kses(__('<span>1</span> comment', 'sinrato'), array('span'=>array()));
			}
			$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
		}
		$utility_text = esc_html__( '%1$s', 'sinrato' );
		printf( $utility_text, $write_comments );
	}
	
}
// Instantiate theme
$Sinrato_Class = new Sinrato_Class();
//Fix duplicate id of mega menu
function sinrato_mega_menu_id_change($params) {
	ob_start('sinrato_mega_menu_id_change_call_back');
}
function sinrato_mega_menu_id_change_call_back($html){
	$html = preg_replace('/id="mega_main_menu"/', 'id="mega_main_menu_first"', $html, 1);
	$html = preg_replace('/id="mega_main_menu_ul"/', 'id="mega_main_menu_ul_first"', $html, 1);
	return $html;
}
add_action('wp_loaded', 'sinrato_mega_menu_id_change');
function theme_prefix_enqueue_script() {
	wp_add_inline_script( 'sinrato', 'var ajaxurl = "'.admin_url('admin-ajax.php').'";','before' );
}
add_action( 'wp_enqueue_scripts', 'theme_prefix_enqueue_script' );
// Wishlist count
if( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ){
function yith_wcwl_ajax_update_count(){
wp_send_json( array(
'count' => yith_wcwl_count_all_products()
) );
}
add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}
function roadthemez_setup(){ 
    // Load admin resources.
    if (is_admin()) { 
        require  get_template_directory().'/road_importdata/class-tgm-plugin-activation.php';
        require  get_template_directory().'/road_importdata/roadtheme-setup.php';
	}
}
add_action('after_setup_theme', 'roadthemez_setup', 9, 0);

include 'functions-custom.php';