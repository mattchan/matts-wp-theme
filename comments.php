<div id="comments">
	<?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
		<p><?php _e('Enter your password to view comments.'); ?></p>
	<?php return; endif; ?>
	
	<h2><?php _e('Comments'); ?></h2>
	
	<div class="comment-meta">
		<?php comments_rss_link(__('<img src="' . get_stylesheet_directory_uri() . '/images/feed-icon-12x12.png" class="feed-icon" alt="RSS feed" /> <abbr title="Really Simple Syndication">RSS</abbr> comments feed for this post')); ?> 
		<?php if ( pings_open() ) : ?>
			 / <a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Uniform Resource Identifier">URI</abbr>'); ?></a>
		<?php endif; ?>
	</div>
	
	<div class="comments-list">
		<?php if ( $comments ) : ?>

			<?php foreach ($comments as $comment) : ?>

				<div class="comment" id="comment-<?php comment_ID() ?>">
					<?php if ($comment->comment_approved == '0') : ?>
						<em>Your comment is awaiting moderation.</em>
					<?php endif; ?>

					<?php comment_author_link() ?> / <a href="#comment-<?php comment_ID() ?>"><?php comment_date() ?> @ <?php comment_time() ?></a><?php edit_comment_link(__("Edit"), ' / '); ?>:

					<div class="comment-text">
						<div class="<?php echo ($comment->user_id==2) ? 'comment-author' : 'comment-normal'; ?>">
						<?php comment_text() ?>
						</div>
					</div>	
				</div>

			<?php endforeach; ?>
		<?php else : ?>
			<p><?php _e('No comments yet.'); ?></p>
		<?php endif; ?>
	</div>

	<div class="comments-form" id="respond">

		<?php if ( comments_open() ) : ?>
			<h2><?php _e('Leave a comment'); ?></h2>

			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
				<p>
					You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.
				</p>

			<?php else : ?>
				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

					<?php if ( $user_ID ) : ?>
						<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account') ?>">Logout &raquo;</a></p>
					<?php else : ?>

						<p><input class="field" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
						<label for="author">Name <?php if ($req) _e('(required)'); ?></label></p>

						<p><input class="field" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
						<label for="email">Mail <?php if ($req) _e('(required / will not be published)'); ?></label></p>

						<p><input class="field" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
						<label for="url">Website</label></p>

					<?php endif; ?>

					<!--<p><small><strong>XHTML:</strong> You can use these tags: <?php echo allowed_tags(); ?></small></p>-->

					<p>Your comment:</p>
					<p><textarea class="comment-box" name="comment" id="comment" tabindex="4" rows="12" cols="67"></textarea></p>

					<p>
						<input class="button" name="submit" type="submit" id="submit" tabindex="5" value="Post Comment" />
						<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
					</p>
			
					<?php do_action('comment_form', $post->ID); ?>

				</form>

			<?php endif; // If registration required and not logged in ?>

		<?php else : // Comments are closed ?>
			<p><?php _e('Sorry, the comment form is closed at this time.'); ?></p>
		<?php endif; ?>
	</div>
</div>