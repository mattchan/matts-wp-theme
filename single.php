<?php get_header(); ?>

	<div id="single">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
			<div id="topnav">
				<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
				<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
			</div>

			<div class="post">
				<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>

				<div class="post-info">
					<?php edit_post_link('Edit','',' / '); ?><?php the_time('F jS, Y') ?> / <?php the_time('g:i a') ?> / <?php the_category(', ') ?> / <?php the_tags('', ', ', '') ?>
				</div>

				<div class="post-content">
					<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
					<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
				</div>
			</div>

			<hr />

			<?php comments_template(); ?>

		<?php endwhile; else: ?>
			<p>Sorry, no posts matched your criteria.</p>
		<?php endif; ?>
	</div>
</div>
	
<?php get_footer(); ?>
