<?php get_header(); ?>

<div id="main">
	<?php get_sidebar(); ?>
	<div id="content">
		<div class="post">
			<h2>Error 404: File not found</h2>

			<div class="post-content">
				The <acronym="Uniform Resource Identifier">URI</acronym> you have tried to access:
				<br />&raquo;&nbsp;<code><?php echo rb_get_404_uri(); ?></code><br />
				is either invalid or points to moved, deleted, or outdated content.
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>