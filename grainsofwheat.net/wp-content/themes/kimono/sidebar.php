<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package kimono
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
	<div class="sidest1"><img src="<?php echo get_template_directory_uri(); ?>/images/bgimg_side.png" class="sidehead"></div>
	<header id="masthead" class="site-header" role="banner">
    
    <div class="site-branding-wrap">
    	<?php 
    	$header_image= get_header_image();
    	if( $header_image != null): ?>
    <a class="site-title-icon" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
    	<?php endif; ?>
    	<br>
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php 
		$titlecheck = get_option('blogname');
		if(mb_strlen($titlecheck)>40) { 
		$title= mb_substr($titlecheck,0,40) ; echo $title. "..." ;
		} 
		else {
		echo $titlecheck;
		} 
		?>
	</a></h1>
			<p class="site-description">
			<?php 
		$tagcheck = get_option('blogdescription');
		if(mb_strlen($tagcheck)>40) { 
		$title= mb_substr($tagcheck,0,40) ; echo $title. "..." ;
		} 
		else {
		echo $tagcheck;
		} 
		?>
				</p>
		</div>
	</div>
	</header>


		<?php do_action( 'kimono_before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', 'kimono' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>
            
            <aside id="tag" class="widget">
            <?php wp_tag_cloud('smallest=10largest=18&orderby=count&order=desc'); ?>
            </aside>

		<?php endif; // end sidebar widget area ?>

			
<br class="sidest2">
     	 
	</div><!-- #secondary -->