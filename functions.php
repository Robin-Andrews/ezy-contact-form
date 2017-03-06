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

// Plugin activation callback
function ecf_activate() {
	reset_csv();
	ecf_restore_defaults();
}

// Shortcode handler
function ecf_shortcode($atts, $content=null){
	include ECF_PLUGIN_PATH . "form.php";
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
	$file = ECF_CSV_URL;
	redirect($file);
}

// Reset CSV function
function reset_csv(){
	$headings = 'Name, Email, Telephone, Enquiry' . PHP_EOL;
	file_put_contents(ECF_CSV_PATH, $headings);
}