<?php
/*
Plugin Name: RA Contact
Plugin URI: tbc
Description: Custom contact form plugin
Author: Robin Andrews
Author URI: http://balanceit.one
Version: 1.0
*/

// function to reset plugin settings to default values
function ecf_restore_defaults(){
	update_option('header_text', 'Contact us');
}
// On activation
function plugin_activated()
{
	ecf_restore_defaults();
}

register_activation_hook( __FILE__, "plugin_activated");

// Constants for plugin paths
defined( 'MY_PLUGIN_URL' ) || define( 'MY_PLUGIN_URL', plugin_dir_url(__FILE__) );
defined( 'MY_PLUGIN_PATH' ) || define( 'MY_PLUGIN_PATH', plugin_dir_path(__FILE__) );

// shortcode handler
function ra_contact_shortcode($atts, $content=null){
	include MY_PLUGIN_PATH . "form.php";
}

// register shortcode
add_shortcode('ra-contact', 'ra_contact_shortcode');

// Register the stylesheet
wp_register_style('ra-contact-style', MY_PLUGIN_URL .'css/style.css', array(), '', 'all');

// load the stylesheet
wp_enqueue_style('ra-contact-style');

// Admin page
include MY_PLUGIN_PATH . "admin.php";


