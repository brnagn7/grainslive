<?php
/**
 * @package kimono
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( has_post_thumbnail() ):  ?>
	<p class="thumb"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></p>
	<?php else: ?>
	<?php endif; ?>
<div <?php if ( has_post_thumbnail() ):  ?>class="article-wrap"<?php else: ?><?php endif; ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php
 if(mb_strlen($post->post_title)>30) { $title= mb_substr($post->post_title,0,30) ; echo $title. "..." ;
} else {echo $post->post_title;} ?></a></h1>
		
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php kimono_posted_on(); ?>
			<br>
            <?php
            $posttags = get_the_tags();
			if ($posttags) {
				foreach($posttags as $tag) {
					echo '<a href="';
					echo home_url();
					echo '/?tag=' . $tag->slug . '" class="taglink">' . $tag->name . '</a>';}}?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
    
    

		<?php the_excerpt( __( 'read more', 'kimono' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'kimono' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'kimono' ) );
				if ( $categories_list && kimono_categorized_blog() ) :
			?>
			<?php endif; // End if categories ?>

			
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
<!--		<span class="sep"> | </span>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'kimono' ), __( '1 Comment', 'kimono' ), __( '% Comments', 'kimono' ) ); ?></span>
-->
		<?php endif; ?>
        
	</footer><!-- .entry-meta -->
    </div><!-- .article-wrap -->
</article><!-- #post-## -->
