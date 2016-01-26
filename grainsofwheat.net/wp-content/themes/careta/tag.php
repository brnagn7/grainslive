	<?php
	get_header();
	if(have_posts()) :
	?>
		<div id="post">
			<div class="post-list-content">
				<h1><?php _e('Tags','default') ?> : <?php echo single_tag_title('', false); ?></h1>
			</div>
		</div>
	<?php
		get_template_part('content', 'postlist');
	else :
		get_template_part('content', 'none');
	endif;
	get_footer();
?>
