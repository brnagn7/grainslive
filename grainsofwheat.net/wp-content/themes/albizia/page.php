<?php get_header(); ?>
<div id="main" class="wrap">
<div id="mainwrap">
<div id="content">
<div id="contentpad">
<div id="contentwrap">
<?php if (is_front_page()) itx_sidebar('name=innertop');?>
<?php if (have_posts()) : while (have_posts()){ the_post();itx_single_content('post singlepost');} ?>
<?php else:itx_notfound();endif; ?>
<div class="clear"></div>
<?php if (is_front_page()) itx_sidebar('name=innerbottom');?>
</div>
</div>
</div> <!--/content-->
<?php itx_sidebar('name=sidebar&pos=left');itx_sidebar('name=sidebar&pos=right');?>
<div class="clear"></div>
</div>
</div> <!--/main-->
<?php get_footer(); ?>