<?php get_header(); ?>


	<?php get_template_part( 'loop' ); ?>

	
	<div id="primary" class="content-area">
		
		<div class="indexst1"></div>
		<div class="indexst2"></div>
		<div id="content" class="site-content" role="main">
			
			
	<header class="entry-header">
		<h1 class="entry-title">404 Not Found</h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		
			<p>It looks like nothing was found at this location. Maybe try a search?</p>


			<?php get_search_form(); ?>

			</div>
        
        <div class="navigation">
        <div class="alignleft"><?php posts_nav_link('&#160;','&#160;','Previous') ?></div>
        <div class="alignright"><?php posts_nav_link('&#160;','Next','&#160;') ?></div>
        </div>
        <!-- .navigation -->
        

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>