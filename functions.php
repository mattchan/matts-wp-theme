<?php
/*
Plugin Name: Addon helpers
Plugin URI: http://richarboyer.net/
Description: Bonus functions like: "rb_get_search_query" "rb_the_search_query".
Version: 1.0
Author: R.B. Boyer
Author URI: http://richardboyer.net/
*/ 

function rb_xhtml2html($content) {
	return str_replace('/>', '>', str_replace(' />', '>', $content));
}

// good
//add_filter('the_content', 'rb_xhtml2html', 100);
//add_filter('get_the_excerpt', 'rb_xhtml2html', 100);

//add_filter('get_comment_text', 'rb_xhtml2html', 100);
//add_filter('get_comment_excerpt', 'rb_xhtml2html', 100);
 
// ---- old
//add_filter('the_content_rss', 'rb_xhtml2html', 100);
//add_filter('the_excerpt_rss', 'rb_xhtml2html', 100);

function rb_the_author_description($username = 'naelyn',
								   $more_page ='about',
								   $more_id = 'about-more',
								   $more_text = 'More...') {
	global $wpdb;

	$query = "SELECT ID from $wpdb->users WHERE user_login='$username'";

	$authors = $wpdb->get_results($query);

	$author = $authors[0];

	$author = get_userdata( $author->ID );
	$text = $author->description;
	if ( strlen($more_page) > 0 ) {
		$more = ' <a id="'.$more_id.'" href="'.get_bloginfo('url').'/'.$more_page.'/">'.$more_text.'</a>';
		
		$text = $text . $more;
	}

	$out = apply_filters('the_content', $text);

	echo $out;
}

function rb_the_all_posts() {
	// taken from wp-includes/general-template.php::wp_get_archives()
	global $wpdb, $rb_all, $rb_all_counter, $rb_all_index;

	$orderby = "post_date DESC ";
	$limit = '';
	$rb_all = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY $orderby $limit");
	$rb_all_counter = count($rb_all);
	$rb_all_index = 0;
	if ( ! $rb_all ) {
		unset($rb_all_counter);
		unset($rb_all_index);
		unset($rb_all);
	}
}

function rb_has_archive() {
	global $rb_all_counter, $rb_all_index;

	if (isset($rb_all_counter) && isset($rb_all_index)) {
		if ( $rb_all_counter > $rb_all_index ) {
			return true;
		}
	}
	return false;
}

function rb_last_archive() {
	global $rb_all_counter, $rb_all_index;
	return ($rb_all_index == $rb_all_counter);
}

function rb_the_archive() {
	global $rb_arch, $rb_all, $rb_all_counter, $rb_all_index;

	$rb_arch = $rb_all[$rb_all_index];
	$rb_all_index++;
}

function rb_is_archive_empty() {
	global $rb_arch;

	return ($rb_arch->post_date == '0000-00-00 00:00:00');
}

function rb_the_archive_link($class = '') {
	global $rb_arch;

	if ( $rb_arch->post_date != '0000-00-00 00:00:00' ) {
		$url  = get_permalink($rb_arch);
		$arc_title = $rb_arch->post_title;
		if ( $arc_title )
			$text = strip_tags($arc_title);
		else
			$text = $rb_arch->ID;
		
		/* calls get_archives_link($url, $test, 'html', $pre, $aff) */
		$text = wptexturize($text);
		$title_text = attribute_escape($text);

		if ( ! empty($class) ) {
			$class = ' class="'.$class.'"';
		}

		$str = '<a'.$class.' href="'.$url.'" title="'.$title_text.'">'.$text.'</a>';
		
		echo $str;
	}
}

function rb_the_archive_date($d = '') {
	global $rb_arch;

	$the_date = '';
	if ($d =='') {
		$the_date = mysql2date(get_option('date_format'), $rb_arch->post_date);
	} else {
		$the_date = mysql2date($d, $rb_arch->post_date);
	}

	echo $the_date;
}

function rb_the_archive_title($pre = '', $aff = '', $alt = '', $display = true) {
	global $post, $posts, $utw;

	$out = $alt;

	if ( have_posts() ) {
		$post = $posts[0]; // Hack. Set $post so that the_date() works.

		if ( is_category() ) {
			/* if this is a category archive */
			$out = '<a href="'.get_bloginfo('url').'/category/">Category</a> Archive:  '.single_cat_title('', false);
		} elseif ( is_tag() ) {
			/* if this is a tag page */
			$out = '<a href="'.get_bloginfo('url').'/tag/">Tag</a> Archive: '.single_tag_title('', false);
		} elseif ( is_day() ) {
			/* if this is a daily archive */
			$out = 'Archive for '.get_the_time('F jS, Y');
		} elseif ( is_month() ) {
			/* if this is a monthly archive */
			$out = 'Archive for '.get_the_time('F Y');
		} elseif ( is_year() ) {
			/* if this is a yearly archive */
			$out = 'Archive for '.get_the_time('Y');
		} elseif ( is_search() ) {
			/* if this is a search */
			$out = 'Search results'.
				rb_the_search_query('for "',' ','"',true,false);
		} elseif ( is_author() ) {
			/* if this is an author archive */
			$out = 'Author Archive';
		} elseif ( isset($_GET['paged']) && !empty($_GET['paged'])) {
			/* if this is a paged archive */
			$out = 'Blog archives';
		}
	}
	
	$out = apply_filters('the_title', $out);

	if ( empty($out) ) {
		return '';
	} else {
		$out = $pre . $out . $aff;
		
		if ($display) {
			echo $out;
		}
		return $out;
	}	
}

function rb_get_404_uri() {
	$uri = "http://" . $_SERVER{'SERVER_NAME'};
	
	if ( isset($_GET{'f'}) && ! $list_flag ) {
		$uri .= $_GET{'f'}; // from WP
	} else if ( isset($_SERVER{'REQUEST_URI'}) ) {
		if ( $_SERVER{'REQUEST_URI'} == '/missing.php' ) {
			$uri = '';
		} else {
			$uri .= $_SERVER{'REQUEST_URI'}; // from 404
		}
	} else {
		$uri = ''; // from something else
	}

	return $uri;
}

function rb_get_search_query() {
	if ( is_search() ) {
		$search_terms = get_query_var('search_terms');
		if (empty($search_terms)) {
			return array(get_query_var('s'));
		} else {
			return $search_terms;
		}
	} else {
		return array();
	}
}

function rb_the_search_query($pre='"', $sep=' ', $aff='"', $left_gap = false, $display=true) {
	$search_terms = rb_get_search_query();
	
	$out = '';
	if (!empty($search_terms)) {
		$out = $pre.join($sep, $search_terms).$aff;

		//$out = apply_filters('the_title', $out);

		if ($left_gap) {
			$out = " ".$out;
		}
	}
	
	if ($display) {
		echo $out;
	}
	return $out;
}

?>
