<?php
/**
 * Common functions and hooks handler
 *
 * @package itx_themes
 * @version 2.0
 */

define('ADMIN_PATH', TEMPLATEPATH.'/admin/');
define('CSS_PATH', TEMPLATEPATH.'/css/');

if ( is_admin() ) require_once ADMIN_PATH.'admin.php';
require_once 'bg.php';
require_once 'front.php';
require_once 'header.php';
require_once 'option.php';
require_once 'layout.php';
require_once 'navigation.php';
require_once 'single.php';
require_once 'widget.php';

if ( function_exists( 'add_theme_support' ) ){
	add_theme_support('automatic-feed-links');
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( itx_get_option('front','thumbx'), itx_get_option('front','thumby'), true );
    add_image_size('featured', itx_get_option('front','featuredx'), itx_get_option('front','featuredy'),true);
}

add_filter('query_vars', 'itx_add_new_var');
function itx_add_new_var($vars) {
    $vars[] = 'itx';
    return $vars;
}

add_action('template_redirect', 'itx_custom_request');
function itx_custom_request(){
    $vars = get_query_var('itx');
    if ($vars == 'css'){
        include_once ('style.php');
        exit;
    }elseif ($vars == 'js'){
        include_once ('js.php');
        exit;
    }
}

function itx_preview_vars($var){
	if (get_query_var('preview')) return add_query_arg('itx',$var);
	else return '/?itx='.$var;
}

function itx_featured_length() {
	return itx_get_option('front','featuredlim');
}

function itx_excerpt_length() {
	return itx_get_option('front','excerptlim');
}

if (!function_exists('wp_pagenavi')){
    require_once 'wp-pagenavi.php';
}

function itx_ping($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>">
	<div class="comment-author vcard">
	    <cite><?php comment_author_link() ?></cite>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
        <em><?php _e('Your comment is awaiting moderation.') ?></em>
        <?php endif; ?>

        <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
        <?php comment_text() ?>
    </div>
<?php
 }

add_action('wp_footer','itx_footer',1);
function itx_footer(){
    $da=itx_setting('vars');
    if ($ech=$da['data']) $ech = $ech.'<!-- '.get_stylesheet().' '.THEME_VERSION." -->\n";
    else $ech = '<strong><a href="'.THEME_URI.'">'.THEME_NICENAME.' Theme</a></strong> forged by <a href="http://itx.web.id/">itx</a><!-- '.get_stylesheet().' '.THEME_VERSION." noopt -->\n";
	echo apply_filters('itx_footer', $ech);
	echo '</div></div></div></div>';
}

add_action('itx_styles','itx_custom_css');
function itx_custom_css(){
	echo "\n\n".itx_get_option('css','insert');
}

add_action('wp_head','itx_favicon');
function itx_favicon(){
    $fav=itx_get_option('misc','favicon');
    if($fav) echo '<link rel="shortcut icon" href="'.$fav.'" />';
}

/*
 * Generate random default style 
 */
$def_style=get_option(get_stylesheet().'_default_style');
if (empty($def_style)){
	$styles=array_keys(itx_setting('style'));
	$style=array_slice($styles,rand(0,count($styles)-1),1);
	update_option(get_stylesheet().'_default_style', $style[0]);
}
?>