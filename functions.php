<?php

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

// Classes
require_once 'classes/class-fl-child-theme.php';

// Actions
add_action( 'wp_enqueue_scripts', 'FLChildTheme::enqueue_scripts', 1000 );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'parallax_enqueue_scripts_styles', 1000 );
function parallax_enqueue_scripts_styles() {
	// Styles
	wp_enqueue_style( 'custom', get_stylesheet_directory_uri() . '/style.css', array() );
    wp_enqueue_style( 'fonts', get_stylesheet_directory_uri() . '/fonts/stylesheet.css', array() );
    //wp_enqueue_style( 'flickity', 'https://npmcdn.com/flickity@2/dist/flickity.css', array() );
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/custom.js', array('jquery') );
    //wp_enqueue_script( 'scrollme', get_stylesheet_directory_uri() . '/js/jquery.scrollme.js', array('jquery') );
    wp_enqueue_style( 'lightslider', 'https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css', array() );


    // Scripts
    //wp_enqueue_script( 'flickity_', 'https://unpkg.com/flickity@2.3.0/dist/flickity.pkgd.min.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'lightslider', 'https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js', array('jquery'), '1.0.0', true );
}

//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'font-awesome' ); // FontAwesome 4
    wp_enqueue_style( 'font-awesome-5' ); // FontAwesome 5

    //wp_dequeue_style( 'jquery-magnificpopup' );
    //wp_dequeue_script( 'jquery-magnificpopup' );

    wp_dequeue_script( 'bootstrap' );
//    wp_dequeue_script( 'imagesloaded' ); //Commented by Saqib on 11/16/21
    wp_dequeue_script( 'jquery-fitvids' );
//    wp_dequeue_script( 'jquery-throttle' ); //Commented by Saqib on 11/16/21
    wp_dequeue_script( 'jquery-waypoints' );
}, 9999 );


// Register Custom Post Type Room Gallery
function create_roomgallery_cpt() {

    $labels = array(
        'name' => _x( 'Room Galleries', 'Post Type General Name', 'textdomain' ),
        'singular_name' => _x( 'Room Gallery', 'Post Type Singular Name', 'textdomain' ),
        'menu_name' => _x( 'Room Galleries', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar' => _x( 'Room Gallery', 'Add New on Toolbar', 'textdomain' ),
        'archives' => __( 'Room Gallery Archives', 'textdomain' ),
        'attributes' => __( 'Room Gallery Attributes', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Room Gallery:', 'textdomain' ),
        'all_items' => __( 'All Room Galleries', 'textdomain' ),
        'add_new_item' => __( 'Add New Room Gallery', 'textdomain' ),
        'add_new' => __( 'Add New', 'textdomain' ),
        'new_item' => __( 'New Room Gallery', 'textdomain' ),
        'edit_item' => __( 'Edit Room Gallery', 'textdomain' ),
        'update_item' => __( 'Update Room Gallery', 'textdomain' ),
        'view_item' => __( 'View Room Gallery', 'textdomain' ),
        'view_items' => __( 'View Room Galleries', 'textdomain' ),
        'search_items' => __( 'Search Room Gallery', 'textdomain' ),
        'not_found' => __( 'Not found', 'textdomain' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
        'featured_image' => __( 'Featured Image', 'textdomain' ),
        'set_featured_image' => __( 'Set featured image', 'textdomain' ),
        'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
        'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
        'insert_into_item' => __( 'Insert into Room Gallery', 'textdomain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Room Gallery', 'textdomain' ),
        'items_list' => __( 'Room Galleries list', 'textdomain' ),
        'items_list_navigation' => __( 'Room Galleries list navigation', 'textdomain' ),
        'filter_items_list' => __( 'Filter Room Galleries list', 'textdomain' ),
    );
    $args = array(
        'label' => __( 'Room Gallery', 'textdomain' ),
        'description' => __( '', 'textdomain' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'taxonomies' => array('roomcategory'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => true,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'roomgallery', $args );

}
add_action( 'init', 'create_roomgallery_cpt', 0 );


// Register Taxonomy Room Category
function create_roomcategory_tax() {

    $labels = array(
        'name'              => _x( 'Room Categories', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Room Category', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Room Categories', 'textdomain' ),
        'all_items'         => __( 'All Room Categories', 'textdomain' ),
        'parent_item'       => __( 'Parent Room Category', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Room Category:', 'textdomain' ),
        'edit_item'         => __( 'Edit Room Category', 'textdomain' ),
        'update_item'       => __( 'Update Room Category', 'textdomain' ),
        'add_new_item'      => __( 'Add New Room Category', 'textdomain' ),
        'new_item_name'     => __( 'New Room Category Name', 'textdomain' ),
        'menu_name'         => __( 'Room Category', 'textdomain' ),
    );
    $args = array(
        'labels' => $labels,
        'description' => __( '', 'textdomain' ),
        'hierarchical' => true,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_quick_edit' => true,
        'show_admin_column' => false,
        'show_in_rest' => true,
    );
    register_taxonomy( 'roomcategory', array('roomgallery'), $args );

}
add_action( 'init', 'create_roomcategory_tax' );


// creating shortcode to display CPT loop
    
function room_gallery(){
    $args = [
        'posts_per_page'         => -1,
        'post_type'              => 'roomgallery',
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
        // 'taxonomy' => 'category-name',
     ];
     $html;
     $post_query = new WP_Query( $args );
     $html .= '<div class="gallery-slider">';
        $html .= '<ul id="vertical">';
            if ( $post_query->have_posts() ) :
                while ( $post_query->have_posts() ) :
                  $post_query->the_post();
                     $thumb = get_the_post_thumbnail_url();
                    $html .= '<li data-thumb="'.$thumb.'"> <img src="'.$thumb.'"/>';

                    $html .= '</li>';
               endwhile;
            endif;
            wp_reset_postdata();
        $html .= '</ul>';
     $html .= '</div>';
    return $html;

    }

add_shortcode('roomgallery', 'room_gallery');
