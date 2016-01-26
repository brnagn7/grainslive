<?php
/**
* API for creating tabbed sidebar widget
*
* @package      itx_themes
* @subpackage   itx_tabbed_sidebar
* @version      1.2.4
* @author       itx
* @copyright    2010 itx
* @link         http://itx.web.id
* @uses         WP_Widget
*/
class itx_tabbed_sidebar extends WP_Widget {
    // Constructor
    function itx_tabbed_sidebar() {
        $widget_args = array(
            'classname'		=> 'itx_tabbed_sidebar',
            'description'	=> __('Sidebar containing tabs that displays posts, categories, pages, comments, tags, etc.', 'itx'),
        );
        $this->WP_Widget('itx_tabbed_sidebar', __('Tabbed Sidebar', 'itx'), $widget_args);
        $this->option = array(
                0=>__('None','itx'),
                'categories'=>__('Categories','itx'),
                'posts'=>__('Recent Posts','itx'),
                'comments'=>__('Recent Comments','itx'),
                'archives'=>__('Monthly Archives','itx'),
                'meta'=>__('Meta','itx'),
                'calendar'=>__('Calendar','itx'),
                'blogroll'=>__('Blogroll','itx'),
                'tags'=>__('Tag Cloud','itx'),
                'pages'=>__('Pages','itx'),
                "text"=>__('Custom Text','itx'),
            );
        $this->title = array(
                0=>__('None','itx'),
                'categories'=>__('Categories','itx'),
                'posts'=>__('Posts','itx'),
                'comments'=>__('Comments','itx'),
                'archives'=>__('Archives','itx'),
                'meta'=>__('Meta','itx'),
                'calendar'=>__('Calendar','itx'),
                'blogroll'=>__('Blogroll','itx'),
                'tags'=>__('Tags','itx'),
                'pages'=>__('Pages','itx'),
             );
    }
   
    function widget($args, $instance){		
        extract($args);
        echo $before_widget.'
<script type="text/javascript">/* <![CDATA[ */
jQuery(function () {
    jQuery("#'.$this->get_field_id('thetab').'").tabs({ event: "mouseover" });
});
/* ]]> */</script>
	<div class="tabbed" id="'.$this->get_field_id('thetab').'"><ul class="tabheader">';
		$head='';
		if (!empty($instance['tabbed'])){
			$tabbed=$instance['tabbed'];
			for ($i=0;$i<5;$i++){
				$type=$tabbed[$i];
				if (!$type) {continue;}
				if ($type=='text'){$type=$instance['texthead'][$i];}
				else {$type=$this->title[$type];}
				$head.= '<li><a class="tabbed-a" href="#'.$this->get_field_id('thetab').$i.'">'.$type.'</a></li>';
			}
		}
        if (!$head) {
            $tabbed=array('posts','comments','meta');
            for ($i=0;$i<3;$i++){
                $type=$this->title[$tabbed[$i]];
                $head.= '<li><a class="tabbed-a" href="#'.$this->get_field_id('thetab').$i.'">'.$type.'</a></li>';
            }
        }
        echo $head,'</ul>';
        for ($i=0;$i<count($tabbed);$i++){
            $type=$tabbed[$i];
            if (!$type) {continue;}
            echo'<div class="tabbedtab" id="'.$this->get_field_id('thetab').$i.'">';

            if ($type=='categories'){
                echo'<ul>';
                wp_list_categories('show_count=1&title_li=&use_desc_for_title=1');
                echo '</ul>';
            }elseif ($type=='posts'){
                echo '<ul>';
                wp_get_archives('type=postbypost&limit=10');
                echo '</ul>';
            }elseif ($type=='comments'){
                global $wpdb, $comments, $comment;
                if ( !$comments = wp_cache_get( 'recent_comments' ) ) {
                    $comments = $wpdb->get_results("SELECT $wpdb->comments.* FROM $wpdb->comments JOIN $wpdb->posts ON $wpdb->posts.ID = $wpdb->comments.comment_post_ID WHERE comment_approved = '1' AND post_status = 'publish' ORDER BY comment_date_gmt DESC LIMIT 15");
                    wp_cache_add( 'recent_comments', $comments);
                }
                add_filter( 'get_comment_excerpt', 'convert_smilies',20 );
                echo '<ul>';
                if ( $comments ) : foreach ( (array) $comments as $comment) :
                echo  '<li class="recentcomments"><strong>' . sprintf(_x('%1$s: %2$s', 'widgets'), get_comment_author_link($comment->comment_ID), '</strong><a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' .get_comment_excerpt().'</a>').'</li>';
                endforeach; endif;
                echo '</ul>';
            }elseif ($type=='archives'){
                echo '<ul>';
                wp_get_archives('type=monthly&show_post_count=1');
                echo '</ul>';
            }elseif ($type=='meta'){
                echo '<ul>';
                wp_register();?>
                <li><?php wp_loginout(); ?></li>
                <li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php echo esc_attr(__('Syndicate this site using RSS 2.0')); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
                <li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php echo esc_attr(__('The latest comments to all posts in RSS')); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
                <li><a href="http://wordpress.org/" title="<?php echo esc_attr(__('Powered by WordPress, state-of-the-art semantic personal publishing platform.')); ?>">WordPress.org</a></li>
                <?php wp_meta();
                echo '</ul>';
            }elseif ($type=='calendar'){
                echo '<div id="calendar_wrap">';
                get_calendar();
                echo '</div>';
            }elseif ($type=='blogroll'){
                echo'<ul>';
                wp_list_bookmarks('title_li=&categorize=0');
                echo'</ul>';
            }elseif ($type=='tags'){
                echo '<div>';
                wp_tag_cloud();
                echo "</div>";
             }elseif ($type=='pages'){
                echo'<ul>';
                wp_list_pages('title_li=');
                echo'</ul>';
            }elseif ($type=='text'){
                echo '<div>';
                echo $instance['textcontent'][$i];
                echo '</div>';
            }
            echo'</div>';
        }
        echo'</div>'.$after_widget;
    }

