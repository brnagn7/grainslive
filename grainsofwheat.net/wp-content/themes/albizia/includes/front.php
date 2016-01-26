<?php
/**
 * Functions to handle the front page
 *
 * @package itx_themes
 * @version 2.0.2
 */

/**
 * Function to get the post-thumbnail.
 *
 * @param bool Wether it's featured image or not.
 * @return string Post-image with the container tag.
 */

 function itx_thumbnail($featured=false){
    global $wp_query;
    extract(itx_get_option('front'));
    if($featured){
        $x=$featuredx;
        $y=$featuredy;
    }else{
        $x=$thumbx;
        $y=$thumby;
    }

    // get post thumbnail (WordPress 2.9+)
    if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
        $img_id=get_post_thumbnail_id();

    //get the thumbnail from custom field
    }elseif($post_img=get_post_meta(get_the_ID(), 'thumb', true)) {
        if (is_numeric($post_img)) $img_id=$post_img;
        else $imgurl=$post_img;

    // get one of thumbnail from the post (if any)
    }elseif($catch){
        if ( $images = get_children( 'post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image') ) {
            asort($images);
            $keys=array_keys($images);
            $img_id=$keys[0];
        }
    }

	$style='';
	if (!empty($img_id)) {
		$img = wp_get_attachment_image_src( $img_id,'post-thumbnail');

		if ($img[1]!=$x && $img[2]!=$y) $img = wp_get_attachment_image_src($img_id);

		if ($featured){
			$img = wp_get_attachment_image_src( $img_id,'featured');
			if ($img[1]!=$x && $img[2]!=$y){
				$imgl= wp_get_attachment_image_src( $img_id,'medium');
				if ($x>0.9*$imgl[1]||$y>0.9*$imgl[2]){$img=$imgl;$imgl= wp_get_attachment_image_src( $img_id,'large' );}
				if ($x>0.9*$imgl[1]||$y>0.9*$imgl[2]){$img=$imgl;$imgl= wp_get_attachment_image_src( $img_id,'full' );}
				if ($x>0.9*$imgl[1]||$y>0.9*$imgl[2]){$img=$imgl;}
			}
		}

		if ($img){
			$src=$img[0];
			$width=$img[1];
			$height=$img[2];
			$yy=@($x*$height/$width);
			$xx=@($y*$width/$height);
			$ml=$mt='';
			if ($x<$xx){$ml='margin-left: -'.(($xx-$x)/2).'px';}
			elseif ($y<$yy){$mt='margin-top: -'.(($yy-$y)/2).'px';}
			$style=($ml||$mt)?"style='$mt$ml'":'';
		}
	}elseif (!empty($imgurl)){
		$image=@getimagesize($imgurl);
		if ($image){
			$xx=$image[1]*$x/$y;
			$yy=$image[0]*$y/$x;
			if ($x/$y>$image[0]/$image[1]){$height=$yy;$width=$image[0];}
			else {$width=$xx;$height=$image[1];}
		} else {$width=$x;$height=$y;}
		$src=$imgurl;
	}

    if (!empty($src)){
        $size=($x/$y <= @($width/$height))?"height='$y'":"width='$x'";
        $src= "<img src='$src' $style $size alt='".get_the_title()."' />";
    //set image replacement
    } elseif($not==2){
        if ($featured&&$fnotimg) $src= "<img src='$fnotimg' alt='".get_the_title()."'  />";
        elseif(!$featured&&$notimg) $src= "<img src='$notimg' alt='".get_the_title()."' />";
    } elseif($not==1){
		$src= '<img src="'.get_bloginfo('template_url').'/images/spacer.gif" alt="'.get_the_title().'" width="'.$x.'" height="'.$y.'" />';
	} else {return;}

    return '<div class="ui-widget-header cont"><a href="'.get_permalink().'">'.$src.'</a></div>';

}

/**
 * Function to print front page style
 *
 */
function itx_front_styles(){
    extract(itx_get_option('front'));
    $postwidth=($type=='traditional')?100:100/$column;
    echo"
.posts{width:$postwidth%;}
.itx-thumb .cont{width:{$thumbx}px;height:{$thumby}px;}
.itx-featured .cont{width:{$featuredx}px;height:{$featuredy}px;}";
}

/**
 * Function to change excerpt more to custom text.
 *
 */
function itx_excerpt_more() {
	$more=itx_get_option('front','excerpt_more');
	if ($more) return ' <a href="'. get_permalink() . '"><b>'.$more.'</b></a>';
}
add_filter('excerpt_more', 'itx_excerpt_more');

/**
 * Function print the meta value
 *
 * @param string The position/location of the meta.
 */
function itx_meta($pos,$class=''){
	$all_pos=itx_get_option('front','meta');
	if (!empty($all_pos[$pos])){
		$meta=$all_pos[$pos];
		echo "<div class='$meta $class'>";
		if (has_filter('itx_meta_'.$meta)) apply_filters ('itx_meta_'.$meta);
		else {
			switch ($meta){
			case ('date') :
				echo '<span class="ui-icon ui-icon-calendar"></span>';
				the_time(get_option('date_format'));
				break;

			case ('category') :
				echo '<span class="ui-icon ui-icon-folder-open"></span>';
				$c=get_the_category();
				echo $c[0]->cat_name;
				break;

			case ('author') :
				echo '<span class="ui-icon ui-icon-person"></span>';
				the_author_link();
				break;

			case ('author_posts') :
				echo '<span class="ui-icon ui-icon-person"></span>';
				the_author_posts_link();
				break;

			case ('author_link') :
				echo '<span class="ui-icon ui-icon-person"></span>';
				the_author_link();
				break;

			case ('commentcount') :
				echo '<span class="ui-icon ui-icon-comment"></span>';
				echo '<a href="'.get_comments_link().'">';
				comments_number('0','1', '%');
				echo '</a>';
				break;

			}
		}
		echo '</div>';
	}
}

/**
 * Function check wether meta is shown.
 *
 * @param string The position/location of the meta.
 * @return bool meta is active.
 */
function itx_is_active_meta($pos){
	$meta=itx_get_option('front','meta');
	if (!empty($meta[$pos])) return true;
}

?>