<?php
require_once(get_stylesheet_directory() . '/customizations/petio_shop_category_filter.php');
require_once(get_stylesheet_directory() . '/customizations/petio_page_title.php');
require_once(get_stylesheet_directory() . '/customizations/petio_get_page_title.php');

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

if ( ! function_exists ( 'petio_page_title' ) ) {
   petio_page_title();
}

if ( ! function_exists ( 'petio_get_page_title' ) ) {
   petio_get_page_title();
}

add_shortcode('petio_shop_category_filter', 'petio_shop_category_filter');




