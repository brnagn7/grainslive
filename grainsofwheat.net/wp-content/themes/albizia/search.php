<?php get_header();extract(itx_get_option('front'));?>
<div id="main" class="wrap">
<div id="mainwrap">
<div id="content">
<div id="contentpad">
<div id="contentwrap">
<?php
if (have_posts()) {
    echo '<h2 class="pagetitle">';
	printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>');
	echo'</h2>';
	$i=0;
    while (have_posts()) {
		the_post();
		$i++;
		$postwrap=ceil($i/$column);
		itx_content('post posts postwrap-'.$postwrap);
	}
	echo '<div id="searchagain" class="post"><div class="postwrap"><h3 class="aligncenter">Search again:</h3>';
	get_search_form();
	echo '</div></div>';
}
else itx_notfound();
?>
<div class="clear"></div>
</div>
<div id="navi">
    <?php wp_pagenavi();?>
</div>
</div>
</div> <!--/content-->
<?php itx_sidebar('name=sidebar&pos=left');itx_sidebar('name=sidebar&pos=right');?>
</div>
</div> <!--/main-->
<?php get_footer(); ?>