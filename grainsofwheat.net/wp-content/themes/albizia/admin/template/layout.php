<?php
/**
 * Navigation menu admin tab
 *
 * @package itx_themes
 * @subpackage #1#2
 * @version 2.0
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
extract(itx_get_option('layout'));?>

<div id="itx-layout">
<div>
<h3>Column Layout</h3>

<select name="<?php echo get_stylesheet();?>_layout[column]" id="column">
	<?php
	itx_form_options(array(1=>'One Column (No Sidebar)',21=>'Two Columns Right Sidebar',22=>'Three Columns Right Sidebars',23=>'Two Columns Left Sidebar',24=>'Three Column Left Sidebars',3=>'Three Columns Right and Left Sidebars'),$column);
	?>
</select>

<div class="col">
	<div id="1">
        <div class="alignleft">
        <h5>Front Page</h5>
        <table class="lay">
        <tr><td class="header"><p>Header</p></td></tr>
        <tr><td class="body"><div class="inner"><p>Inner top</p></div><div><p>Body</p></div><div  class="inner"><p>Inner bottom</div></td></tr>
        <tr><td class="footer"><p>Footer</p></td></tr>
        </table>
        </div>
        <div class="alignleft">
        <h5>Single Page</h5>
        <table class="lay">
        <tr><td class="header"><p>Header</p></td></tr>
        <tr><td  class="body"><div class="full"><p>Body</p></div></td></tr>
        <tr><td class="footer"><p>Footer</p></td></tr>
        </table>
        </div>
    </div>

    <div id="21">
        <div class="alignleft">
        <h5>Front Page</h5>
        <table class="lay">
        <tr><td class="header" colspan="2"><p>Header</p></td></tr>
        <tr><td  class="body"><div class="inner"><p>Inner top</p></div><div><p>Body</p></div><div  class="inner"><p>Inner bottom</div></td>
        <td class="one"><div class="sidebar"><p>Sidebar #1</p></div></td></tr>
        <tr><td class="footer" colspan="2"><p>Footer</p></td></tr>
        </table>
        </div>
        <div class="alignleft">
        <h5>Single Page</h5>
         <table class="lay">
        <tr><td class="header" colspan="2"><p>Header</p></td></tr>
        <tr><td  class="body"><div class="full"><p>Body</p></div></td>
        <td class="one">
             <div class="sidebar"><p>Sidebar #1</p></div>
         </td></tr>
        <tr><td class="footer" colspan="2"><p>Footer</p></td></tr>
        </table>
        </div>
    </div>

    <div id="22">
        <div class="alignleft">
        <h5>Front Page</h5>
        <table class="lay">
        <tr><td class="header" colspan="2"><p>Header</p></td></tr>
        <tr><td  class="body"><div class="inner"><p>Inner top</p></div><div><p>Body</p></div><div class="inner"><p>Inner bottom</div></td>
        <td class="two">
             <div class="sidebar"><p>Sidebar #1</p></div>
             <div class="sidebar"><p>Sidebar #2</p></div>
        </td></tr>
        <tr><td class="footer" colspan="2"><p>Footer</p></td></tr>
        </table>
        </div>
        <div class="alignleft">
        <h5>Single Page</h5>
        <table class="lay">
        <tr><td class="header" colspan="2"><p>Header</p></td></tr>
        <tr><td  class="body"><div class="full"><p>Body</p></div></td>
        <td class="two">
             <div class="sidebar"><p>Sidebar #1</p></div>
             <div class="sidebar"><p>Sidebar #2</p></div>
         </td></tr>
        <tr><td class="footer" colspan="2"><p>Footer</p></td></tr>
        </table>
        </div>
    </div>

    <div id="23">
        <div class="alignleft">
        <h5>Front Page</h5>
        <table class="lay">
        <tr><td class="header" colspan="2"><p>Header</p></td></tr>
        <tr><td class="one"><div class="sidebar"><p>Sidebar #1</p></div></td>
        <td class="body"><div class="inner"><p>Inner top</p></div><div><p>Body</p></div><div class="inner"><p>Inner bottom</div>
        </td></tr>
        <tr><td class="footer" colspan="2"><p>Footer</p></td></tr>
        </table>
        </div>
        <div class="alignleft">
        <h5>Single Page</h5>
        <table class="lay">
        <tr><td class="header" colspan="2"><p>Header</p></td></tr>
        <tr><td class="one"><div class="sidebar"><p>Sidebar #1</p></div></td>
        <td class="body"><div class="full"><p>Body</p></div></td></tr>
        <tr><td class="footer" colspan="2"><p>Footer</p></td></tr>
        </table>
        </div>
    </div>

    <div id="24">
        <div class="alignleft">
        <h5>Front Page</h5>
        <table class="lay">
        <tr><td class="header" colspan="2"><p>Header</p></td></tr>
        <tr><td class="two">
             <div class="sidebar"><p>Sidebar #1</p></div>
             <div class="sidebar"><p>Sidebar #2</p></div>
        </td><td class="body"><div class="inner"><p>Inner top</p></div><div><p>Body</p></div><div class="inner"><p>Inner bottom</div></td></tr>
        <tr><td class="footer" colspan="2"><p>Footer</p></td></tr>
        </table>
        </div>
        <div class="alignleft">
        <h5>Single Page</h5>
        <table class="lay">
        <tr><td class="header" colspan="2"><p>Header</p></td></tr>
        <tr><td class="two">
             <div class="sidebar"><p>Sidebar #1</p></div>
             <div class="sidebar"><p>Sidebar #2</p></div>
        </td><td  class="body"><div class="full"><p>Body</p></div></td></tr>
        <tr><td class="footer" colspan="2"><p>Footer</p></td></tr>
        </table>
        </div>
    </div>

    <div id="3">
        <div class="alignleft">
        <h5>Front Page</h5>
        <table class="lay">
        <tr><td class="header" colspan="3"><p>Header</p></td></tr>
        <tr><td class="one"><div class="sidebar"><p>Sidebar #1</p></div></td>
        <td class="body">
            <div class="inner"><p>Inner top</p></div>
            <div><p>Body</p></div>
            <div  class="inner"><p>Inner bottom</div>
         </td>
        <td class="one"><div class="sidebar"><p>Sidebar #2</p></div></td></tr>
        <tr><td class="footer" colspan="3"><p>Footer</p></td></tr>
        </table>
        </div>
        <div class="alignleft">
        <h5>Single Page</h5>
        <table class="lay">
        <tr><td class="header" colspan="3"><p>Header</p></td></tr>
        <tr><td class="one"><div class="sidebar"><p>Sidebar #1</p></div></td>
        <td class="body"><div class="full"><p>Body</p></div></td>
        <td class="one"><div class="sidebar"><p>Sidebar #2</p></div></td></tr>
        <tr><td class="footer" colspan="3"><p>Footer</p></td></tr>
        </table>
        </div>
    </div>
 </div>


<div class="clear"></div><hr/>
<h3>Dimensions</h3>

<table class="form-table"><tr>
<th>Wrapper Width<br /></th><td>
    <?php
	itx_form_radios(array('flex'=>'Flexible Width (100%)','fixed'=>'Fixed Width: <input type="text" name="'.get_stylesheet().'_layout[wrap]" value="'.$wrap.'" class="small-text" />px'),'layout[wrapping]',$wrapping,false)
	?>
	<div class="clear"></div>
	<small>Header width, body+sidebar width, and footer width will conform wrapper width. </small>
</td></tr>

<tr><th>Sidebars Width<br /><small>Body width equals to Wrapper width minus Sidebar width . </small>
    </th><td>
<?php
    if ($sidebarunit=='%') {
        if($sidebar1>100){$sidebar1=100;itx_update_option('layout',100,'sidebar1');}
        if($sidebar2>100){$sidebar2=100;itx_update_option('layout',100,'sidebar2');}
    }
?>
        Sidebar #1 <input type="text" name="<?php echo get_stylesheet();?>_layout[sidebar1]" value="<?php echo $sidebar1 ?>" class="small-text" /><br />
        Sidebar #2 <input type="text" name="<?php echo get_stylesheet();?>_layout[sidebar2]" value="<?php echo $sidebar2 ?>" class="small-text" />
    <br/>
    <?php
	itx_form_radios(array('px'=>'px','%'=>'%'),'layout[sidebarunit]',$sidebarunit,false);
	?>
    <div class="clear"></div>
    <small>Use percentage to make the width flexible, use px to make them fixed.</small>

 </td></tr></table>


<div class="clear"></div><hr/>
<h3>Style</h3>

<table class="form-table"><tr>
<td><p>There are several styles you can choose to use:</p><select name="<?php echo get_stylesheet();?>_layout[style]" >
	<?php
	itx_form_options(itx_setting('style'), $style);
	?>
	</select>
</td><td>
</td></tr></table>

<div class="clear"></div><hr/>
<h3>Widgets Layout</h3>
<p>Widgets in Inner Top, Inner Bottom and Footer are arranged using floats. This section set the width of widgets, so they form column automatically.</p>
<p>Tip: If you have widgets more than column you set, it's best to put the higher (longer) widget first, so they flows better.</p>
<p>These boxes ilustrate how they work.</p>

<table class="form-table">
<tr><th><h4>Arrange Inner Top by:</h4>
	<select name="<?php echo get_stylesheet();?>_layout[innertop]" id="itop">
	<?php
	itx_form_options(array(1=>'One Column Widgets',2=>'Two Columns Widgets',3=>'Three Columns Widgets',4=>'Four Columns Widgets',5=>'Five Columns Widgets',6=>'Six Columns Widgets'), $innertop);
	?>
	</select>
</th><td>
            <div class="inwidg" id="itopp">
                <div>1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1</div>
                <div>2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2</div>
                <div>3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3</div>
                <div>4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4</div>
                <div>5 5 5 5 5 5 5 5 5 5 5 5 5 5</div>
                <div>6 6 6 6 6 6 6 6 6 6 6</div>
            </div>
</td></tr>

<tr><th><h4>Arrange Inner Bottom by:</h4>
	<select name="<?php echo get_stylesheet();?>_layout[innerbottom]" id="ibottom">
	<?php
	itx_form_options(array(1=>'One Column Widgets',2=>'Two Columns Widgets',3=>'Three Columns Widgets',4=>'Four Columns Widgets',5=>'Five Columns Widgets',6=>'Six Columns Widgets'), $innerbottom);
	?>
	</select>
</th><td>
            <div class="inwidg" id="ibottomp">
                <div>1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 </div>
                <div>2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2</div>
                <div>3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3</div>
                <div>4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4</div>
                <div>5 5 5 5 5 5 5 5 5 5 5 5 5 5 5 5 5 5 5 5</div>
                <div>6 6 6 6 6 6 6 6 6 6 6</div>

            </div>
</td></tr>

<tr><th><h4>Arrange Footer by:</h4>
	<select name="<?php echo get_stylesheet();?>_layout[footer]" id="ifooter">
	<?php
	itx_form_options(array(1=>'One Column Widgets',2=>'Two Columns Widgets',3=>'Three Columns Widgets',4=>'Four Columns Widgets',5=>'Five Columns Widgets',6=>'Six Columns Widgets'), $footer);
	?>
	</select>
</th><td>
            <div class="inwidg" id="ifooterp">
                <div>1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 </div>
                <div>2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2 2</div>
                <div>3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3 3</div>
                <div>4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4 4</div>
                <div>5 5 5 5 5 5 5 5 5 5 5 5 5 5 5 5 5 5 5 5</div>
                <div>6 6 6 6 6 6 6 6 6 6 6</div>

            </div>
</td></tr></table>
</div>
<div class="clear"></div>
<?php do_action('itx_admin_layout');?>
<button type="submit" name="<?php echo get_stylesheet();?>_reset" class="button-secondary"  value="layout" onclick="if (!confirm('Do you want to reset Layout Options to Default?')) return false;">Reset to default Layout Options</button>
</div>