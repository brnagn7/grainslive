<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
extract(itx_get_option('front'));?>

<div id="itx-front">
<h3>Front page design</h3>
<p>Where multiple posts shown, which is index page, categories pages, archives page, etc which is not a single post or single page.</p>
<hr/>
<h4>Layout</h4>
<p>Please note that Featured item only shows in front page (page one). Other pages (page two or more) not showing featured item.</p>

<table class="form-table">
<tr><th>Display type in home page:</th><td>
	<?php
	itx_form_radios(array('traditional'=>'Traditional','excerpt'=>'Excerpts','fe'=>'Featured and Excerpts', 'fl'=>'Featured and Line'),'front[type]',$type);
	?>
</td></tr>

<tr><th>Display type in archive page ( archive, categories, author posts, etc ) :</th><td>
	<?php
	itx_form_radios(array('traditional'=>'Traditional','excerpt'=>'Excerpts','fe'=>'Featured and Excerpts', 'fl'=>'Featured and Line'),'front[archive_type]',$archive_type);
	?>
</td></tr>

<tr><th>Arrange Excerpt by:<br /><small>If display type B or C selected</small></th><td>
	<select name="<?php echo get_stylesheet();?>_front[column]" id="ifront">
		<?php
		itx_form_options(array(1=>'One Column',2=>'Two Columns',3=>'Three Columns',4=>'Four Columns',5=>'Five Columns',6=>'Six Columns',7=>'Seven Columns',8=>'Eight Columns'), $column);
		?>
	</select>
</td></tr>

<tr><th>Limit Featured text</th><td>
<input type="text" name="<?php echo get_stylesheet();?>_front[featuredlim]" value="<?php echo $featuredlim; ?>" class="small-text" /> words</td></tr>

<tr><th>Limit Excerpts text</th><td>
<input type="text" name="<?php echo get_stylesheet();?>_front[excerptlim]" value="<?php echo $excerptlim; ?>" class="small-text" /> words</td></tr>
</table>
<hr/>

<h4>Read More Text</h4>
<table class="form-table"><tr><th>Text to replace the default '[...]' string in excerpt mode if the full text is cropped.</th>
<td><input type="text" name="<?php echo get_stylesheet();?>_front[excerpt_more]" value="<?php echo $excerpt_more; ?>" /></td>
</tr></table>
<hr />

<h4>Front Page Meta</h4>
Meta info to show in each post in the frontpage 

<p><b>Non Traditional Display Type</b> (in excerpts and line posts).</p>

<?php
foreach (itx_setting('meta') as $k => $v ){
	if (!empty($v)){
		if (is_array($v)){
			echo "<table class='form-table'><tr><th>$v[0]</th><td>";
			itx_form_radios(array('None')+array_slice($v,1),"front[meta][$k]",$meta[$k],false);
			echo '</td></tr></table>';
		} else{
			$checked=(isset($meta[$k])&&$meta[$k]==$k)?'checked="checked"':'';
			echo '<table class="form-table"><tr><th>'.$v.'</th>
			<td><input type="checkbox" name="'.get_stylesheet().'_front[meta]['.$k.']" value="'.$k.'" '.$checked.' /></td></tr></table>';
		}
	}
}
?>
<p><b>Traditional Display Type</b></p>
<table class="form-table">
	<tr>
		<th>Show Comment Count (Header)</th>
		<td><input type="checkbox" name="<?php echo get_stylesheet();?>_front[post_meta][commentcount]" value="1" <?php if (!empty($post_meta['commentcount'])) echo 'checked="checked"';?> /></td>
	</tr>
	<tr>
		<th>Show Date (Header)</th>
		<td><input type="checkbox" name="<?php echo get_stylesheet();?>_front[post_meta][date]" value="1" <?php if (!empty($post_meta['date'])) echo 'checked="checked"';?> /></td>
	</tr>
	<tr>
		<th>Show Author (Header)</th>
		<td><?php itx_form_radios(array(0=>'Hide','author'=>'Author Name without Link','author_posts'=>'Author Name with link to thir posts','author_link'=>'Author Name with link to thir website'), 'front[post_meta][author]', $post_meta['author'],0);?></td>
	</tr>
	<tr>
		<th>Show Categories (Footer)</th>
		<td><input type="checkbox" name="<?php echo get_stylesheet();?>_front[post_meta][categories]" value="1" <?php if (!empty($post_meta['categories'])) echo 'checked="checked"';?> /></td>
	</tr>
	<tr>
		<th>Show Tags (Footer)</th>
		<td><input type="checkbox" name="<?php echo get_stylesheet();?>_front[post_meta][tags]" value="1" <?php if (!empty($post_meta['tags'])) echo 'checked="checked"';?> /></td>
	</tr>
	<tr>
		<th>Show Author Information (Footer)</th>
		<td><?php itx_form_radios(array(0=>'Hide','bio'=>'Biographical info','link'=>'Biographical info and link to their website'), 'front[post_meta][author_info]', $post_meta['author_info'],0);?></td>
	</tr>
