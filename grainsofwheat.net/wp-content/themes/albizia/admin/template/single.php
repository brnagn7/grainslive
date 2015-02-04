<?php
/**
 * Single post/page options admin tab
 *
 * @package itx_themes
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
extract(itx_get_option('single'));?>

<div id="itx-single">
<h3>Post Meta</h3>
Meta info to show in each post.

<table class="form-table">
	<tr>
		<th>Show Comment Count (Header)</th>
		<td><input type="checkbox" name="<?php echo get_stylesheet();?>_single[post_meta][commentcount]" value="1" <?php if (!empty($post_meta['commentcount'])) echo 'checked="checked"';?> /></td>
	</tr>
	<tr>
		<th>Show Date (Header)</th>
		<td><input type="checkbox" name="<?php echo get_stylesheet();?>_single[post_meta][date]" value="1" <?php if (!empty($post_meta['date'])) echo 'checked="checked"';?> /></td>
	</tr>
	<tr>
		<th>Show Author (Header)</th>
		<td><?php itx_form_radios(array(0=>'Hide','author'=>'Author Name without Link','author_posts'=>'Author Name with link to thir posts','author_link'=>'Author Name with link to thir website'), 'single[post_meta][author]', $post_meta['author'],0);?></td>
	</tr>
	<tr>
		<th>Show Categories (Footer)</th>
		<td><input type="checkbox" name="<?php echo get_stylesheet();?>_single[post_meta][categories]" value="1" <?php if (!empty($post_meta['categories'])) echo 'checked="checked"';?> /></td>
	</tr>
	<tr>
		<th>Show Tags (Footer)</th>
		<td><input type="checkbox" name="<?php echo get_stylesheet();?>_single[post_meta][tags]" value="1" <?php if (!empty($post_meta['tags'])) echo 'checked="checked"';?> /></td>
	</tr>
	<tr>
		<th>Show Author Information (Footer)</th>
		<td><?php itx_form_radios(array(0=>'Hide','bio'=>'Biographical info','link'=>'Biographical info and link to their website'), 'single[post_meta][author_info]', $post_meta['author_info'],0);?></td>
	</tr>
</table>
<hr />
<h3>Page Meta</h3>
Meta info to show in each page.

<table class="form-table">
	<tr>
		<th>Show Comment Count (Header)</th>
		<td><input type="checkbox" name="<?php echo get_stylesheet();?>_single[page_meta][commentcount]" value="1" <?php if (!empty($page_meta['commentcount'])) echo 'checked="checked"';?> /></td>
	</tr>
	<tr>
		<th>Show Author (Header)</th>
		<td><?php itx_form_radios(array(0=>'Hide','author'=>'Author Name without Link','author_posts'=>'Author Name with link to thir posts','author_link'=>'Author Name with link to thir website'), 'single[page_meta][author]', $page_meta['author'],0);?></td>
	</tr>
	<tr>
	<th>Show Author Information (Footer)</th>
		<td><?php itx_form_radios(array(0=>'Hide','bio'=>'Biographical info','link'=>'Biographical info and link to their website'), 'single[page_meta][author_info]', $page_meta['author_info'],0);?></td>
	</tr>
</table>
<hr />
<h3>Comments</h3>
<table class="form-table">
	<tr>
		<th>Show allowed tags </th>
		<td><input type="checkbox" name="<?php echo get_stylesheet();?>_single[show_allowed_tags]" value="1" <?php if (!empty($show_allowed_tags)) echo 'checked="checked"';?> /></td>
	</tr>
</table>
<hr />
<h3>Extra Stuff</h3>
<table class="form-table">
	<tr>
		<th>Hide post comments RSS Link </th>
		<td><input type="checkbox" name="<?php echo get_stylesheet();?>_single[hide_rss]" value="1" <?php if (!empty($hide_rss)) echo 'checked="checked"';?> /></td>
	</tr>
	<tr>
		<th>Hide post TrackBack Link </th>
		<td><input type="checkbox" name="<?php echo get_stylesheet();?>_single[hide_trackback]" value="1" <?php if (!empty($hide_trackback)) echo 'checked="checked"';?> /></td>
	</tr>
</table>
<div class="clear"></div>
<?php do_action('itx_admin_single');?>
<button type="submit" name="<?php echo get_stylesheet();?>_reset" class="button-secondary"  value="single" onclick="if (!confirm('Do you want to reset Single Post/Page Options to Default?')) return false;">Reset to default Single Post/Page Options</button>
</div>