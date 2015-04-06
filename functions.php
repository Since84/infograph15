<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'owl_animate', get_stylesheet_directory_uri()."/style/owl/animate.css" );
	wp_enqueue_style( 'owl_carousel', get_stylesheet_directory_uri()."/style/owl/owl.carousel.css" );
	wp_enqueue_style( 'owl_theme', get_stylesheet_directory_uri()."/style/owl/owl.theme.css" );
	wp_enqueue_style( 'owl_transitions', get_stylesheet_directory_uri()."/style/owl/owl.transitions.css" );

    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style.css' );

	wp_enqueue_script( 'owl', get_stylesheet_directory_uri()."/script/external/owl.carousel.min.js", array('jquery') );
	wp_enqueue_script( 'flip', get_stylesheet_directory_uri()."/script/external/flip-master/src/flip.js", array('jquery') );
	wp_enqueue_script( 'child_site', get_stylesheet_directory_uri()."/script/site.js", array('jquery', 'backbone', 'underscore', 'smooth-scroll') );

    wp_enqueue_script( 'spark_child_site', get_stylesheet_directory_uri()."/script/site.js", array('site') );
}