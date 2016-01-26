<?php
/**
 * The Template for displaying all single posts.
 *
 * @package kimono
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php kimono_content_nav( 'nav-below' ); ?>
<?php  
$next_post = get_next_post();  
if (!empty( $next_post )):  
echo '<a href="',get_permalink( $next_post->ID ),'">Prev</a>      ';  
endif;  
?> 
 
<?php  
$prev_poxt = get_previous_post();  
if (!empty( $prev_poxt  )):  
echo '<a href="',get_permalink( $prev_poxt->ID ),'" class="sinnext">Next</a>';  
endif;  
?>
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>