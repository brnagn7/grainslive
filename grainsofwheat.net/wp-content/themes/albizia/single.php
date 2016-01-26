<?php get_header(); ?>
<div id="main" class="wrap">
<div id="mainwrap">
<div id="content">
<div id="contentpad">
<div id="contentwrap">
<?php if (have_posts()) : while (have_posts()): the_post();itx_single_content('singlepost');?>
    <div class="clear"></div>
    <div id="extrastuff">
        <?php if (!itx_get_option('single','hide_rss')) { echo itx_get_option('single','show_rss');?>
			<span id="rssleft"><?php post_comments_feed_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for this post (comments)')); ?></span>
        <?php } if (!itx_get_option('single','hide_trackback')) { ?>
			<span id="trackright"><?php if ( pings_open() ) : ?> &#183; <a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Uniform Resource Identifier">URI</abbr>'); ?></a><?php endif; ?></span>
        <?php } ?>
		<div class="clear"></div>
    </div>
<?php endwhile;?>

<?php else:itx_notfound();endif; ?>
</div>
<?php if (have_posts()) :?>
    <div class="nextprevious ui-state-default ui-corner-all">
        <div class="alignleft"><?php previous_post_link('<span>Previous Post</span><br />&laquo; %link') ?></div>
        <div class="alignright"><?php next_post_link('<span>Next Post</span><br />%link &raquo;') ?></div>
        <div class="clear"></div>
    </div>
<?php endif;?>
</div>
</div> <!--/content-->
<?php itx_sidebar('name=sidebar&pos=left');itx_sidebar('name=sidebar&pos=right');?>
<div class="clear"></div>
</div>
</div> <!--/main-->
<?php get_footer(); ?>