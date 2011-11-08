<?php
$messages = get_stylesheet_directory()."/messages";

// Check for file existence and print a random line
if( file_exists( $messages ) ) {
	$line = file( $messages );
	echo $line[ rand( 0, count($line) - 1 ) ];
} else {
	bloginfo('description');
}
?>