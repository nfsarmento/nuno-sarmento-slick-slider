<?php defined('ABSPATH') or die();

add_theme_support('post-thumbnails', array('nuno-sarmento-ss-cpt'));

/* ------------------------------------------
// Register Custom Post Type ----------------
--------------------------------------------- */

function nuno_sarmento_nsss_slick_custom_posts() {

	$labels = array(
		'name'                => _x( 'NS Slider', 'Post Type General Name', 'nuno-sarmento-nsss-slick-slider' ),
		'singular_name'       => _x( 'NS Slider', 'Post Type Singular Name', 'nuno-sarmento-nsss-slick-slider' ),
		'menu_name'           => __( 'NS Slider', 'nuno-sarmento-nsss-slick-slider' ),
		'parent_item_colon'   => __( 'Parent Slide:', 'nuno-sarmento-nsss-slick-slider' ),
		'all_items'           => __( 'All Slides', 'nuno-sarmento-nsss-slick-slider' ),
		'view_item'           => __( 'View Slide', 'nuno-sarmento-nsss-slick-slider' ),
		'add_new_item'        => __( 'Add New Slide', 'nuno-sarmento-nsss-slick-slider' ),
		'add_new'             => __( 'Add New', 'nuno-sarmento-nsss-slick-slider' ),
		'edit_item'           => __( 'Edit Slide', 'nuno-sarmento-nsss-slick-slider' ),
		'update_item'         => __( 'Update Slide', 'nuno-sarmento-nsss-slick-slider' ),
		'search_items'        => __( 'Search Slide', 'nuno-sarmento-nsss-slick-slider' ),
		'not_found'           => __( 'Not found', 'nuno-sarmento-nsss-slick-slider' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'nuno-sarmento-nsss-slick-slider' ),
	);
	$args = array(
		'label'               => __( 'nuno-sarmento-nsss-slick-slider', 'nuno-sarmento-nsss-slick-slider' ),
		'description'         => __( 'Here are the Slicky Slides', 'nuno-sarmento-nsss-slick-slider' ),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail', 'revisions'),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'			  => 'dashicons-slides',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'nuno-sarmento-ss-cpt', $args );

}
add_action( 'init', 'nuno_sarmento_nsss_slick_custom_posts');
