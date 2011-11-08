<?php get_header(); ?>

	<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="post">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				
				<div class="post-info">
					<?php the_time('F jS, Y') ?> / <?php the_time('g:i a') ?> / <?php the_category(', ') ?> / <?php the_tags('', ', ', '') ?>
				</div>

				<div class="post-content">
					<?php the_content('Continue reading the rest of this entry &raquo;'); ?>
				</div>
					
				<div class="post-end">
					<p><?php edit_post_link('Edit', '', ' | '); ?><?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
				</div>
			</div>

			<hr />

			<?php endwhile; ?>

			<div id="bottomnav">
				<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
				<div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
			</div>

			<?php else : ?>
			<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>