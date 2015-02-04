<?php if ( post_password_required() ) : ?>
	<div id="comments">
		<p><?php _e( 'This post is password protected. Enter the password to view any comments.','default'); ?></p>
	</div>
<?php return; endif; ?>


<div id="comments">
<?php if(have_comments()) : ?>
	<?php
		$comments = get_comments(array('order' => 'DESC','post_id' => get_the_ID(),'status' => 'approve'));
		wp_list_comments(array('style' => 'div'),$comments);
	?>
	<p class="tr"><?php paginate_comments_links(); ?></p>
<?php

else : 
	if(!comments_open()) : ?>
		<p class="nocomments">
			<?php _e('Comments are closed.','default'); ?>
		</p>
	<?php endif; ?>
<?php endif; ?>

<?php if (comments_open()) : ?>
	<div id="respond">
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p id="login-req"><?php printf(__('You must be <a href="%s" title="Log in">logged in</a> to post a comment.','default'), get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink() ) ?></p>
	<?php else : ?>
		<?php comment_form(); ?>
	<?php endif;?>
	</div>
<?php endif; ?>
</div>
