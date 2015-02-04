<?php
	get_header();
	
	if(have_posts()) 
	{
	?>
		<div id="post">
			<div class="post-list-content">
				<h1><?php
					echo __('Archives', 'default') . ' : ';
					if ( is_day() ) :
						echo get_the_date();
					elseif ( is_month() ) :
						echo get_the_date(_x( 'F Y', 'monthly archives date format', 'default' ));
					elseif ( is_year() ) :
						echo get_the_date( _x( 'Y', 'yearly archives date format', 'default'));
					else :
						_e( 'Archives' ,'default' );
					endif;
				?></h1>
			</div>
		</div>
	<?php
		get_template_part('content', 'postlist');
	}
	else 
	{
		get_template_part('content', 'none');
	}
	
	get_footer();
?>