    function form($instance){
		$tabbed=$texthead=$textcontent=0;
        extract($instance);
        ?>
<script type="text/javascript">/* <![CDATA[*/
jQuery(function () {
        jQuery('#<?php echo $this->get_field_id('t')?>0,#<?php echo $this->get_field_id('t')?>1,#<?php echo $this->get_field_id('t')?>2,#<?php echo $this->get_field_id('t')?>3,#<?php echo $this->get_field_id('t')?>4').change(function(){
            if (this.value=='text'){jQuery(this).next().show();}
            else  {jQuery(this).next().hide();}
        });

        jQuery('#<?php echo $this->get_field_id('t')?>0,#<?php echo $this->get_field_id('t')?>1,#<?php echo $this->get_field_id('t')?>2,#<?php echo $this->get_field_id('t')?>3,#<?php echo $this->get_field_id('t')?>4').change();
   
});
/*]]>*/</script>
        <div>
	    <label for="<?php echo $this->get_field_id('tabbed') ?>"><?php _e('Items to show in the tabbed sidebar:', 'itx') ?></label><br />
	    <?php for($i=0;$i<5;$i++){
	    echo '
	    <select style="width: 220px" id="'.$this->get_field_id('t').$i.'"
		name="'.$this->get_field_name('tabbed')."[$i]".'">'.$this->tab_opts($tabbed[$i]).'</select>
		<div>
		<label for="'.$this->get_field_id('texthead').'">'.__('Title','itx').'</label>: <br />
		<input type="text" name="'.$this->get_field_name('texthead')."[$i]".'" value="'.$texthead[$i].'" /><br />
		<label for="'.$this->get_field_id('textcontent').'">'.__('Content','itx').'</label>:<br />
		<textarea name="'.$this->get_field_name('textcontent')."[$i]".'" rows="5" cols="28">'.$textcontent[$i].'</textarea>
		</div>
	    ';
	    }?>
	    <small>You may oveflow the head section of the tab if you display all of them. Choose wisely</small>
        </div>
 <?php
    }

    function tab_opts($selected) {
		$ret='';
        foreach ( $this->option as $id => $val ) {
            $ret.= '<option value="' . $id . '" ';
            if ($selected == $id) $ret.= 'selected="selected"';
            $ret.= '>'.$val.'</option>';
        }
        return $ret;
    }
}
/****/

 // Register Widgets
register_widget('itx_tabbed_sidebar');
?>