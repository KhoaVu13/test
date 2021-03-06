<?php
/**
 * Template and theme collector.
 *
 * @package query-monitor
 */

class QM_Collector_Theme extends QM_Collector {

	public $id                  = 'response';
	protected $got_theme_compat = false;

	public function name() {
		return __( 'Theme', 'query-monitor' );
	}

	public function __construct() {
		parent::__construct();
		add_filter( 'body_class',       array( $this, 'filter_body_class' ), 9999 );
		add_filter( 'timber/output',    array( $this, 'filter_timber_output' ), 9999, 3 );
		add_action( 'template_redirect', array( $this, 'action_template_redirect' ) );
	}

	public function get_concerned_actions() {
		return array(
			'template_redirect',
		);
	}

	public function get_concerned_filters() {
		$filters = array(
			'stylesheet',
			'stylesheet_directory',
			'template',
			'template_directory',
			'template_include',
		);

		foreach ( self::get_query_template_names() as $template => $conditional ) {
			// @TODO this isn't correct for post type archives
			$filter    = str_replace( '_', '', $template );
			$filters[] = "{$filter}_template_hierarchy";
			$filters[] = "{$filter}_template";
		}

		return $filters;
	}

	public function get_concerned_options() {
		return array(
			'stylesheet',
			'template',
		);
	}

	public static function get_query_template_names() {
		return array(
			'embed'             => 'is_embed',
			'404'               => 'is_404',
			'search'            => 'is_search',
			'front_page'        => 'is_front_page',
			'home'              => 'is_home',
			'post_type_archive' => 'is_post_type_archive',
			'taxonomy'          => 'is_tax',
			'attachment'        => 'is_attachment',
			'single'            => 'is_single',
			'page'              => 'is_page',
			'singular'          => 'is_singular',
			'category'          => 'is_category',
			'tag'               => 'is_tag',
			'author'            => 'is_author',
			'date'              => 'is_date',
			'archive'           => 'is_archive',
			'index'             => '__return_true',
		);
	}

	// https://core.trac.wordpress.org/ticket/14310
	public function action_template_redirect() {
		add_filter( 'template_include', array( $this, 'filter_template_include' ), PHP_INT_MAX );

		foreach ( self::get_query_template_names() as $template => $conditional ) {

			// If a matching theme-compat file is found, further conditional checks won't occur in template-loader.php
			if ( $this->got_theme_compat ) {
				break;
			}

			$get_template = "get_{$template}_template";

			if ( function_exists( $conditional ) && function_exists( $get_template ) && call_user_func( $conditional ) ) {
				$filter = str_replace( '_', '', $template );
				add_filter( "{$filter}_template_hierarchy", array( $this, 'filter_template_hierarchy' ), PHP_INT_MAX );
				call_user_func( $get_template );
				remove_filter( "{$filter}_template_hierarchy", array( $this, 'filter_template_hierarchy' ), PHP_INT_MAX );
			}
		}

	}

	public function filter_template_hierarchy( array $templates ) {
		if ( ! isset( $this->data['template_hierarchy'] ) ) {
			$this->data['template_hierarchy'] = array();
		}

		foreach ( $templates as $template_name ) {
			if ( file_exists( ABSPATH . WPINC . '/theme-compat/' . $template_name ) ) {
				$this->got_theme_compat = true;
				break;
			}
		}

		$this->data['template_hierarchy'] = array_merge( $this->data['template_hierarchy'], $templates );

		return $templates;
	}

	public function filter_body_class( array $class ) {
		$this->data['body_class'] = $class;
		return $class;
	}

	public function filter_template_include( $template_path ) {
		$this->data['template_path'] = $template_path;
		return $template_path;
	}

	public function filter_timber_output( $output, $data = null, $file = null ) {
		if ( $file ) {
			$this->data['timber_files'][] = $file;
		}

		return $output;
	}

	public function process() {

		$stylesheet_directory = QM_Util::standard_dir( get_stylesheet_directory() );
		$template_directory   = QM_Util::standard_dir( get_template_directory() );
		$theme_directory      = QM_Util::standard_dir( get_theme_root() );

		if ( isset( $this->data['template_hierarchy'] ) ) {
			$this->data['template_hierarchy'] = array_unique( $this->data['template_hierarchy'] );
		}

		foreach ( get_included_files() as $file ) {
			$file = QM_Util::standard_dir( $file );
			$filename = str_replace( array(
				$stylesheet_directory,
				$template_directory,
			), '', $file );
			if ( $filename !== $file ) {
				$slug          = trim( str_replace( '.php', '', $filename ), '/' );
				$display       = trim( $filename, '/' );
				$theme_display = trim( str_replace( $theme_directory, '', $file ), '/' );
				$count         = did_action( "get_template_part_{$slug}" );
				if ( $count ) {
					$this->data['template_parts'][ $file ]       = $display;
					$this->data['theme_template_parts'][ $file ] = $theme_display;
					$this->data['count_template_parts'][ $file ] = $count;
				} else {
					$slug  = trim( preg_replace( '|\-[^\-]+$|', '', $slug ), '/' );
					$count = did_action( "get_template_part_{$slug}" );
					if ( $count ) {
						$this->data['template_parts'][ $file ]       = $display;
						$this->data['theme_template_parts'][ $file ] = $theme_display;
						$this->data['count_template_parts'][ $file ] = $count;
					}
				}
			}
		}

		if ( ! empty( $this->data['template_path'] ) ) {
			$template_path       = QM_Util::standard_dir( $this->data['template_path'] );
			$template_file       = str_replace( array( $stylesheet_directory, $template_directory, ABSPATH ), '', $template_path );
			$template_file       = ltrim( $template_file, '/' );
			$theme_template_file = str_replace( array( $theme_directory, ABSPATH ), '', $template_path );
			$theme_template_file = ltrim( $theme_template_file, '/' );

			$this->data['template_path']       = $template_path;
			$this->data['template_file']       = $template_file;
			$this->data['theme_template_file'] = $theme_template_file;
		}

		$this->data['stylesheet']     = get_stylesheet();
		$this->data['template']       = get_template();
		$this->data['is_child_theme'] = ( $this->data['stylesheet'] !== $this->data['template'] );

		if ( isset( $this->data['body_class'] ) ) {
			asort( $this->data['body_class'] );
		}

	}

}

function register_qm_collector_theme( array $collectors, QueryMonitor $qm ) {
	$collectors['response'] = new QM_Collector_Theme();
	return $collectors;
}

if ( ! is_admin() ) {
	add_filter( 'qm/collectors', 'register_qm_collector_theme', 10, 2 );
}
