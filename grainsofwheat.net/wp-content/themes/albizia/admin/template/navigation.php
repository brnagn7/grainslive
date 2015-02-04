<?php
/**
 * Navigation menu admin tab
 *
 * @package itx_themes
 * @subpackage albizia
 * @version 2.0.1
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
extract(itx_get_option('menu'));?>
<div id="itx-navigation">
<h3>Menu Settings</h3>

<?php if ( function_exists('wp_nav_menu')){
    if($wp_menu) $checked='checked=\"checked\"';?>
	<hr />
	<p>Your WordPress install has a <b>navigation menu</b> feature. You can either use the feature or use <?php echo THEME_NICENAME;?> navigation menu feature.</p>
	<table class="form-table"><tr><th>Menu handler</th><td>
		<?php
		$toshow=array(0=>THEME_NICENAME.' Menu',1=>'WordPress Nav Menu');
		itx_form_radios($toshow, 'menu[wp_menu]', $wp_menu,false);
		?>
	</td></tr></table>
	<p>If you choose WordPress Nav Menu, please set them <a href="nav-menus.php">here</a>.
    Please note that there are 2 navigation position: top and primary. If you do nothing with the Wordpress Nav Menus,
    the menus automatically <strong>fallback</strong> to <?php echo THEME_NICENAME;?> Menu.
<?php }?>
<hr />

<h4>Top Navigation</h4>
<table class="form-table">
    <tr>
		<th>Home link</th>
		<td>
			<input type="text" name="<?php echo get_stylesheet();?>_menu[top_home]" value="<?php echo $top_home; ?>" /><br />
        to change the name of the home link in navigation menu. Set it empty if you don't wan't Home Link to appear in your top navigation.
		</td>
	</tr>
	<tr>
		<th>Top Menu Alignment</th>
		<td>
		<?php
		$toshow=array('left'=>"Left",'right'=>'Right');
		itx_form_radios($toshow, 'menu[top_align]', $top_align,false);
		?>
		<small>Please be careful that right aligned top navigation sometimes hide the submenu in the right of visible area.
		But you can compensate it using the margin option below.
		The right aligned top menu is best for Menu Depth = 1 (No Submenu) or Menu Depth= 2 (One Level Submenu).
		</small>
		</td>
	</tr>
	<tr>
		<th>Margin right and left</th>
        <td>
			<input type="text" name="<?php echo get_stylesheet();?>_menu[top_margin]" value="<?php echo $top_margin; ?>" class="small-text" /> px<br />
            <small>Set the margin so the top menu displayed nicely. Very useful to prevent the submenu to overflow the right edge of the screen.</small>
		</td>
	</tr>
	<tr>
		<th>Background Color</th>
        <td>
			<input type="text" name="<?php echo get_stylesheet();?>_menu[top_bg_color]" value="<?php echo $top_bg_color; ?>" /><br />
            <small>Tip: You can use something like #fff, #652789, black, green, etc.</small>
		</td>
	</tr>
	<tr>
		<th>What to show in Top Menu</th>
		<td>
			<?php
			$toshow=array(0=>"Don't show menu",'cat'=>'Categories','page'=>'Pages','cp'=>'Categories and Pages','pc'=>'Pages and Categories');
			itx_form_radios($toshow, 'menu[top_show]', $top_show,false);
			?>
		</td>
	</tr>
    <tr>
		<th>Menu Depth </th>
		<td>
			<input type="text" name="<?php echo get_stylesheet();?>_menu[top_depth]" value="<?php echo $top_depth; ?>" class="small-text" /><br />
			0 means unlimited
		</td>
	</tr>
</table>
<?php if ( function_exists('wp_nav_menu')){ echo '<small>Note: Options "Home link" and "What to show" designated for '.THEME_NICENAME.' Menu, not <a href="nav-menus.php">WordPress Nav Menu</a></small>.';}?>
<hr />
<h4>Primary Navigation</h4>
<table class="form-table">
    <tr>
		<th>Home link</th>
		<td>
			<input type="text" name="<?php echo get_stylesheet();?>_menu[home]" value="<?php echo $home; ?>" /><br />
        to change the name of the home link in navigation menu. Set it empty if you don't wan't Home Link to appear in your menu.
		</td>
	</tr>
	<tr>
		<th>Menu Alignment</th>
		<td>
		<?php
		$toshow=array('left'=>"Left",'center'=>"Center",'right'=>'Right');
		itx_form_radios($toshow, 'menu[align]', $align,false);
		?>
		</td>
	</tr>
    <tr>
		<th>What to show in Primary Menu</th>
		<td>
			<?php
			$toshow=array(0=>"Don't show menu",'cat'=>'Categories','page'=>'Pages','cp'=>'Categories and Pages','pc'=>'Pages and Categories');
			itx_form_radios($toshow, 'menu[show]', $show,false);
			?>
		</td>
	</tr>
    <tr>
		<th>Menu Depth</th>
		<td>
			<input type="text" name="<?php echo get_stylesheet();?>_menu[depth]" value="<?php echo $depth; ?>" class="small-text" /><br />
        0 means unlimited
		</td>
	</tr>
</table>
<?php if ( function_exists('wp_nav_menu')){ echo '<small>Note: Options "Home link" and "What to show"  designated for '.THEME_NICENAME.' Menu, not <a href="nav-menus.php">WordPress Nav Menu</a></small>';}?>
<hr />
<?php
$itx_categories = get_categories('hide_empty=0');
$itx_pages = get_pages('hide_empty=0');
?>

<h4>Categories to show in navigation bar.</h4>
<?php if ( function_exists('wp_nav_menu')){ echo '<p>Note: These options is designated for '.THEME_NICENAME.' Menu, not <a href="nav-menus.php">WordPress Nav Menu</a></p>';}?>

<div class="option">
    <div class="clear"><input type="checkbox" class="checkall" > <strong>Check All</strong></div>
    <ul class="alignleft">
        <?php
        foreach ($itx_categories as $v) {
             if ($v->cat_name !='') { $cats[]=$v;}
        }

        $num=count($cats);
        if($num>20){
            $breker=4;
        }elseif ($num>9){
            $breker=2;
        }else $breker=1;


        $i=-1;
        foreach ($cats as $itx_cat) {
            if ($i%ceil($num/$breker)==ceil($num/$breker)-1) echo '</ul><ul class="alignleft">';
            echo '<li><input type="checkbox" name="'.get_stylesheet().'_menu[cat_inc][]" value="'.$itx_cat->cat_ID.'" ';
            if(@in_array($itx_cat->cat_ID, $cat_inc)) echo "checked=\"checked\"";
            echo ' /> '.$itx_cat->cat_name.'</li>';
            $i++;
        }
        ?>
        </ul>
    <div class="clear"><input type="checkbox" class="checkall" > <strong>Check All</strong></div>
</div>
<h4>Sort Categories By </h4>
    <div>
        <?php
        $itx_cat_sortby = array(
            'name'=>'Name(Default)',
            'ID'=>'ID',
            'slug'=>'Slug',
            'count'=>'Count',
            'term_group'=>'Term Group');
        $itx_cat_order = array('ASC'=>'Ascending(Default)','DESC'=>'Descending');
        ?>
        <select name="<?php echo get_stylesheet();?>_menu[cat_sortby]">
            <?php
            foreach ($itx_cat_sortby as $key=>$val) {
                if(get_option ('catsortby')==$key){
                       $select= 'selected="selected"'; }
                else{$select = "";};
                echo '<option value="'.$key.'" '.$select.'> '.$val.' </option>';
            }?>
        </select>
        <select name="<?php echo get_stylesheet();?>_menu[cat_order]">
            <?php
            foreach ($itx_cat_order as $key=>$val){
                if (get_option ('catorder') == $key)
                { $select= 'selected="selected"'; }
                else {$select="";};
                echo '<option value="'.$key.'" '.$select.'> '.$val.' </option>';
            }?>
        </select>
</div>
    <hr />
<h4>Pages to show in header section </h4>
<?php if ( function_exists('wp_nav_menu')){ echo '<p>Note: These options is designated for '.THEME_NICENAME.' Menu, not <a href="nav-menus.php">WordPress Nav Menu</a></p>';}?>
    <div class="option">
        <div class="clear"><input type="checkbox" class="checkall" > <strong>Check All</strong></div>
    <ul class="alignleft">
        <?php
       foreach ($itx_pages as $v) {
             if ($v->post_title !='') { $pages[]=$v;}
        }

        $num=count($pages);
        if($num>20){
            $breker=4;
        }elseif ($num>9){
            $breker=2;
        }else $breker=1;


        $i=-1;
        foreach ($pages as $itx_page) {
            if ($i%ceil($num/$breker)==ceil($num/$breker)-1) echo '</ul><ul class="alignleft">';
            echo '<li><input type="checkbox" name="'.get_stylesheet().'_menu[page_inc][]" value="'.$itx_page->ID.'" ';
            if(@in_array($itx_page->ID, $page_inc)) echo "checked=\"checked\"";
            echo ' /> '.$itx_page->post_title.'</li>';
            $i++;
        }

        ?>
    </ul>
        <div class="clear"><input type="checkbox" class="checkall" > <strong>Check All</strong></div>
    </div>

<h4>Sort Pages By </h4>
    <div>
        <?php
        $itx_page_sortby = array(
            'post_title'=>'Name(Default)',
            'menu_order'=>"Page Order set in 'Pages' administrative panel",
            'post_date'=>'Creation Time',
            'post_modified'=>'Last Modified',
            'ID'=>'ID',
            'post_author'=>"author's numeric ID",
            'post_name'=>'Slug',);

        $itx_page_order = array('ASC'=>'Ascending(Default)','DESC'=>'Descending');
        ?>
        <select name="<?php echo get_stylesheet();?>_menu[page_sortby]">
            <?php
            foreach ($itx_page_sortby as $key=>$val) {
                if(get_option ('pagesortby')==$key){
                       $select= 'selected="selected"'; }
                else{$select = "";};
                echo '<option value="'.$key.'" '.$select.'> '.$val.' </option>';
            }?>
        </select>
        <select name="<?php echo get_stylesheet();?>_menu[page_order]">
            <?php
            foreach ($itx_cat_order as $key=>$val){
                if (get_option ('pageorder') == $key)
                { $select= 'selected="selected"'; }
                else {$select="";};
                echo '<option value="'.$key.'" '.$select.'> '.$val.' </option>';
            }?>
        </select>
    </div>
<div class="clear"></div>
<?php do_action('itx_admin_menu');?>
<button type="submit" name="<?php echo get_stylesheet();?>_reset" class="button-secondary"  value="menu" onclick="if (!confirm('Do you want to reset Navigation Menu Options to Default?')) return false;">Reset to default Navigation Menu Options</button>
</div>