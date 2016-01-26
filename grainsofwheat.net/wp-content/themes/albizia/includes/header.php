<?php
/**
 * Functions to handle the custom header
 *
 * @package itx_themes
 * @version 2.0.1
 */

function itx_header(){
    extract(itx_get_option('header'));
    if ($head_type==1){
        echo'
        <div id="headerwrap">';
        if (!$scope) echo '<div id="header" class="wrap">';
            echo '<div class="clear"></div>
				<a href="'.get_option('home').'/" title="'.htmlspecialchars(get_bloginfo('name')).'">
                <img src="'.$logo.'" alt="'.htmlspecialchars(get_bloginfo('name')).'" title="'.htmlspecialchars(get_bloginfo('name')).'" />
            </a>';
        if (!$scope) echo '</div>';
        echo '</div>';
    }else{
        echo'
        <div id="headerwrap"><div class="clear"></div>
        <div id="header" class="wrap">';
		if ( is_home() || is_front_page() ){
			echo '<h1 class="header"><a href="'.get_option('home').'">'.get_bloginfo('name').'</a></h1>';
		} else {
			echo '<div class="header"><a href="'.get_option('home').'">'.get_bloginfo('name').'</a></div>';
		}
        echo'<span>'.get_bloginfo('description').'</span>
        </div>
        </div>';
    }
}

function itx_header_styles(){
	$halfwrap=$fullwrap='';
    extract(itx_get_option('header'));

	$height=empty($height)?'':" height:$height;";
	$bg=(empty($bg))?$image:$bg;
	$img="background:$bgcolor url($bg) $repeat $h_align $v_align;$height";
	if ($scope==1) $fullwrap=$img;
	else $halfwrap=$img;

	if (itx_get_option('layout','wrapping')=='fixed') $maxw=itx_get_option('layout','wrap').'px';
    else $maxw='98%';
    echo "
#headerwrap{ $fullwrap text-align: $text_align;}
#header{ $halfwrap }
#header .header {font-size: {$font_size};}
#header .header a {color: $color;text-decoration: none;}
#header .header a:hover {color: $hover_color;}
#header img{max-width:$maxw;}
#header span {font-size: {$span_font_size};color: $span_color;}";
}

?>