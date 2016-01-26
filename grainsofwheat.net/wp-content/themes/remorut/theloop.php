<?php 
	global $post, $query_string, $SMTheme;
	
	
	if (have_posts()) :
	
	
	
	
	if (!isset($_GET['ajaxpage'])) {?> <div class='articles'> <?php }
	
	
	
	
	while (have_posts()) : the_post(); ?>
		<div class='one-post'>

			<div class='post-body'>
			
<?php
		$post_thumbnail_id = get_post_thumbnail_id( $post_id ); 
				$img = wp_get_attachment_image_src( $post_thumbnail_id, array($SMTheme->get( 'layout', 'imgwidth' ), $SMTheme->get( 'layout', 'imgheight' )) );
				
				if ( $SMTheme->get( 'layout','imgpos' ) == 'alignleft' ) {
					$style=(has_post_thumbnail())?'width:'.($img['1']).'px; height:'.($img['2']).'px; float:left;':'';
					
				} elseif ( $SMTheme->get( 'layout','imgpos' ) == 'alignright' ) {
					$style=(has_post_thumbnail())?'width:'.($img['1']).'px; height:'.($img['2']).'px; float:right;':'';
					
				} elseif ( $SMTheme->get( 'layout','imgpos' ) == 'aligncenter' ) {
					$style=(has_post_thumbnail())?'width:'.($img['1']).'px; height:'.($img['2']).'px; float:none; margin:0 auto 10px;':'';
				} 
?>
	<div class="fimage <?php echo $SMTheme->get( 'layout','imgpos' ); ?><?php if(!has_post_thumbnail()) echo ' no_thumb' ?>" style="<?php echo $style ?>">		
			<?php // Post featured image
				if(has_post_thumbnail())  {
					if (!is_single()){ ?><a href="<?php the_permalink(); ?>" title="<?php printf( $SMTheme->_( 'permalink' ), the_title_attribute( 'echo=0' ) ); ?>"> <?php }
						the_post_thumbnail(
							array($SMTheme->get( 'layout', 'imgwidth' ), $SMTheme->get( 'layout', 'imgheight' )),
							array("class" => $SMTheme->get( 'layout','imgpos' ) . " featured_image")
						);
					if (!is_single()){ ?></a><?php }
				}

							?>
			
			<div class='post-date' <?php if(is_page() || is_single()) echo 'style="display:none;"' ?>>
				<span class='day'><?php echo get_the_date('j'); ?></span>
				<span class='month'><?php echo get_the_date('M'); ?></span>
			</div>
	</div>
				
			
			<div id="post-<?php the_ID(); ?>" <?php post_class("post-caption"); ?>>
			<?php  //Title
			if (!is_single()&&!is_page()) { ?>
				<h2><a href="<?php the_permalink(); ?>" title="<?php printf( $SMTheme->_( 'permalink' ), the_title_attribute( 'echo=0' ) ); ?>" class='post_ttl'><?php the_title(); ?></a></h2>
			<?php } else { ?>
				<h1><?php the_title(); ?></h1>
			<?php } 
			
			
			//Post meta (comments, date, categories)
			if (!is_page()) {?><p class='post-meta'>
				
				<?php the_category(', '); 
				
				if(comments_open( get_the_ID() ))  {
                    ?> <span class='post-comments'><?php comments_popup_link( $SMTheme->_( 'noresponses' ), $SMTheme->_( 'oneresponse' ), $SMTheme->_( 'multiresponse' ) ); ?></span>
				<?php } 
				edit_post_link( $SMTheme->_( 'edit' ), '     |     <span class="edit-link">', '</span>' );
				?>
			</p><?php } ?>
			
			</div>			
			
			
			
			
				<?php
				//Post content
				if (!is_single()&&!is_page()) { 
					smtheme_excerpt('echo=1');
				} else {
					the_content('');
				}
				wp_link_pages(); ?>
				<?php if (!is_single()&&!is_page()) { ?>
					<a href='<?php the_permalink(); ?>' class='readmore'><?php echo $SMTheme->_( 'readmore' ); ?></a>
				<?php } ?>
			</div>
		</div>
		
		
		
		
	<?php endwhile; ?>
	
	
	
	
	
	<?php if (!isset($_GET['ajaxpage'])) {?></div><?php } ?>
	
	
	
	
	
	
<?php endif; ?>