<?php
/**
 * Background options admin tab
 *
 * @package itx_themes
 * @version 2.0
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
extract(itx_get_option('bg'));?>

<div id="itx-bg">
<h3>Custom Background</h3>

<div class="form-table">
<h4>1. Image to put in the background:</h4>

<input type="text" name="<?php echo get_stylesheet();?>_bg[image]" value="<?php echo $image;?>" size="80"/><br />
Type in the image's url. Don't forget the http://

<h4>2. Background attachment</h4>
if option 1B selected<br />
    <?php
    itx_form_radios(array('fixed'=>'Fixed','scroll'=>'Scroll (along with the page)'), 'bg[attachment]', $attachment);
    ?>

<h4>2. Repeat the image</h4>
    <?php
    itx_form_radios(array('no-repeat'=>'none','repeat-x'=>'Repeat Horizontally','repeat-y'=>'Repeat Vertically','repeat'=>'Repeat Horizontally and Vertically')
, 'bg[repeat]', $repeat);
    ?>

<h4>3. Horizontal alignment</h4>
    <?php
    itx_form_radios(array('left'=>'Left','center'=>'Center','right'=>'Right'), 'bg[h_align]', $h_align);
    ?>

<h4>4. Vertical alignment</h4>
    <?php
    itx_form_radios(array('top'=>'Top','center'=>'Center','bottom'=>'Bottom'), 'bg[v_align]', $v_align);
    ?>

<h4>Colors and Sizes</h4>
<?php
echo '<table><tr><td>
Background color</td><td><input type="text" name="'.get_stylesheet().'_bg[bgcolor]" value="'.$bgcolor.'" size="9" ><br /> set it empty to use dafault</td></tr><tr><td>
Resize font size</td><td><input type="text" name="'.get_stylesheet().'_bg[resize]" value="'.$resize.'" size="4" >% <br />(all font sizes will follow the resize) </td></tr></table>';
?>
</div><div id="thebody"></div>
<div class="clear"></div>
<?php do_action('itx_admin_bg');?>
<button type="submit" name="<?php echo get_stylesheet();?>_reset" class="button-secondary"  value="bg" onclick="if (!confirm('Do you want to reset Background Options to Default?')) return false;">Reset to default Background Options</button>
</div>