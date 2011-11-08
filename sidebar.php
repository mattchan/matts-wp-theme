<!-- begin sidebar -->
<div id="sidebar">

<ul>
	<li class="sidebox">
		<h2>Sections</h2>
		<ul>
			<?php wp_list_pages('include=2&title_li='); ?>
		</ul>
	</li>

	<li class="sidebox">
		<h2>Archives</h2>
		<ul>
			<?php wp_list_pages('include=50,51&title_li='); ?>
		</ul>
	</li>

	<li class="sidebox">
		<h2>Elsewhere</h2>
		<ul>
			<!-- Other links can go here -->
		</ul>
	</li>

	<li class="sidebox">
		<h2>Syndication</h2>
		<ul>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/feed-icon-12x12.png" alt="RSS feed" /> <span><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></span></a></li>
			<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/feed-icon-12x12.png" alt="RSS feed" /> <?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
		</ul>
	</li>

	<li class="sidebox">
		<h2>Administration</h2>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
		</ul>
	</li>

	<li class="sidebox">
		<h2>Other Stuff</h2>
		<ul>
			<li><a href="http://www.brokensaints.com/" title="What would you give to know the truth?"><img alt="Broken Saints" title="What would you give to know the truth?" src="<?php echo get_stylesheet_directory_uri() ?>/images/brokensaints_80x15.png" /></a></li>
		</ul>
	</li>

	<?php wp_meta(); ?>

</ul>

</div>
<!-- end sidebar -->
