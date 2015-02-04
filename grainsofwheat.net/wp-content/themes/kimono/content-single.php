<?php
/**
 * @package kimono
 */
?>

<article id="post-<?php the_ID(); ?>" class="post type-post status-publish format-standard hentry2 category-news category-1 tag-pohto">
	<header class="entry-header">
		<h1 class="entry-title2"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php kimono_posted_on(); ?>
		</div><!-- .entry-meta -->
        <div class="single-tags">
        <?php
            $posttags = get_the_tags();
			if ($posttags) {
				foreach($posttags as $tag) {
					echo '<a href="';
					echo home_url();
					echo '/?tag=' . $tag->slug . '" class="taglink">' . $tag->name . '</a>';}}?>
        </div><!-- .single-tags -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'kimono' ),
				'after'  => '</div>',
			) );
		?>
        
        
        
	</div><!-- .entry-content -->
<!--
	<footer class="entry-meta">
	<p class="categories-link">categories: <?php echo get_the_category_list( ' ,' ); ?></p>
	</footer>-->
	<!-- .entry-meta -->
</article><!-- #post-## -->

