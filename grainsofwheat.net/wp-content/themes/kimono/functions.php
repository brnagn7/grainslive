<?php
/**
 * kimono functions and definitions
 *
 * @package kimono
 */
/**
 * Custom template tags for this theme.
 */
require( get_template_directory() . '/inc/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates
 */
require( get_template_directory() . '/inc/extras.php' );

/**
 * Customizer additions
 */
require( get_template_directory() . '/inc/customizer.php' );


/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'kimono_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function kimono_setup() {
	
/**
 * Set the content width based on the theme's design and stylesheet.
 */
global $content_width;
if ( ! isset( $content_width ) )
	$content_width = 700; /* pixels */

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on kimono, use a find and replace
	 * to change 'kimono' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'kimono', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	set_post_thumbnail_size( 320, 230, true );
}
endif; // kimono_setup
add_action( 'after_setup_theme', 'kimono_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */


/**
 * Register widgetized area and update sidebar with default widgets
 */
function kimono_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'kimono' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}

add_action( 'widgets_init', 'kimono_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function kimono_scripts() {

	wp_enqueue_style( 'kimono-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bxslider-style', get_template_directory_uri() . '/css/jquery.bxslider.css' );
	wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), '' );
	wp_enqueue_script( 'ah-placeholder', get_template_directory_uri() . '/js/jquery.ah-placeholder.js', array(), '' );
	wp_enqueue_script( 'kimono-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array() );

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'kimono-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
	
	wp_enqueue_script(
    'kimono_function',
    get_template_directory_uri() . '/js/cs.js', 
    array('jquery') 
); 


}
add_action( 'wp_enqueue_scripts', 'kimono_scripts' );

function kimono_new_excerpt_mblength($length) {
     return 180;
}
add_filter('excerpt_length', 'kimono_new_excerpt_mblength');

function kimono_new_excerpt_more($post) {
	
    return ' ...<a class="readmore" href="'. esc_url( get_permalink() ) . '">' . 'read more' . '</a>';	
}	
add_filter('excerpt_more', 'kimono_new_excerpt_more');

add_filter( "comment_form_defaults", "kimono_my_comment_notes_after");

function kimono_my_comment_notes_after($defaults){
  $defaults['comment_notes_after'] = '';
  return $defaults;
}



add_action('admin_print_styles', 'kimono_my_admin_print_styles');
function kimono_my_admin_print_styles() {
  wp_enqueue_style( 'farbtastic' );
}
add_action('admin_enqueue_scripts', 'kimono_my_admin_enqueue_scripts');
function kimono_my_admin_enqueue_scripts() {
  wp_enqueue_script( 'farbtastic' );
  wp_enqueue_script( 'quicktags' );
  wp_enqueue_script( 'my-admin-script', get_stylesheet_directory_uri() . '/admin-script.js', array( 'farbtastic', 'quicktags' ), false, true );
}



// kimono_fc_settings_page() displays the page content for the Header and Footer Commander submenu
function kimono_fc_settings_page() {

	//must check that the user has the required capability 
	if (!current_user_can('edit_theme_options')) {

	}
        
	//checks to see if empty then populates values


	// See if the user has posted us some information
	// If they did, this hidden field will be set to 'Y'

	if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
 
}
?>

</form>
<?php }


function kimono_paginate() {
    global $wp_query;

    $big = 999999999;

    // http://codex.wordpress.org/Function_Reference/paginate_links
    $paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'mid_size' => 5
    ) );

    if ( $paginate_links ) {
        echo '<div class="pagination">';
        echo $paginate_links;
        echo '</div><!--// end .pagination -->';
    }
}



?>
