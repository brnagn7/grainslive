<div id="footwrap">
    <div id="footwrap2">
		<div class="wrap">
		<?php itx_sidebar('name=footer')?>
		<div class="clear"></div>
		</div>
	</div>
	<div id="footerfoot">
	<div class="wrap">
		<div id="footerleft">
		<a href="<?php bloginfo('url');?>"><?php bloginfo('name');?></a>
		<?php if (function_exists('is_multisite') && is_multisite()):global $current_site; ?>
		at <a href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_site->site_name ?></a>.
		<?php endif;?>
		</div><div id="footerright">
<?php wp_footer(); ?>
</body>
</html>