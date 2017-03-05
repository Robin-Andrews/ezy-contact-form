<?php

add_action('admin_menu', 'reset_button_menu');

function reset_button_menu(){
  add_menu_page('Test Button Page', 'Test Button', 'manage_options', 'test-button-slug', 'reset_button_admin_page');

}

function reset_button_admin_page() {

  // This function creates the output for the admin page.
  // It also checks the value of the $_POST variable to see whether
  // there has been a form submission. 

  // The check_admin_referer is a WordPress function that does some security
  // checking and is recommended good practice.

  // General check for user permissions.
  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient pilchards to access this page.')    );
  }

  // Start building the page

  echo '<div class="wrap">';

  echo '<h2>Test Button Demo</h2>';

  // Check whether the button has been pressed AND also check the nonce
  if (isset($_POST['reset_button']) && check_admin_referer('reset_button_clicked')) {
    // the button has been pressed AND we've passed the security check
    reset_button_action();
  }

  echo '<form action="options-general.php?page=test-button-slug" method="post">';

  // this is a WordPress security feature - see: https://codex.wordpress.org/WordPress_Nonces
  wp_nonce_field('reset_button_clicked');
  echo '<input type="hidden" value="true" name="reset_button" />';
  submit_button('Call Function');
  echo '</form>';

  echo '</div>';

}

function reset_button_action()
{
  echo '<div id="message" class="updated fade"><p>'
    .'The "Call Function" button was clicked.' . '</p></div>';

  $path = WP_TEMP_DIR . '/test-button-log.txt';

  $handle = fopen($path,"w");

  if ($handle == false) {
    echo '<p>Could not write the log file to the temporary directory: ' . $path . '</p>';
  }
  else {
    echo '<p>Log of button click written to: ' . $path . '</p>';

    fwrite ($handle , "Call Function button clicked on: " . date("D j M Y H:i:s", time())); 
    fclose ($handle);
  }
}  
?>