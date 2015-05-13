<?php get_header();


$context = Timber::get_context();



$subnavContext  = array( "nav" => new TimberMenu( "sub-nav" ) );
$context['nav'] = Timber::compile( 'views/components/nav.twig', $subnavContext );

$postArgs 			= array( 'showposts' => 1, 'category_name' => 'current' );
$context['post'] 	= Timber::get_posts($postArgs);

$feedArgs 						= array( 'post_type' => 'post', 'showposts' => 10 );
$feedContext['class']			= "owl-carousel";
$feedContext['feed'] 			= Timber::get_posts($feedArgs);
$feedContext['slide_template'] 	= '/views/components/more_info_slide.twig';
$context['more_info'] 			= Timber::compile('/views/components/raw_feed.twig', $feedContext);

$about = get_page_by_title( 'About Infograph' );
$context['about'] = new TimberPost($about->ID);

$context['signup'] = do_shortcode( '[contact-form-7 id="85" title="MailChimp Signup"]' );

///Display Page 
Timber::render( '/views/home.twig', $context );

get_footer();