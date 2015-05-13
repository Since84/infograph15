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


add_action('wpcf7_mail_sent', 'wpcf7_send_to_mailchimp', 1);
function wpcf7_send_to_mailchimp($cfdata) {	
$formdata = WPCF7_Submission::get_instance();
$formdata = $formdata ? $formdata->get_posted_data() : null;
// MCAPI.class.php needs to be in theme folder
require_once('MailChimp.php');

$MailChimp = new \Drewm\MailChimp('2240d64496e945dec7680c5b6d499f23-us2');
// grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
// Click the "settings" link for the list - the Unique Id is at the bottom of that page.
$result = $MailChimp->call('lists/subscribe', array(
                'id'                => '6bb029d981',
                'email'             => array('email'=>$formdata['your-email']),
                'merge_vars'        => array('FNAME'=>$formdata['your-first-name'], 'LNAME'=>$formdata['your-last-name']),
                'double_optin'      => false,
                'update_existing'   => true,
                'replace_interests' => false,
                'send_welcome'      => false,
            ));
}

/*****

    Editor Custom Styles

*****/

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  
    // Define the style_formats array
    $style_formats = array(  
        // Each array child is a format with it's own settings
        array(  
            'title' => '.youtube',  
            'block' => 'div',  
            'classes' => 'youtube',
            'wrapper' => true,
            
        )
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
    
    return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );








