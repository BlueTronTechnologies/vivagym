<a name="respond"></a>
<div class="comment_wrapper">
	<div class="qt_l">
		<?php include TEMPLATEPATH . "/images/svg/left_quote.svg"; ?>
	</div>
	<div class="row_header">
		<h2>Comments</h2>
		<div class="row_tag" style="transform: rotate(-3deg);">Share your thoughts</div>
	</div>
	<div class="comment_body">
		<div class="comment">
			<?php if ( have_comments() ) : ?>
			<ul>
				<?php foreach ($comments as $comment) : ?>
				<li class="comment" id="comment-<?php comment_ID() ?>">
					<div class="comm_hd"><strong><?php comment_author_link() ?></strong> - <?php comment_date() ?></div>
					<div class="comment_text">
						<?php comment_text() ?>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
			
			<?php else : ?>
			
			<ul>
				<li><?php _e('No comments yet.'); ?></li>
			</ul>
			
			<?php endif; ?>
		</div>
	</div>
	<div class="comment_form">
		<h3>Leave a comment</h3>
		
		<form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
			<?php if ( comments_open() ) : ?>
			
			<?php if ( is_user_logged_in() ) : ?>
			<p><?php printf(__('Logged in as %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account') ?>"><?php _e('Log out'); ?></a></p>
			<div class="form_row">
				<textarea rows="4" cols="1" name="comment" id="comment" placeholder="Comment"></textarea>
			</div>
			<div class="form_row">
				<input type="submit" name="submit" value="Submit" class="btn_submit" />
				<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
				<?php do_action('comment_form', $post->ID); ?>
			</div>
			
			<?php else : ?>
			<p>Your email is never published or shared. Required fields are marked *</p>
			<div class="form_row">
				<input type="text" value="<?php echo esc_attr($comment_author); ?>" name="author" id="author" class="input1" placeholder="Name *" />
			</div>
			<div class="form_row">
				<textarea rows="4" cols="1" name="comment" id="comment" class="input2" placeholder="Comment *"></textarea>
			</div>
			<div class="form_row">
				<input type="text" value="<?php echo esc_attr($comment_author_email); ?>" name="email" id="email" class="input1" placeholder="Email *" />
			</div>
			<div class="form_row">
				<input id="submit" type="submit" name="submit" value="Submit" class="btn_submit" />
				<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
				<?php do_action('comment_form', $post->ID); ?>
			</div>
			
			<?php endif; ?>
			
			<?php else : ?>
			
			<p><?php _e('Sorry, the comment form is closed at this time.'); ?></p>
			
			<?php endif; ?>
		</form>
	</div>
	<div class="qt_r">
		<?php include TEMPLATEPATH . "/images/svg/right_quote.svg"; ?>
	</div>
</div>