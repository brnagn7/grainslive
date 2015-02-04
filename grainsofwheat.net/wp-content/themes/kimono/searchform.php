<?php
/**
 * The template for displaying search forms in kimono
 *
 * @package kimono
 */
?>

	<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="screen-reader-text"><?php _ex( 'Search', 'assistive text', 'kimono' ); ?></label>
		<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="Search" />
		<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/ico_search.png" class="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'kimono' ); ?>" />
	</form>
