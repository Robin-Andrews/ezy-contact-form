<?php
/*
Plugin Name: Ezy Contact Form
Plugin URI: https://github.com/Robin-Andrews/ezy-contact-form.git
Description: Custom contact form plugin
Author: Robin Andrews
Author URI: http://balanceit.one
Version: 1.0
*/

// Constants for plugin paths
defined( 'ECF_PLUGIN_URL' ) || define( 'ECF_PLUGIN_URL', plugin_dir_url(__FILE__) );
defined( 'ECF_PLUGIN_PATH' ) || define( 'ECF_PLUGIN_PATH', plugin_dir_path(__FILE__) );
defined( 'ECF_PATH_TO_CSV' ) || define( 'ECF_PATH_TO_CSV', ECF_PLUGIN_PATH . '/data/contacts.csv' );
defined( 'ECF_CSV_URL' ) || define( 'ECF_CSV_URL', ECF_PLUGIN_URL . 'data/contacts.csv' );
defined( 'ECF_CSV_PATH' ) || define( 'ECF_CSV_PATH', ECF_PLUGIN_PATH . 'data/contacts.csv' );

// Include functions file
include ECF_PLUGIN_PATH . "functions.php";

// On activation. __FILE__ used instead of constant to avoid having to add filename
register_activation_hook(__FILE__, 'ecf_activate' );

// register shortcode
add_shortcode('ecf', 'ecf_shortcode');

// Register the stylesheet
wp_register_style('ecf-style', ECF_PLUGIN_URL .'css/style.css', array(), '', 'all');

// Load the stylesheet
wp_enqueue_style('ecf-style');

// Register js with jquery as dependency
wp_register_script('ecf_script', ECF_PLUGIN_URL .'js/ecf-script.js', array('jquery'), null, true);

// Load js
wp_enqueue_script('ecf_script');

// Make constants available to JS
wp_localize_script( 'ecf_script', 'php_vars', array(
	'ECF_PLUGIN_URL' => ECF_PLUGIN_URL,
	'ECF_PLUGIN_PATH' => ECF_PLUGIN_PATH,
	'ECF_CSV_URL' => ECF_CSV_URL
) );

// Admin page
include ECF_PLUGIN_PATH . "admin.php";