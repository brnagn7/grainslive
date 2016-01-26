<?php get_header();extract(itx_get_option('front'));?>
<div id="main" class="wrap">
<div id="mainwrap" class="wrap">
<div id="content">
<div id="contentpad">
<div id="contentwrap">
<?php
$column=itx_get_option('front','column');
if (!is_paged()){
    itx_sidebar('name=innertop');
    if ($archive_type=='fe'||$archive_type=='fl'){
    if (have_posts()){itx_archive_title();the_post();itx_content('featured');}
    if ($wp_query->post_count<2) $nosearch=1;
    }
}

if ($archive_type=='fe'||$archive_type=='fl'){
	if(!get_option('sticky_posts')){
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$offset='&offset='.(($paged-1)*get_query_var('posts_per_page')+1);
	} else $offset='&caller_get_posts=1';
	query_posts($query_string.$offset);
}

if (have_posts()) {
	if (!($archive_type=='fe'||$archive_type=='fl')||is_paged()){itx_archive_title();}
    if ($archive_type=='fl') echo '<div class="linepostwrap">';
	$i=0;
    while (have_posts()) {
		the_post();
		if ($archive_type=='traditional') itx_single_content('singlepost');
		elseif ($archive_type=='fl') itx_line_content('linepost');
		else {
			$i++;
			$postwrap=ceil($i/$column);
			itx_content('posts postwrap-'.$postwrap);
		}
    }
    if ($archive_type=='fl') echo '</div>';
} elseif (empty($nosearch)) itx_notfound();

?>
<div class="clear"></div>
<?php if (!is_paged()){itx_sidebar('name=innerbottom');}?>
</div>
<div class="clear"></div>
<div id="navi">
    <?php wp_pagenavi();?>
</div>
</div>
</div> <!--/content-->
<?php itx_sidebar('name=sidebar&pos=left');itx_sidebar('name=sidebar&pos=right');?>
</div>
</div> <!--/main-->
<?php get_footer(); ?>