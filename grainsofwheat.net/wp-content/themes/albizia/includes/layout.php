<?php
/**
 * Things to build the layout. most of it are sidebars and widget area
 *
 * @package itx_themes
 * @subpackage #1#2
 * @version 2.1
 */

/**
 * Function to get all active sidebar settings
 *
 * @return array All sidebars positions and settings
 */

function itx_all_sidebar(){
	$widget_area=itx_setting('widget_area');
    $bar=array(
        array('thename'=>'Sidebar #1','description'=>'The leftmost Sidebar.' ,
			'name'=>'sidebar','pos'=>'left','num'=>1),
        array('thename'=>'Sidebar #2','description'=>'The Second Left Sidebar.' ,
			'name'=>'sidebar','pos'=>'left','num'=>2),
        array('thename'=>'Inner Top','description'=>'Widget area that only appear in front page at the top of the content.' ,
			'name'=>'innertop'),
        array('thename'=>'Inner Bottom','description'=>'Widget area that only appear in front page at the bottom of the content.' ,
			'name'=>'innerbottom'),
        array('thename'=>'Sidebar #1','description'=>'The right sidebar.' ,
			'name'=>'sidebar','pos'=>'right','num'=>1),
        array('thename'=>'Sidebar #2','description'=>'The rightmost Sidebar.' ,
			'name'=>'sidebar','pos'=>'right','num'=>2),
        array('thename'=>'Footer','description'=>'Widget Area in Footer Section.' ,
			'name'=>'footer','title_class'=>'','body_class'=>''),
    );

    switch (itx_get_option('layout','column')){
        case 1: $ars=array(6,2,3);break;
        case 21: $ars=array(4,2,3,6);break;
        case 22: $ars=array(4,5,2,3,6);break;
        case 23: $ars=array(0,2,3,6);break;
        case 24: $ars=array(0,1,2,3,6);break;
        case 3: $ars=array(0,5,2,3,6);break;
    }

    $default=array('title_class'=>$widget_area['title_class'],'body_class'=>$widget_area['body_class']);
    foreach ($ars as $v){
        $bars[]=wp_parse_args($bar[$v],$default);
    }
    return $bars;
}

/**
 * Function to get sidebar according to the arguments given
 *
 * @param string|array Arguments of the sidebar
 * @return array Sidebars settings to be fetched
 */
function itx_get_sidebar($args){
    $bars=itx_all_sidebar();
	$pos=$names=$poss='';
    extract($args);
    if ($name){
        foreach ($bars as $k=>$named){
            if ($named['name']==$name){$names[$k]=$named;}
        }
        $bars=$names;
        if($pos&&$names){
            foreach ($names as $k=>$posed){
                if ($posed['pos']==$pos){$poss[$k]=$posed;}
            }
        $bars=$poss;
        }
    }
    return $bars;
}

if ( function_exists('register_sidebar') ){itx_reg_sidebar();}

/**
 * Function to register sidebar
 *
 */
function itx_reg_sidebar(){
    foreach (itx_all_sidebar() as $k=>$args){
        $pos='';
        extract($args);
        register_sidebar(array(
            'id'=> 'sidebar-'.($k+1),
            'name'=> "$thename Widget Area",
			'description'=> $description,
            'before_widget' => '<li id="%1$s" class="widget '.$pos.' %2$s"><div class="widgetwrap '.$body_class.' ">',
            'after_widget' => '</div></li>',
            'before_title' => '<h3 class="'.$title_class.'">',
            'after_title' => '</h3>',
        ));
    }
}

/**
 * Function fetch sidebar according to the arguments given
 *
 * @param string|array Arguments of the sidebar
 */
function itx_sidebar($args){
    $args=wp_parse_args($args);
    $bars=itx_get_sidebar($args);
    if ($bars){
		$pos='';
		extract($args);
		if ($pos)$pos='-'.$pos;
		echo '<div id="'.$name.$pos.'" class="'.$name.'">';
        foreach ( $bars as $k=>$v){
			$num='';
            extract($v);
            echo"<div class='$name-$num'>";
            if (itx_active_sidebar($k+1)) {
                echo '<ul>';
                dynamic_sidebar($k+1);
                echo '</ul><div class="clear"></div>';
            } else {itx_default_sidebar($num,$args);}
            echo '</div>';
        }
        echo '</div>';
    };
}

/**
 * Function fetch default sidebar if no active widget
 *
 * @param string|array Arguments of the sidebar
 */
