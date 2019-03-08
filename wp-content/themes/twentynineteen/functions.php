<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'twentynineteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function twentynineteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'twentynineteen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'twentynineteen' ),
				'footer' => __( 'Footer Menu', 'twentynineteen' ),
				'social' => __( 'Social Links Menu', 'twentynineteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'twentynineteen' ),
					'shortName' => __( 'S', 'twentynineteen' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'twentynineteen' ),
					'shortName' => __( 'M', 'twentynineteen' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'twentynineteen' ),
					'shortName' => __( 'L', 'twentynineteen' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'twentynineteen' ),
					'shortName' => __( 'XL', 'twentynineteen' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'twentynineteen' ),
					'slug'  => 'primary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => __( 'Secondary', 'twentynineteen' ),
					'slug'  => 'secondary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'twentynineteen' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'twentynineteen' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'twentynineteen' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'twentynineteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function twentynineteen_scripts() {
	wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '1.1', true );
		wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '1.1', true );
	}

	wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentynineteen_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentynineteen_editor_customizer_styles() {

	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function twentynineteen_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo twentynineteen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentynineteen_colors_css_wrap' );

function tao_custom_post_type_nhatro() {
		
		$label = array(
			'name' =>  __( 'Nhà trọ' ),
			'singular_name' =>  __( 'Phòng trọ' ),
		);

		$args = array(
			'labels' => $label,
        	'description' => 'Post type đăng sản phẩm',
        	'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'trackbacks',
            'revisions',
            'custom-fields'
        ),

        'taxonomies' => array( 'category', 'post_tag' ), 
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true, 
        'show_in_nav_menus' => true, 
        'show_in_admin_bar' => true, 
        'menu_position' => 5,
        'can_export' => true, 
        'has_archive' => true,
        'exclude_from_search' => false, 
        'publicly_queryable' => true, 
        'capability_type' => 'post'
		);

		register_post_type( 'sanpham' , $args );
	}

add_action( 'init', 'tao_custom_post_type_nhatro' );
//Hiển thị post type ra màn hình
function lay_custom_post_type_nhatro($query){
	if(is_home() && $query->is_main_query())
		$query->set('post_type',array('post','download','portfolio', 'tao_custom_post_type_nhatro'));
	return $query;
}
add_filter('pre_get_posts','lay_custom_post_type_nhatro');

function show_custom_fields(){

	/*$tiendien = get_post_meta( $post->ID, 'Tiền điện', true );
	$sdt = get_post_meta( $post->ID, 'SĐT', true );
	$diachi = get_post_meta( $post->ID, 'Địa chỉ', true );
	$tiennuoc = get_post_meta( $post->ID, 'Tiền nước', true );
		if($tiendien || $sdt || $diachi || $tienuoc){
			echo 'Tiền điện: ' . $tiendien . '&nbsp;đồng</br>';
			echo 'Số điện thoại: ' . $sdt . '</br>';
			echo 'Địa chỉ: ' . $diachi . '</br>';
			echo 'Tiền nước: ' . $tiennuoc . '&nbsp;đồng</br>';
		}*/
		?>
			<form method='POST'>
				<label>Title<input type="text" name="title"></label>		
				<label>Content<input type="text" name="content"></label>
				<input type="submit">
			</form>
		<?php

		//print_r($_GET);
		if(isset($_POST["title"]))
		{                                                             
			//print_r($_POST['title']);
			global $id;
			$post_id= new WP_Query(array('s'=> $_POST['title']));
			//$get_meta_value = new WP_Query(array('s'=>$id));
			//$test_wp = new WP_Query(array('s'=>2));
			// echo '<pre>';
			// print_r($post_id);
			// echo '</pre>';

			//print_r($post_id);
			// /print_r($post_id);
			// The Loop
			if ( $post_id->have_posts() ) :
			while ( $post_id->have_posts() ) : $post_id->the_post();
				//	echo "ID";
				$id=get_the_ID();
				// echo "TITLE";
				// echo get_the_title();
				// echo 'CONTENT:';
			 	//echo get_the_Content();
				//$get_meta_value = new WP_Query(array('s'=>$id));
			// 	if ( $get_meta_value->have_posts() ) :
			// while ( $get_meta_value->have_posts() ) : $get_meta_value->the_post();
				// echo '<pre>';
				//  print_r(get_post_meta($id));
				// echo '<pre>';
				//print_r(get_post_meta($id));
				print_r(get_post_meta($id)['Địa chỉ'][0]);
				//echo '</pre>';
				// echo '</pre>';
				// $the_post=get_post_meta($id);
				// echo "TIEN DIE";
				// print_r($the_post['Tiền điện'][0]);
			// endwhile;
			// endif;

			endwhile;
			endif;
		}
}
add_shortcode('short_code_showcustomfields','show_custom_fields');
add_filter( 'widget_text', 'do_shortcode' );

