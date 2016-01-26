<?php
/*
Template Name: Page SideBar
*/
?>
<?php get_header(); ?>
	<div id="post">
		<div class="post-content">
		<?php while(have_posts()) : the_post(); ?>

		<?php
			$displayAuthor = (bool) get_theme_mod('careta_display_author', true);
			$displayDate = (bool) get_theme_mod('careta_display_date', true);
		?>
		
		<div id="post-details">
			<?php if($displayDate) : ?>
				<div class="post-date">
					<span class="genericon-small genericon-month"></span><?php the_date(); ?>
				</div>
			<?php endif; ?>
		</div>
					
		<h3><?php the_title(); ?></h3>
		<?php  the_content(); ?>
		
		<?php
			wp_link_pages(array
			(
				'before'           => '<div id="post-navi">' . __('Pages:','default'),
				'after'            => '</div>',
				'link_before'      => '<span class="page-numbers">',
				'link_after'       => '</span>'							
			));
		?>
		
		<?php if($displayAuthor) : ?>
			<div class="author-box">
			   <div class="author-pic"><?php echo get_avatar( get_the_author_meta('email') , '80' ); ?></div>
			   <div class="author-name"><strong><?php the_author_meta( "display_name" ); ?></strong></div>
			   <div class="author-bio"><?php the_author_meta( "user_description" ); ?></div>
			</div>
		<?php endif; ?>

		
		<?php comments_template(); ?>			
		</div>
	<?php endwhile; ?>
	
	</div>
	
	

<?php get_footer(); ?>