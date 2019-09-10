<?php

function identity_assets() {
	wp_enqueue_style('identity_css', get_stylesheet_directory_uri() . '/assets/css/style.css', array('roots_main'));
	wp_enqueue_script('identity_js', get_stylesheet_directory_uri() . '/assets/js/identity.js', array('jquery'));
}
add_action( 'wp_enqueue_scripts', 'identity_assets' );

class Mega_Menu_Walkernav extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "\n<div class=\"dropdown-menu\">\n\t<div class=\"container\">\n\t\t<div class=\"dropdown-menu-nav-icon\">\n\t\t\t<ul class=\"dropdown-menu-nav\">\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item_html = '';
		parent::start_el( $item_html, $item, $depth, $args );

		if ( $item->is_dropdown && ( $depth === 0 ) ) {
			$item_html = str_replace( 'li', 'li aria-haspopup="true"', $item_html );
			$item_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html );
			$item_html = str_replace( '</a>', ' <b class="nav-caret"></b></a>', $item_html );
		}
		elseif ( stristr( $item_html, 'li class="divider' ) ) {
			$item_html = preg_replace( '/<a[^>]*>.*?<\/a>/iU', '', $item_html );
		}
		elseif ( stristr( $item_html, 'li class="dropdown-header' ) ) {
			$item_html = preg_replace( '/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html );
		}

		// $item_html = apply_filters( 'roots_wp_nav_menu_item', $item_html );
		$output .= $item_html;
	}

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		$element->is_dropdown = ( ( !empty( $children_elements[$element->ID] ) && ( ( $depth + 1 ) < $max_depth || ( $max_depth === 0 ) ) ) );

		if ( $element->is_dropdown ) {
			$element->classes[] = 'dropdown';
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$output .= "</li>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "\n\t\t\t</ul>\n\t\t</div>\n\t</div>\n</div>\n";
	}

}

// Customizer Edits
require_once locate_template('/lib/customizer/sections/customizer_footer_guidelines.php'); // Add footer guidelines section

function remove_heelium_default_options() {
	// Remove default Heelium Customizer options
	remove_action('customize_register','tcx_register_theme_customizer'); // Colors
	remove_action('customize_register','full_width_title_register'); // Header
	remove_action('customize_register','heelium_nav_customizer'); // Hover Nav options
	remove_action('customize_register','themeslug_theme_customizer'); // Logos

	// Remove default Heelium custom walker nav to prevent footer dropdown menus
	remove_action( 'wp_nav_menu_args', 'roots_nav_menu_args' ); 
}
add_action('after_setup_theme', 'remove_heelium_default_options');
 
// Add parent slug to child page body classes
function custom_body_class($classes) {
	global $post;
	if (is_page() && !$post->post_parent == 0) {
		$parent  = end(get_post_ancestors($current_page_id));
		$post_data = get_post($parent, ARRAY_A);
		$classes[] = 'parent-' . $post_data['post_name'];
	}
	return $classes;
}
add_filter('body_class','custom_body_class');