//shortcode function
function search_user(){
	echo '<form method="POST">
			<input type="text" name="info_search" placeholder="Nhập vào thông tin tìm kiếm">
			<input type="submit" value="Tìm kiếm">
		</form>';
	$search = $_POST["info_search"];
	global $wpdb;
	$results = $wpdb->get_results("Select guid from wp_posts where post_title like '".$search."%' ");
	//print_r($results);
	if(!empty($results)){
		for ($i=0; $i <count($results) ; $i++) { 
		print_r($results[$i]->guid);
		print_r('<br>');
		}
	}else{
		echo 'Không tìm thấy thông tin';
	}	
}
function search_by_custom_field(){
	$arr_checkbox=array('Chó','Mèo','Chim');
	echo '<form method="POST">';
	for($i=0;$i<count($arr_checkbox);$i++)
	{	
	echo '<input type="checkbox" name="pets_search[]" value="'.$arr_checkbox[$i].'">'.$arr_checkbox[$i];
	}
	echo '<input type="submit" value="Tìm kiếm">';
	echo '</form>'; 	
	$get_pets_search = $_POST['pets_search'];
	$get_pets_search_encode = json_encode($get_pets_search,JSON_UNESCAPED_UNICODE);
		$args = array(
			'meta_value'=>$get_pets_search_encode
		);
		
	$the_query = new WP_Query( $args );
	//print_r($the_query);die;
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
  		the_title();
	endwhile;
	endif;
	
	
	
}
function test_ACF($post_id){
	if(!empty($post_id)){
	echo $post_id;}
	else
	{
		echo "No";
	}
}
add_shortcode('short_code_search_user','search_user');
add_shortcode('short_code_search_customF','search_by_custom_field');
add_shortcode('sc_testACF','test_ACF');
//using shortcode [short_code_search_user]
//[short_code_search_customF]
//[sc_testACF]

add_filter( 'template_include_res', 'restaurant_page_template', 99 );

function restaurant_page_template( $template ) {

    if ( is_page( 'restaurant' ) ) {
        $new_template = locate_template( array( 'restaurant-page-template.php' ) );
        if ( !empty( $new_template ) ) {
            return $new_template;
        }
    }

    return $template;
}
add_action('test_template','restaurant_page_template');

function advance_search(){
    //print_r(get_categories());die;
    echo '<div class="advance_search_border">';
    echo '<select class="advance_selector">';
    echo '<option value=""></option>';
    for ($i=0;$i<=count(get_categories());$i++) {
        $value =get_categories()[$i]->term_id;// hàm đặc biệt , get các cate có trong db với select *
        $name = get_categories()[$i]->cat_name;
        echo '<option value="'.$value.'">'.$name.'</option>';
    }
    echo'</select>';
    echo '</div>';
}
//Search category
add_shortcode('sc_advance_search','advance_search');
//[sc_advance_search]
add_action('wp_ajax_advance_search', 'get_advance_search_results');
add_action('wp_ajax_nopriv_advance_search', 'get_advance_search_results');
function get_advance_search_results(){
    if(isset($_POST["id"])){
        $get_value= $_POST["value"];
        global $wpdb;
        $results = $wpdb->get_results("Select * from wp_term_relationships tr , wp_posts p where tr.object_id = p.ID and term_taxonomy_id = '".$get_value."' ");
        for($i=0;$i<count($results);$i++){
            echo $results[$i]->post_title;
                ?><tab><?php
            echo $results[$i]->post_content;
                ?><br><?php
        }die;
    }
}

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';




