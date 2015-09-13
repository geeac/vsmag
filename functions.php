<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add desktop menu walker */
require_once( 'library/menu-walker.php' );

/** Add off-canvas menu walker */
require_once( 'library/offcanvas-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Header image */
require_once( 'library/custom-header.php' );

add_image_size( 'menu-thumbnail', 200, 200, array( 'left', 'top' ) );
add_image_size( 'squared-thumbnail', 1000, 1000 );

/** CHANGE FEATURED IMAGE META BOX CONTENT **/
add_filter( 'admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction( $content ) {
     $content .= '<p><i>Thumbnail must be min. 1000X1000 px.</i></p>';
	 
	 return str_replace(__('Set featured image'), __('Add image'),$content);
}
function navigation_image_box() {
 	// Remove the orginal "Set Featured Image" Metabox
	remove_meta_box('postimagediv', 'page', 'side');
 	// Add it again with another title
	add_meta_box('postimagediv', __('Navigation Image'), 'post_thumbnail_meta_box', 'page', 'normal', 'high');
}
add_action('do_meta_boxes', 'navigation_image_box');

function load_readmore_scripts() {
	wp_enqueue_script(
		'readmore-script',
		get_template_directory_uri() . '/js/custom/readmore.js',
		array('jquery')
	);
}
//if(is_singular( 'vsmagtv' ) ) {
//	echo "ddd";
	add_action('wp_enqueue_scripts', 'load_readmore_scripts');
//}

?>