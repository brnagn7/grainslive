<?php
/**
 * Functions to handle the options
 *
 * @package itx_themes
 * @version 2.0
 */

function itx_get_option($opt,$i=false){
    if ($ret=get_option(get_stylesheet().'_'.$opt)){
        if(!$i) return $ret;
        elseif (is_object($ret)&&isset($ret->$i)) return $ret->$i;
        elseif (isset($ret[$i])) return $ret[$i];
        else return itx_default_option($opt,$i);
    } else return itx_default_option($opt,$i);
}

function itx_update_option($opt,$value,$i=false){
    if ($i) {
	$fval=get_option(get_stylesheet().'_'.$opt);
	$fval[$i]=$value;
	$value=$fval;
    }
    update_option(get_stylesheet().'_'.$opt,$value);
}

function itx_default_option($opt,$i=false){
	include 'options-default.php';
	$ret=$$opt;
	if (isset($ret)){
		if($i) {
			if (isset($ret[$i])) return $ret[$i];
			else return false;
		}
		else return $ret;
	} else return false;
}

function itx_setting($sett,$i=false){
	include 'settings.php';
	$ret=$$sett;
	if (isset($ret)){
		if($i) {
			if (isset($ret[$i])) return $ret[$i];
			else return false;
		}
		else return $ret;
	} else return false;
}
?>