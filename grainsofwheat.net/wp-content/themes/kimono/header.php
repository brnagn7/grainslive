<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package kimono
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=1500px,minimum-scale=0.1,maximum-scale=1" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?> 
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<div class="headst1">
	<!--left-->
	<div id="left">
		<div class="backhitoe9">&nbsp;</div>
		<div class="backhitoe1">&nbsp;</div>
		<div class="backhitoe2">&nbsp;</div>
		<div class="backhitoe3">&nbsp;</div>
	</div>
	<!--left-->

<div id="page" class="hfeed site">
	<?php do_action( 'kimono_before' ); ?>
<!-- #masthead -->

	<div id="main" class="site-main">