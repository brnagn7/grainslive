<?php

add_action('admin_menu', 'add_admin');
add_action('admin_head','itx_favicon');

function add_admin() {
    $options_page=add_theme_page('welcome', THEME_NICENAME.' Theme Options', 'edit_themes', get_stylesheet().'_theme_options', 'editoptions');
    add_action('admin_print_scripts-'. $options_page, 'itx_admin_scripts');
    add_action('admin_print_styles-'. $options_page, 'itx_admin_styles');
    add_action( 'admin_init', 'register_itx_settings' );
}

function itx_options(){
    return array('layout','front','header','bg','menu','links','single','css','misc','reset');
}

function register_itx_settings() {
    foreach (itx_options() as $v){
        register_setting( 'itx-options', get_stylesheet().'_'.$v );
    }
}
 
function editoptions() {
    include ADMIN_PATH."/template/options.php";
}

function itx_admin_scripts() {
    wp_enqueue_script('jquery-ui-tabs');
}

function itx_admin_styles() {
    echo'<link rel="stylesheet" href="'.get_bloginfo('template_url').'/admin/admin.css" type="text/css" />';
    echo'<link rel="stylesheet" href="'.get_bloginfo('template_url').'/css/ui/base/jquery.ui.core.css" type="text/css" />';
    echo'<link rel="stylesheet" href="'.get_bloginfo('template_url').'/css/ui/base/jquery.ui.tabs.css" type="text/css" />';
    echo'<link rel="stylesheet" href="'.get_bloginfo('template_url').'/css/ui/base/jquery.ui.theme.css" type="text/css" />';
    echo'<style type="text/css">';
    itx_header_styles();
    extract(itx_get_option('bg'));
    $resize=$resize/10;
    echo "#thebody{background: url($image) $attachment $repeat $h_align $v_align $bgcolor;font-size: {$resize}px;height:500px;}";
    echo '</style>';
}

function itx_form_radios($options,$name,$checked,$showa=true) {
    $i='A';
    foreach ($options as $v=>$type){
        if ($showa) echo "<span>$i.</span>";
        echo '<input type="radio" name="'.get_stylesheet().'_'.$name.'"';
        if ($checked==$v) echo ' checked="checked"';
        echo' value="'.$v.'"> '.$type.'<br />';
        $i++;
    }
}

function itx_form_options($options,$selected) {
    foreach ( $options as $id => $val ) {
        $ret.= '<option value="' . $id . '" ';
        if ($selected == $id) $ret.= 'selected="selected"';
        $ret.= '> '.$val.' </option>';
    }
    echo $ret;
}

if ($reset=get_option(get_stylesheet().'_reset')){
    if ($reset==1){
        foreach (itx_options() as $v){
            delete_option(get_stylesheet().'_'.$v);
        }
    } else {
	delete_option(get_stylesheet()."_$reset");
    }
    delete_option(get_stylesheet().'_reset');
}
?>