<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

if ( isset( $_REQUEST['updated'] ) && $_REQUEST['updated'] == 'true')
		echo '<div id="message" class="updated"><p>Options Updated</p></div>';
?>

<script type="text/javascript">/* <![CDATA[ */
jQuery(function () {
    jQuery('#itx-tabbed-options').tabs().addClass('ui-tabs-vertical') ;
	jQuery("#itx-tabbed-options>div").addClass('ui-corner-all');

	jQuery('#itx-layout #column').change(function(){
        jQuery(this).next().children().hide().siblings("#" + this.value).show();
    });

    var w=[,99,49,32,24,19,15.8];
    jQuery("#itop,#ibottom,#ifooter").change(function(){
        var id=jQuery(this).attr('id');
        jQuery("#itx-layout #"+id+"p").children().css('width',w[this.value]+'%');
    });

    jQuery('#itx-layout #column,#itop,#ibottom,#ifooter').change();

    jQuery('#itx-navigation .checkall').click(function () {
            jQuery(this).parents('.option').find(':checkbox').attr('checked', this.checked);
    });
});
/* ]]> */</script>

<div class="wrap" id="itx-theme-options">
	<h2>Theme Options for <?php echo THEME_NICENAME;?></h2>
<table><tr><td id="sidel">
<form method="post" action="options.php">
<?php settings_fields('itx-options'); ?>
<div id="itx-tabbed-options">
<ul>
    <li><a href="#itx-layout"><?php _e('Layout', 'itx') ?></a></li>
    <li><a href="#itx-front"><?php _e('Front Page', 'itx') ?></a></li>
    <li><a href="#itx-header"><?php _e('Header', 'itx') ?></a></li>
    <li><a href="#itx-bg"><?php _e('Background', 'itx') ?></a></li>
    <li><a href="#itx-navigation"><?php _e('Navigation Menu', 'itx') ?></a></li>
    <li><a href="#itx-links"><?php _e('Links', 'itx') ?></a></li>
	<li><a href="#itx-single"><?php _e('Single Post/Page', 'itx') ?></a></li>
    <li><a href="#itx-css"><?php _e('Custom CSS', 'itx') ?></a></li>
	<li><a href="#itx-misc"><?php _e('Misc', 'itx') ?></a></li>
	<?php do_action('itx_admin_options_head');?>
</ul>

<?php
include 'layout.php';
include 'front.php';
include 'header.php';
include 'bg.php';
include 'navigation.php';
include 'links.php';
include 'single.php';
include 'css.php';
include 'miscel.php';
do_action('itx_admin_options_item');
?>
</div>
<input type="submit" name="Submit" class="button-primary"  value="Update Options" />
<button type="submit" name="<?php echo get_stylesheet();?>_reset" class="button-secondary"  value="1" onclick="if (!confirm('Do you want to reset options to Default?')) return false;">Reset to default Options</button>
</form></td>
<td id="sider">
<?php do_action('itx_admin_options_sider');?>
<div class="postbox">
    <h3>Version</h3>
    <br />
    <p>You're running this site with <strong><?php echo THEME_NICENAME;?></strong> version: <strong><?php echo THEME_VERSION;?></strong></p>
    <br />
</div>

<div class="postbox">
    <h3>Recommended Plugins</h3>
    <br />
	<ol>
    <li>
		<a href="http://wordpress.org/extend/plugins/gregs-high-performance-seo/">Greg's High Performance SEO</a><br>
		The best SEO Plugin for SEO enthusiast. <?php echo THEME_NICENAME;?> supports GHP SEO Main Titles and Secondary Titles.
	</li>
	<li>
		<a href="http://wordpress.org/extend/plugins/regenerate-thumbnails/">Regenerate Thumbnails</a><br>
		I you recently change the thumbnail size, you definitely need this one.
	</li>
	</ol>
    <br />
</div>
	
<div class="postbox">
    <br />
    <p><?php echo THEME_NICENAME;?> Theme is bundled with <b>Tabbed Sidebar Widget</b>. You can set the widget <a href="widgets.php">here</a>. </p>
    <br />
</div>
<div class="postbox">
    <br />
    <p>If you confused how to use <?php echo THEME_NICENAME;?>, the default options is okay for you. But if you eagerly want to utilize everything in <?php echo THEME_NICENAME;?>, you can drop a simple question or very difficult one to <a href="http://forum.itx.web.id">our forum</a>. </p>
    <br />
</div>
</td></tr></table>
</div>