<?php 
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<?php
/*	You can start editing here. */

/*
 * Print comments
 */
?>
<div id="comments">
<?php if ( have_comments() ) : ?>
    <?php
    $pagin=paginate_comments_links('echo=')  ?>

    <?php if ( ! empty($comments_by_type['comment']) ) :
    $count = count($comments_by_type['comment']);
    ($count !== 1) ? $txt = "Comments" : $txt = "Comment"; ?>

    <div class="commentmeta ui-state-default ">
	<h3 id="commentstitle"><?php echo '<b>'.$count . '</b> ' . $txt; ?></h3>
        <?php if ( $pagin ): ?>
        <div class="wp-pagenavi">
            <?php echo $pagin ?>
        </div>
        <?php endif; ?>
    </div>
    <ul class="commentlist">
		<?php wp_list_comments('type=comment&avatar_size=60'); $nocomments=false;?>
    </ul>
    <?php else: $nocomments=true; endif; ?>
    
    <?php if ( ! empty($comments_by_type['pings']) ) :
    $countp = count($comments_by_type['pings']);
    ($countp !== 1) ? $txtp = "Trackbacks / Pingbacks" : $txtp = "Trackback or Pingback"; ?>
    <div class="commentmeta ui-state-default ">
        <h3><?php echo $countp . " " . $txtp; ?></h3>
        <?php if ( $pagin && $nocomments): ?>
        <div class="wp-pagenavi">
            <?php echo $pagin ?>
        </div>
        <?php endif; ?>
    </div>
    <ul class="trackback">
        <?php wp_list_comments('type=pings&callback=itx_ping'); ?>
    </ul>
    <?php endif; ?>

    <?php if ( $pagin ) : ?>
    <div class="commentmeta ui-state-default wp-pagenavi">
        <?php echo $pagin ?>
    </div>
    <?php endif; ?>

<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( !comments_open() && is_single()) : ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>
	<?php endif; 
endif;
?>

<div class="clear"></div>

<?php
/*
 * Print Comment Form
 */
if (itx_get_option('single','show_allowed_tags')){
	$args['comment_notes_after']  = '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>';
} else $args['comment_notes_after']='';

if (function_exists('comment_form')): comment_form($args);
else:?>
<?php if ( comments_open() ) :
		$commenter = wp_get_current_commenter();

		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$fields =  array(
			'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
			'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
						'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
			'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
						'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		);

		$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );
		$args = $args+array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
			'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => __( 'Leave a Reply' ),
			'title_reply_to'       => __( 'Leave a Reply to %s' ),
			'cancel_reply_link'    => __( 'Cancel reply' ),
			'label_submit'         => __( 'Post Comment' ),
		);

		?>
			<?php do_action( 'comment_form_before' ); ?>
			<div id="respond">
				<h3 id="reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
						<?php do_action( 'comment_form_top' ); ?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
							<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
						<?php echo $args['comment_notes_after']; ?>
						<p class="form-submit">
							<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
							<?php comment_id_fields(); ?>
						</p>
						<?php do_action( 'comment_form', $post_id ); ?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
<?php endif; ?>
</div>