function itx_default_sidebar($thenum,$args){
    $bars=itx_get_sidebar($args);
    foreach ( $bars as $k=>$v){
        extract($v);
		if($thenum==1&&$num==$thenum){
			if (function_exists('the_widget')){
				the_widget('itx_tabbed_sidebar');
			}
			echo'<ul>
			<li class="widget '.$body_class.'"><div class="widgetwrap">';
				get_search_form();
			echo '</div></li>';
			echo '<li class="widget '.$body_class.'"><div class="widgetwrap">
				<div id="calendar_wrap">';
				get_calendar();
				echo '</div>
			</div></li>
			<li class="widget '.$body_class.'"><div class="widgetwrap">
				<h3 class="'.$title_class.'">Pages</h3><ul>';
				wp_list_pages('title_li=');
			echo '</ul></div></li></ul>';
		} elseif($thenum==2&&$num==$thenum){
			echo '<ul>
			<li class="widget '.$body_class.'">
			<div class="widgetwrap">
			<h3 class="'.$title_class.'">Tags</h3>';
			wp_tag_cloud();
			echo '</div></li>
			<li class="widget '.$body_class.'">
			<div class="widgetwrap">
			<h3 class="'.$title_class.'">Meta</h3><ul>';
			wp_register();?>
			<li><?php wp_loginout(); ?></li>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php echo esc_attr(__('Syndicate this site using RSS 2.0')); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
			<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php echo esc_attr(__('The latest comments to all posts in RSS')); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
			<li><a href="http://wordpress.org/" title="<?php echo esc_attr(__('Powered by WordPress, state-of-the-art semantic personal publishing platform.')); ?>">WordPress.org</a></li>
			<?php wp_meta();
			echo '</ul></div></li></ul><div class="clear"></div>';
		}
    }
}

/**
 * Function to know wether a sidebar is in use. Added for supporting pre WP 2.8
 *
 * @param bool $id_base Name of the widget
 * @return bool Widget is active
 */
function itx_active_sidebar( $index ) {
	if (function_exists('is_active_sidebar')) return is_active_sidebar($index);
	$index = ( is_int($index) ) ? "sidebar-$index" : sanitize_title($index);
	$sidebars_widgets = wp_get_sidebars_widgets();
	if ( !empty($sidebars_widgets[$index]) )
		return true;
	return false;
}

/**
 * Function get the active widget excluding widgets in innertop and innerbottom area.
 *
 * @param bool $id_base Name of the widget
 * @return bool Widget is active
 */
function itx_active_widget($id_base = false) {
    global $wp_registered_widgets;

    //excluding innertop & innerbottom;
    foreach (itx_all_sidebar() as $k=>$args){
	if ($args['name']=='innertop'||$args['name']=='innerbottom') $ex[]=$k+1;
    }
    $sidebars_widgets = wp_get_sidebars_widgets();
    if ( is_array($sidebars_widgets) ) {
	foreach ( $sidebars_widgets as $sidebar => $widgets ) {
	    if ('wp_inactive_widgets'==$sidebar||"sidebar-$ex[0]" ==$sidebar || "sidebar-$ex[1]" ==$sidebar)
		continue;
	    if (is_array($widgets)) {
		foreach ( $widgets as $widget ) {
		    if ( $id_base && _get_widget_id_base($widget) == $id_base ) return true;
		}
	    }
	}
    }
    return false;
}

/**
 * Function fetch the styles for layout.
 *
 */
