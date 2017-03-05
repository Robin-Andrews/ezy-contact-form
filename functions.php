<?php
// function to reset plugin settings to default values
function ecf_restore_defaults(){
	update_option('header_text', 'Contact us');
	update_option('user_message', 'Please enter your details');
	update_option('success_message', 'Thank you, your message has been sent');
	update_option('bg_color', '#dcdcdc');
	update_option('font_color', '#333333');
	update_option('success_message_color', '#1E9600');
}

function myplugin_activate() {
	ecf_restore_defaults();
}

// shortcode handler
function ra_contact_shortcode($atts, $content=null){
	include MY_PLUGIN_PATH . "form.php";
}

// JavaScript redirect function
function redirect($url)
{
	$string = '<script type="text/javascript">';
	$string .= 'window.location.href = "' . $url . '"';
	$string .= '</script>';

	echo $string;
	return false;
}

// Restore defaults button
function reset_button_action()
{
	ecf_restore_defaults();
	redirect(the_permalink());
}

// Download contacts button
function download_contacts_button_action()
{
	$file = MY_PLUGIN_URL . "/data/contacts.csv";
	redirect($file);
}

// View contacts button
function view_contacts_button_action(){
	$file = MY_PLUGIN_URL . "/data/contacts.csv";
	$html = '<div id="ecf_view_contacts">';
	$html .= file_get_contents($file, null, null, 0, 2000); // maybe add this max as setting
	$html .= "</div>";
	
	echo $html;
}

