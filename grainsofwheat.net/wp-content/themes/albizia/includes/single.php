<?php
/**
 * Functions for single post/page
 *
 * @package itx_themes
 * @version 2.0.1
 */

/**
 * Function print the meta value in single post/page
 *
 * @param string The position/location of the meta.
 */
function itx_single_meta($meta,$class=''){
	if (is_singular ()){
		if (!is_page()) $all_meta=itx_get_option('single','post_meta');
		else $all_meta=itx_get_option('single','page_meta');
	} else $all_meta=itx_get_option('front','post_meta');

	if (!empty($all_meta[$meta])){
		echo "<div class='$meta $class'>";
		if (has_filter('itx_single_meta_'.$meta)) apply_filters ('itx_single_meta_'.$meta);
		else {
			switch ($meta){
			case ('commentcount') :
				echo '<span class="ui-icon ui-icon-comment"></span>';
				echo '<a href="'.get_comments_link().'">';
				comments_number('0','1', '%');
				echo '</a>';
				break;

			case ('date') :
				the_time(get_option('date_format'));
				break;

			case ('author') :
				echo 'by ';
				if ($all_meta['author']=='author') the_author();
				elseif ($all_meta['author']=='author_posts') the_author_posts_link();
				else the_author_link();
				break;

			case ('categories') :
				echo '<span class="ui-icon ui-icon-folder-open"></span> : ';
				the_category(', ');
				break;

			case ('tags') :
				if (get_the_tags()){
					echo '<span class="ui-icon ui-icon-tag"></span> : ';
					the_tags('');
				}
				break;

			case ('author_info') :
				echo '<h4>About the author</h4>'.
				'<span>'.strip_tags(get_the_author_meta('description')).'</span>'.
				get_avatar(get_the_author_meta('email'), 48);
				if ($all_meta['author_info']=='link'){
					$user_url=get_the_author_meta('user_url');
					if (!empty($user_url)) echo '<div class="author_url"><a href="'.$user_url.'">'.str_replace('http://', '', $user_url).'</a></div>';
				}
				echo '<div class="clear"></div>';
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
function itx_is_active_single_meta($pos){
	if (is_page()) $meta=itx_get_option('single','page_meta');
	else $meta=itx_get_option('single','post_meta');
	if (!empty($meta[$pos])) return true;
	else return false;
}

?>