</table>
<hr />
<h4>Posts Thumbnails/Featured Images</h4>
<p>Thumbnails/images  on index page, categories pages, archive pages, etc. Not including thumbnails on single post or single page. </p>
<p>In WordPress 2.9 and later, Post Thumbnail/Featured Images are cropped to fit these values.
	You can set the set post-thumbnail (wp 2.9) or featured image (wp 3.0) by clicking "Set Post Thumbnail"
	or "Set Featured Image" in lower right of your post editor page.</p>
<p>In WordPress prior to 2.9 you can set post-thumbnail using Custom field. The name is <strong>thumb</strong>.
	You can enter the attachment-ID of the image or the URL of the image. If attachment-ID is set in
	<strong>thumb</strong> custom field, the system will use the attachment image associated with the ID.
	The system will resize the images to fit these sizes set below using CSS only, so it's not recommended unless
	you have very old wordpress or the images come from external sources.
</p>
<p>More about Attachment in WordPress: <a href="http://codex.wordpress.org/Using_Image_and_File_Attachments">Attachments</a><br>
More about Custom Field in WordPress: <a href="http://codex.wordpress.org/Custom_Fields">Custom Fields</a></p>

<table  class="form-table"><tr><th>Featured/Bigger size</th><td>
	Width <input type="text" name="<?php echo get_stylesheet();?>_front[featuredx]" value="<?php echo $featuredx; ?>" class="small-text" maxlength="3" />
	Height <input type="text" name="<?php echo get_stylesheet();?>_front[featuredy]" value="<?php echo $featuredy; ?>" class="small-text" maxlength="3" /><br />
</td></tr>

<tr><th>Thumbnail size</th><td>
	Width <input type="text" name="<?php echo get_stylesheet();?>_front[thumbx]" value="<?php echo $thumbx; ?>" class="small-text" maxlength="3" />
	Height <input type="text" name="<?php echo get_stylesheet();?>_front[thumby]" value="<?php echo $thumby; ?>" class="small-text" maxlength="3" /> <br />
	Post thumbnails are croped to fit these values.

<tr><th>If no Post Thumbnail/Featured Image Set in a post </th><td>
	<?php
	itx_form_radios(array(0=>"Don't find any other thumbnail/image",'1'=>'Try to find a thumbnail/image in the post'), 'front[catch]', $catch);
	?>
</td></tr>

<tr><th>If no Thumbnail/Image Found in a post </th><td>
	<?php
    itx_form_radios(array(0=>"Don't display any box",1=>'Display a box with default pattern',2=>'Display custom image:<div class="radiopad">Featured size: <input type="text" name="'.get_stylesheet().'_front[fnotimg]" value="'.$fnotimg.'" class="regular-text"><br />Thumbnail size: <input type="text" name="'.get_stylesheet().'_front[notimg]" value="'.$notimg.'" class="regular-text"><br />Enter the url here. Don\'t forget the http://</div>'), 'front[not]', $not);
	?>
</td></tr></table>
<div class="clear"></div>
<?php do_action('itx_admin_front');?>
<button type="submit" name="<?php echo get_stylesheet();?>_reset" class="button-secondary"  value="front" onclick="if (!confirm('Do you want to reset Front Page Options to Default?')) return false;">Reset to default Front Page Options</button>
</div>