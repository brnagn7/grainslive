<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
extract(itx_get_option('links'));?>

<div id="itx-links">
<h3>RSS</h3>

<table class="form-table">
<tr>
	<th>RSS Feed</th>
	<td>
		<input type="text" name="<?php echo get_stylesheet();?>_links[rss]" value="<?php echo $rss; ?>" size="60" /><br />
		It will override the default WordPress RSS feed URL.
		Useful if you use third-party services like <a href="http://feedburner.google.com/">Feedburner</a>.
	</td>
</tr>
<tr>
	<th>Hide RSS Icon</th>
	<td>
		<input type="checkbox" name="<?php echo get_stylesheet();?>_links[hide_rss]" value="1" <?php if (!empty($hide_rss)) echo 'checked="checked"';?> />
	</td>
</tr>
<tr>
	<th>RSS Comment Feed</th>
	<td>
<input type="text" name="<?php echo get_stylesheet();?>_links[crss]" value="<?php echo $crss; ?>" size="60" /><br />
    It will override the default WordPress RSS comments URL.
    Useful if you use third-party services like <a href="http://feedburner.google.com/">Feedburner</a>.
</td></tr></table>

<h3>Social Network</h3>
<table class="form-table">
<tr><th>Your Twitter Name</th><td>
	http://twitter.com/<input type="text" name="<?php echo get_stylesheet();?>_links[twitter]" value="<?php echo $twitter ?>" />
</td></tr>
<tr><th>Your Facebook Username</th><td>
	http://www.facebook.com/<input type="text" name="<?php echo get_stylesheet();?>_links[facebook]" value="<?php echo $facebook; ?>" />
</td></tr>
</table>

<div class="clear"></div>
<?php do_action('itx_admin_links');?>
<button type="submit" name="<?php echo get_stylesheet();?>_reset" class="button-secondary"  value="links" onclick="if (!confirm('Do you want to reset Links Options to Default?')) return false;">Reset to default Links Options</button>
</div>