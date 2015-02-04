<?php
/**
 * Functions to handle the custom background
 *
 * @package itx_themes
 * @version 2.0
 */

function itx_bg_styles(){
    extract(itx_get_option('bg'));
    $resize=$resize*0.625;
	$background='';
    if ($image) $background="background-image:url($image); background-attachment:$attachment;background-repeat: $repeat; background-position:$h_align $v_align ;";
    if ($bgcolor) $background.="background-color:$bgcolor;";
    echo "body{{$background}font-size: $resize%;}";
}
?>