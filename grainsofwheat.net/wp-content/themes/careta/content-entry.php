<?php
	$style = get_theme_mod('careta_category_style','variable');		
	$classes = array();
	$displayColor = "";
	$displayExcerpt = (bool) get_theme_mod('careta_display_excerpts', true);
	$displayMoreLink = (bool) get_theme_mod('careta_display_more', true);
	$highlightColor = get_theme_mod('careta_highlight_color', '#10234F');
	$textHoverColor = get_theme_mod('careta_text_hover_color', '#ffffff');
    $displayTags = get_theme_mod('careta_display_category_tags', true);
    $displayAuthor = get_theme_mod('careta_display_category_author', true);
    $excerptLength = get_theme_mod('careta_category_excerpt_size', 'small');
	$custom = get_post_custom();
	if(!$displayExcerpt) $classes[] = 'no-excerpt';
	if(!$displayMoreLink) $classes[] = 'no-more';
    
    switch($excerptLength)
    {
        case 'small':
            $excerptLengthReal = 25;
            break;
        case 'medium':
            $excerptLengthReal = 50;
            break;
        case 'large':
            $excerptLengthReal = 100;
            break;
        default:
            $excerptLengthReal = 30;
            break;
    }
    
	
	$custombackground = null;
	$customtext = null;
	if (isset($custom) && careta_index_exists($custom,'careta-box-color'))
	{
		$array = $custom['careta-box-color'];
		$custombackground = $array[0];
	}
	
	if (isset($custom) && careta_index_exists($custom,'careta-box-text-color'))
	{
		$array = $custom['careta-box-text-color'];
		$customtext = $array[0];
	}
	
	if ($customtext != null || $custombackground != null)
	{
		echo "<style>";
			if ($custombackground != null)
			{
				echo "#post-" . the_ID();
				echo "{";
				echo "background: " . $custombackground . ";";
				echo "}";
			}
			
			if ($customtext != null) 
			{
				echo "#post-" . the_ID() . " h2, #post-" . the_ID() . " .post-excerpt";
				echo "{";
				echo "color: " . $customtext . " !important;";
				echo "}";
			}
		echo "</style>\n";
	}
	$classes[] = "post-entry";
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(implode(' ', $classes)); ?> <?php post_class(); ?> title="<?php echo htmlspecialchars(strip_tags(get_the_title())); ?>">
		<?php if(is_sticky()) : ?><span class="sticky-icon"></span><?php endif; ?>
		<a href="<?php the_permalink(); ?>" title="<?php echo htmlspecialchars(strip_tags(get_the_title())); ?>" class="no-more">
		<?php 
			if (has_post_thumbnail())
			{
				the_post_thumbnail('medium', array('class' => 'post-thumb', 'title' => htmlspecialchars(strip_tags(get_the_title())))); 
			}
			else
			{
				careta_draw_transparent();
			}
		?>
		<div class="post-container">
            <?php if ($displayAuthor) { ?>
    			<?php if (is_sticky()) { ?>
    				<span class="genericon-small genericon-pinned"></span>
    			<?php } else { ?>
    				<?php echo get_avatar(get_the_author_meta('ID'), 24 ); ?>
    			<?php } ?>
            <?php } ?>
			<?php careta_cut_text(get_the_title(),100); ?><BR>
			<p class="post-container-date"><?php the_time(get_option('date_format')); ?></p>
            
            <?php if ($displayTags) { ?>
                <p class="post-container-category"><?php the_category(', ') ?></p>
            <?php } ?>
			<?php if($displayExcerpt) : ?><span class="post-excerpt"><?php echo careta_cut_text(strip_tags(get_the_excerpt()), $excerptLengthReal); ?></span><?php endif; ?>
		</div>
		</a>
</div>