function itx_layout_styles($pad=15,$space=15){
    extract(itx_get_option('layout'));
    if($wrapping=='fixed'){
        if(!is_numeric($wrap)) $wrap=300;
        $wrapper=$wrap.'px';
        $wmargin='auto';
    } else {
        $wrapper='100%';
        $wmargin='0';
    }

	$side1=$side2=0;
	$lsidebar=$rsidebar=$sidebarswidth=$content='';
	$cfloat='left';

    if ($sidebarunit=='px') {
        $sidebar1=$sidebar1+$pad;
        $sidebar2=$sidebar2+$pad;
        if ($wrapping=='fixed'){
			$main="#mainwrap{margin:0;width:$wrapper}";
			if ($column==21||$column==22){
                $main="#sidebar-right{left:-{$pad}px;}";
            }elseif ($column==23||$column==24){
                $cfloat="right";
            }elseif ($column==3){
				$cpos=$wrap-$sidebar1;
				$main="#mainwrap{margin:0;width:$wrapper;right:{$cpos}px;position:relative;}#content{left:100%}#sidebar-right{left:".($cpos-$pad)."px;}#sidebar-left{left:".($sidebar2+$pad-$space)."px}";
            }
        } elseif ($column!=1){
			$lpad=$pad+$space;
            if ($column==21){
                $mainmargin=-$sidebar1-$pad;
                $pads=$sidebar1+2*$pad;
                $main="#sidebar-right{left:".($sidebar1-$pad)."px}";
            }elseif($column==22){
                $mainmargin=-$sidebar2-$sidebar1-$pad;
                $pads=$sidebar1+$sidebar2+2*$pad;
                $main="#sidebar-right{left:".($sidebar1+$sidebar2-$pad)."px}";
            }elseif ($column==23){
                $mainmargin=-$pad;
                $pads=$sidebar1+2*$pad;
                $main="#sidebar-left{left:{$lpad}px}";
            }elseif($column==24){
                $mainmargin=-$pad;
                $pads=$sidebar1+$sidebar2+2*$pad;
				$main="#sidebar-left{left:{$lpad}px}";
            } else{
                $mainmargin=-$sidebar2-$pad;
                $pads=$sidebar1+$sidebar2+2*$pad;
                $main="#sidebar-right{left:".($sidebar2-$space)."px}#sidebar-left{left:".($sidebar2+$lpad)."px}\n";
            }
            $main.="#mainwrap{width:200%;right:100%;float:left;position:relative;margin-left:{$mainmargin}px;}\n";
            $main.="#contentpad{margin-left:".($pads)."px;}\n";
            $content="50%;left:50%";
        }
    }
    else {
	if ($column==3){
            $content=96-$sidebar1-$sidebar2.'%';
            $side1=100;
            $side2=100;
			$main="#mainwrap{margin:0;right:".(98-$sidebar1)."%;position:relative;}#content{left:100%}#sidebar-right{left:".(96-$sidebar1)."%;}#sidebar-left{left:".($sidebar2+4)."%}#sidebar-left .widget,#sidebar-right .widget{margin-left:0}";
        }elseif ($column==21){
            $content=100-$sidebar1.'%';
            $side1=100;
            $main="#sidebar-right{left:-{$pad}px}";
        }elseif ($column==22) {
            $content=100-$sidebar1-$sidebar2.'%';
            $wide=$sidebar1+$sidebar2;
            $side1=$sidebar1*100/$wide;
            $side2=$sidebar2*100/$wide;
            $main="#sidebar-right{left:-{$pad}px;}";
        }elseif ($column==23) {
            $content=100-$sidebar1.'%';
            $side1=100;
            $cfloat="right";
         }elseif ($column==24) {
            $content=100-$sidebar1-$sidebar2.'%';
            $wide=$sidebar1+$sidebar2;
            $side1=$sidebar1*100/$wide;
            $side2=$sidebar2*100/$wide;
            $cfloat="right";
        }
    }
    if (!$side1) $side1=$sidebar1;
    if (!$side2) $side2=$sidebar2;
    if ($column==1){
        $main="#mainwrap{margin:0 {$pad}px;}";
        $content='100%';
    }elseif ($column==21){
        $rsidebar=$sidebar1;
        $sidebarswidth=".sidebar-1{width:$side1$sidebarunit;}";
        if (!$content)$content=($wrap-$sidebar1).'px';
    }elseif ($column==22){
        $rsidebar=$sidebar1+$sidebar2;
        $sidebarswidth=".sidebar-1{width:$side1$sidebarunit;}.sidebar-2{width:$side2$sidebarunit;}";
        if (!$content)$content=($wrap-$sidebar1-$sidebar2).'px';
    }elseif ($column==23){
        $lsidebar=$sidebar1;
        $sidebarswidth=".sidebar-1{width:$side1$sidebarunit;}";
        if (!$content)$content=($wrap-$sidebar1).'px';
   }elseif ($column==24){
        $lsidebar=$sidebar1+$sidebar2;
        $sidebarswidth=".sidebar-1{width:$side1$sidebarunit;}.sidebar-2{width:$side2$sidebarunit;}";
        if (!$content)$content=($wrap-$sidebar1-$sidebar2).'px';
    } elseif ($column==3){
        $lsidebar=$sidebar1;
        $rsidebar=$sidebar2;
        $sidebarswidth=".sidebar-1{width:$side1$sidebarunit;}.sidebar-2{width:$side2$sidebarunit;}";
        if (!$content)$content=($wrap-$sidebar1-$sidebar2).'px';
    }
    if ($lsidebar) $sidebarswidth.="#sidebar-left{width:$lsidebar$sidebarunit}";
    if ($rsidebar) $sidebarswidth.="#sidebar-right{width:$rsidebar$sidebarunit}";

    $itop=100/$innertop;
    $ibottom=100/$innerbottom;
    $footer=100/$footer;

    echo "
.wrap{width:$wrapper;margin:$wmargin;}
$main#content{width:$content;float:$cfloat;position:relative;overflow:hidden;}
#sidebar-left,#sidebar-right{position:relative;}
$sidebarswidth
#innertop .widget{width:$itop%;}
#innerbottom .widget{width:$ibottom%;}
#footer .widget{width:$footer%;}
";
}
?>