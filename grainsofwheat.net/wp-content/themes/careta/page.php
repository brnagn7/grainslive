<?php get_header(); ?>
	<div id="post">
		<div class="post-content">
		<?php while(have_posts()) : the_post(); ?>

		<?php
				$displayTags = (bool) get_theme_mod('careta_display_tags', true);
				$displayAuthor = (bool) get_theme_mod('careta_display_author', true);
				$displayCategory = (bool) get_theme_mod('careta_display_category', true);
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
			
		<?php if($displayAuthor) : ?>
			<div class="author-box">
			   <div class="author-pic"><?php echo get_avatar( get_the_author_meta('email') , '80' ); ?></div>
			   <div class="author-name"><strong><?php the_author_meta( "display_name" ); ?></strong></div>
			   <div class="author-bio"><?php the_author_meta( "user_description" ); ?></div>
			</div>
		<?php endif; ?>
			
		<?php
			wp_link_pages(array
			(
				'before'           => '<p class="tr post-pages">' . __('Pages:', 'default'),
				'after'            => '</p><BR>',
				'nextpagelink'     => __('Next page', 'default'),
				'previouspagelink' => __('Previous page', 'default'),
			));
		?>
		
		<?php if($displayTags && get_the_tags()) : ?>
			<p>
			<span class="genericon-small genericon-tag"></span>
			<?php
				echo _e('Tags','default') . "&nbsp;&nbsp;";
				$posttags = get_the_tags();
				if ($posttags) 
				{
					foreach($posttags as $tag) 
					{
						echo '<a href="' . get_tag_link($tag->term_id) . '" class="post-tags"  title="' . esc_attr( sprintf( __( "View all posts in %s" ,'default'), $tag->name ) ) . '">' . $tag->name . "</a>&nbsp;";
					}
				}
			?>	
			<p>			
		<?php endif; ?>
		
		<?php if($displayCategory && get_the_category()) : ?>
			<p>
			<span class="genericon-small genericon-category"></span>
			<?php
			echo _e('Categories','default') . "&nbsp;&nbsp;";
			$categories = get_the_category();
			$separator = ' ';
			$output = '';
			if($categories){
				foreach($categories as $category) {
					$output .= '<a href="' . get_category_link( $category->term_id ) . '" class="post-categories" title="' . esc_attr( sprintf( __( "View all posts in %s",'default'), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
				}
			echo trim($output, $separator);
			}
			?>	
			</p>				
		<?php endif; ?>

		
		<?php comments_template(); ?>			
		</div>
	<?php endwhile; ?>
	</div>
<?php get_footer(); ?>

