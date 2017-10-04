<?php
/*
Plugin Name: E-pages – Magazine Demo
Plugin URI: https://wordpress.org/plugins/
Description: This plugin is for Mad & venner, to manage magazine automatically from epages.dk.
Author: Hasan Mahamud Rana
Version: 1.0.1
Author URI: https://www.facebook.com/rana.imagine
*/
require('e-pages-magazine_api.php');

function get_magazine_details() {
	$customerid = 'madogvenner';
	$folder = 7826;
	$offset = 0;
	$limit = 1;

  $url = API_HOST . '/nordjyskemain/publications.php?customer=' . $customerid . '&folder=' . $folder . '&offset=' . $offset . '&limit=' . $limit . '';
  $body = null;

  $response = fetch_e_pages_magazine_api_data($url, $body);
  return $response->papers;
}

function magazine_code($a) {
	$customerid = 'madogvenner';
	$magazines = get_magazine_details();
	$magazines = array_reverse($magazines, true);
	echo '<figure class="vc_figure mySingleMagazine wpb_animate_when_almost_visible wpb_appear wpb_start_animation">';

	foreach($magazines as $magazine){
	 	$title = $magazine->title;
	 	//echo 'Title: '. $title . '<br/>';

	 	$date = $magazine->date;
	 	//echo 'Date: '. $date . '<br/>';

	 	$expires = $magazine->expires;
	 	//echo 'Expires: '. $expires . '<br/>';

	 	$catalog = $magazine->catalog;
	 	//echo 'Catalog: '. $catalog . '<br/>';

	 	$foldername = $magazine->foldername;
	 	//echo 'Foldername: '. $foldername . '<br/>';

	 	$folder = $magazine->folder;
	 	//echo 'Folder: '. $folder . '<br/>';

	 	$pages = $magazine->pages;
	 	//echo 'Pages: '. $pages . '<br/>';

	 	$sectionstarts = $magazine->sectionstarts;
	 	//echo 'Section starts: '. $sectionstarts . '<br/>';

	 	$sectioncount = $magazine->sectioncount;
	 	//echo 'Section count: '. $sectioncount . '<br/>';

	 	$thumb = $magazine->thumb;
	 	//echo 'Thumb: '. $thumb . '<br/>';

	 	$thumb_medium = $magazine->thumb_medium;
	 	//echo 'Thumb medium: '. $thumb_medium . '<br/><br/><br/>';

	 	echo '<a class="medium-12 large-12 mSingleSlide" href="http://www.e-pages.dk/' . $customerid . '/' . $catalog . '/demo/" rel="bookmark" title="' . $title . '" style="background-image: url(http://' . $thumb_medium . '); background-repeat: no-repeat; background-position: center center; background-size: contain; text-decoration: none; margin: 0 10px; height: ' . esc_attr($a['height']) . 'px;" target="_blank">&nbsp;</a>';
	}

echo '</figure>';
}

function e_pages_magazine_styles() {
	wp_register_style( 'e-pages-magazine-demo', (plugin_dir_url( __FILE__ ) .'css/e-pages-magazine-demo.css'));
	wp_enqueue_style( 'e-pages-magazine-demo' );
}
add_action( 'wp_enqueue_scripts', 'e_pages_magazine_styles' );
/*
function e_pages_magazine_files() {
	wp_register_script( 'e-pages-magazine-demo-script', (plugin_dir_url( __FILE__ ) .'js/e-pages-magazine-demo.js'), false, '1.0', true);
  wp_enqueue_script( 'e-pages-magazine-demo-script' );
}
add_action( 'init', 'e_pages_magazine_files' );
*/
function e_pages_magazine_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'height' => '200',
	), $atts );

	ob_start();
	magazine_code($a);

 	return ob_get_clean();
}
add_shortcode( 'Mad_and_venner', 'e_pages_magazine_shortcode' );
?>