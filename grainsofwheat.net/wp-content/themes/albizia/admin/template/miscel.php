<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
extract(itx_get_option('misc'));?>

<div id="itx-misc">
<h3>Miscellaneous Setting</h3>

<table class="form-table"><tr>
	<th>Favicon </th>
	<td>
		<input type="text" name="<?php echo get_stylesheet();?>_misc[favicon]" value="<?php echo $favicon ?>" size="70" /><br />
		Type in the image's url. Don't forget the http://<br />
		Use only 16x16 pixel non-animated icon for cross-browser compatibility.
	</td>
</tr>
<tr>
	<th>Hover effect</th>
	<td>
		<input type="checkbox" name="<?php echo get_stylesheet();?>_misc[hover]" value="1" <?php if (!empty($hover)) echo 'checked="checked"';?> /> Disable hover effect on links.
	</td>
</tr></table>
<div class="clear"></div>
<?php do_action('itx_admin_misc');?>
<button type="submit" name="<?php echo get_stylesheet();?>_reset" class="button-secondary"  value="misc" onclick="if (!confirm('Do you want to Misc Options to Default?')) return false;">Reset to default Misc Options</button>
</div>