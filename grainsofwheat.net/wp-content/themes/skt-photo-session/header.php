<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package SKT Photo Session
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php 
$slAr = array();
for ($i=1;$i<6;$i++) {
	if ( of_get_option('slide'.$i, true) != "" ) {
		$imgUrl = of_get_option('slide'.$i, true);
		if ( strlen($imgUrl) > 3 ) $slAr[] = of_get_option('slide'.$i, true);
	}
}
?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
$front_page = get_option('page_on_front');
$post_page = get_option('page_for_posts');
?>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
<div class="top-bar"></div><!-- top-bar -->
	
		<?php if( count($slAr) > 0 ){ ?>
            <div class="slider-parent">	
                <div class="slider-wrapper theme-default container <?php if( is_front_page() || is_home()  ){ echo 'home_front_wrap_main'; } ?>"> 
                
                    <!--Thumbnail Navigation-->
                    <div id="prevthumb"></div>
                    <div id="nextthumb"></div>
                    <div id="thumb-tray" class="load-item">
                        <div id="thumb-back"></div>
                        <div id="thumb-forward"></div>
                    </div>
                    <div id="progress-back" class="load-item">
                        <div id="progress-bar"></div>
                    </div><!--Time Bar-->
					<div id="slidecaption"></div><!--Slide captions displayed here-->
                    <div id="controls-wrapper" class="load-item">
                        <div id="controls">
                            <a id="play-button"><img id="pauseplay" src="<?php echo get_template_directory_uri();?>/images/img/pause.png"/></a>
                            <!--Arrow Navigation-->
                            <a id="prevslide" class="load-item"></a>
                            <a id="nextslide" class="load-item"></a>
                            <div id="slidecounter">
                                <span class="slidenumber"></span> / <span class="totalslides"></span>
                            </div><!--Slide counter-->
                        </div>
                    </div><!--Control Bar-->

                </div><!--.container-->	
            </div><!--.slider-parent-->
        <?php } //if( count($slAr) > 0 ){ ?>


    <div id="wrapper">
       
            <div class="header">
            	
                <div class="logo">
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    	<?php if( true == of_get_option('logo') ) { ?>
	                    	<img src="<?php echo esc_url( of_get_option('logo', true) ); ?>" />
                        <?php } else { ?>
							<?php bloginfo( 'name' ); ?>
                        <?php } ?>
                    </a></h1>
                    <?php if( of_get_option('logo', true) != '') { ?>
                    <h2 class="site-description" style="display:none;"><?php bloginfo( 'description' ); ?></h2>
                    <?php } else { ?>
                    	<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                    <?php } ?>
                </div>
              
                <div id="site-nav">
                    <h1 class="menu-toggle"><?php _e( 'Menu', 'skt-photo-session' ); ?></h1>
                    <div class="screen-reader-text skip-link"><a href="#content"><?php _e( 'Skip to content', 'skt-photo-session' ); ?></a></div>
                    <?php wp_nav_menu( array('theme_location' => 'primary', 'container' => '', 'menu_class' => '') ); ?>
                </div><!-- site-nav --><div class="clear"></div>
            </div><!-- header -->
       
          