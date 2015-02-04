<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
extract(itx_get_option('css'));?>

<div id="itx-css">
<h3>Insert Custom CSS</h3>

<p>You may insert your custom CSS here. It's a better method of inserting
	your custom CSS than hard-coding the css files since it won't be missing/gone
	when you update this theme.</p>
<p>Any code written here will be rendered to the CSS file. Please ensure you write the correct CSS structure.
	No need to wrap it in &lt;style&gt; tags.</p>
<textarea name="<?php echo get_stylesheet();?>_css[insert]" cols="80" rows="20"> <?php echo $insert; ?> </textarea>
<div class="clear"></div>
<?php do_action('itx_admin_css');?>
</div>
