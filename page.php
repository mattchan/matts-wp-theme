<?php get_header(); ?>

	<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<div class="post">
				<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>

				<div class="post-info"><?php edit_post_link('Edit this page', '', ''); ?></div>
		
				<div class="post-content">
					<?php if ( is_page('tags') ) : ?>
						<?php include('m_tags.php'); ?>
					<?php elseif ( is_page('categories') ) : ?>
						<?php include('m_categories.php'); ?>
					<?php else : ?>
						<?php the_content(__('(more...)')); ?>
					<?php endif; ?>
				</div>
			</div>
	</div>

	<?php endwhile; else: ?>

	<?php include('none.php'); ?>
	<?php endif; ?>
	<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?>
	<?php get_sidebar(); ?>
</div>



<?php get_footer(); ?>