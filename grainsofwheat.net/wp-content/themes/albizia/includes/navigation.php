<?php
/**
 * Things to alter navigation menu
 *
 * @package itx_themes
 * @subpackage albizia
 * @version 2.1
 */

/**
 * Function to display navigation menu: Primary Navigation and Top Navigation.
 *
 * @uses wp_nav_menu()
 *
 * @see wp_nav_menu() For possible values for the parameter.
 * @param string|array $args Optional. Override defaults.
 */
function itx_menu($args=''){
    extract(itx_get_option('menu'));
    $args=(wp_parse_args($args));
    if ( function_exists('wp_nav_menu') && !empty($wp_menu)){
        if ($args['theme_location']=='top') {
            $home=$top_home;
            $depth=$top_depth;
        }
        $passed_args=array('container'=>false,'fallback_cb'=>'itx_menu_','depth'=>$depth);
        wp_nav_menu(wp_parse_args($passed_args,$args));
        return;
    } else itx_menu_($args);
}

/**
 * Function to display navigation menu in if user choose to use itx Menu or for older than WordPress 3.0 users
 *
 */
function itx_menu_($args){
	$cat_inc=$page_inc=0;
	$menu_class='';
    extract(itx_get_option('menu'));
    extract(wp_parse_args($args));
    if($theme_location=='top'){
        $home=$top_home;
        $depth=$top_depth;
        $show=$top_show;
    }
    if ($show){
        echo '<ul class="'.$menu_class.'">';
        if ($home) echo '<li><a href="'.get_option('home').'">'.$home.'</a></li>';

        if ($cat_inc){
          @sort($cat_inc);
          $cat_inc=@implode(',',$cat_inc);
          $opt="&include=$cat_inc";
          if ($cat_sortby) {$opt.="&orderby=".$cat_sortby;};
          if ($cat_order) {$opt.="&order=".$cat_order;};
          $cat_args="title_li=&depth=$depth$opt";
        } else {
          $cat_args='title_li=&number=9';
        }

        if ($page_inc){
          @sort($page_inc);
          $page_inc=@implode(',',$page_inc);
          $opt="&include=$page_inc";
          if ($cat_sortby) {$opt.="&orderby=".$cat_sortby;};
          if ($cat_order) {$opt.="&order=".$cat_order;};
          $page_args="title_li=&depth=$depth$opt";
        } else {
          $page_args='title_li=&number=9';
        }

        if ($show=='cat'){
            wp_list_categories($cat_args);
        } elseif ($show=='page'){
            wp_list_pages($page_args);
        } elseif ($show=='cp'){
            wp_list_categories($cat_args);
            wp_list_pages($page_args);
        } elseif ($show=='pc'){
            wp_list_pages($page_args);
            wp_list_categories($cat_args);
        }

        echo'</ul>';
    }
}

function itx_menu_styles(){
    extract(itx_get_option('menu'));
	$bgcolor=(!empty($top_bg_color))?$top_bg_color:'transparent';
    echo "
ul.top-menu{margin:0 {$top_margin}px;float:{$top_align};background-color:$bgcolor;}";
	if( $align  == 'center' ) {
		echo "
#menu .wrap1 {clear:left;float:right;margin:0;padding:0;position:relative;right:50%;text-align:center;}
#menu .wrap2 {padding:0 4px;position:relative;left:50%;float:left;}";
	} elseif( $align == 'right' ) {
		echo "
#menu .wrap2 {float:right;}";
	} else {
		echo "
#menu .wrap2 {float:left;}";
	}
}

if ( function_exists('wp_nav_menu')&&itx_get_option('menu','wp_menu')){
    register_nav_menu( 'top' , 'Top Navigation' );
    register_nav_menu( 'primary' , 'Primary Navigation');
}
?>