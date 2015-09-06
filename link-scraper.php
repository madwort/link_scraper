<?php
/*
Plugin Name: rconstanzo's Thesis Link Scraper
Plugin URI: http://www.rodrigoconstanzo.com/thesis/
Description: Extract all <a> links from a bunch of WP posts
Version: 0.1
Author: MADWORT
Author URI: http://www.madwort.co.uk
*/

// function link_scraper_scripts()
// {
// 		wp_register_script( 'd3', plugins_url( '/d3.js', __FILE__ ) );
// 		wp_enqueue_script( 'd3' );
// 		wp_register_script( 'link-scraper', plugins_url( '/link-scraper.js', __FILE__ ), array(), "01" );
// 		wp_enqueue_script( 'link-scraper' );
// }
// add_action( 'wp_enqueue_scripts', 'link_scraper_scripts' );
//
// function link_scraper_style()
// {
//     wp_register_style( 'link-scraper-style', plugins_url( '/link-scraper.css', __FILE__ ));
//
//     wp_enqueue_style( 'link-scraper-style' );
// }
// add_action( 'wp_enqueue_scripts', 'link_scraper_style' );

add_shortcode('link-scraper', 'link_scraper_handler');

require __DIR__ . '/vendor/autoload.php';
use PHPHtmlParser\Dom;

function link_scraper_handler($atts)
{

	$dom = new Dom;
	$dom->load('<div class="all"><p>Hey bro, <a href="google.com">click here</a><br /> :)</p></div>');
	$a = $dom->find('a');
	return $a->text; // "click here"
}

?>
