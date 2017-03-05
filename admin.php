<?php

add_action('admin_menu', function() {
  add_options_page( 'Easy Contact Form Settings Page', 'Easy Contact Form', 'manage_options', 'easy-contact-form', 'ecf_admin_page_callback' );
});

add_action( 'admin_init', function() {
    register_setting( 'ecf_plugin_settings', 'header_text' );
    register_setting( 'ecf_plugin_settings', 'user_message' );
    register_setting( 'ecf_plugin_settings', 'success_message' );
    register_setting( 'ecf_plugin_settings', 'bg_color' );
});

function ecf_admin_page_callback(){
?>
<!-- Admin settings markup -->
<div class="wrap">
      <form action="options.php" method="post">
 
        <?php
          settings_fields( 'ecf_plugin_settings' );
          do_settings_sections( 'ecf_plugin_settings' );
        ?>
        <table>
             
            <tr>
                <th>Header text</th>
                <td><input type="text" name="header_text" value="<?php echo esc_attr( get_option('header_text') ); ?>" size="50" /></td>
            </tr>
						
            <tr>
                <th>User Message</th>
                <td><input type="text" name="user_message" value="<?php echo esc_attr( get_option('user_message') ); ?>" size="100" /></td>
            </tr>
						
            <tr>
                <th>Success Message</th>
                <td><input type="text" name="success_message" value="<?php echo esc_attr( get_option('success_message') ); ?>" size="100" /></td>
            </tr>
						
            <tr>
                <th>Background Colour - font colors to be added if time</th>
                <td><input type="color" name="bg_color" value="<?php echo esc_attr( get_option('bg_color') ); ?>" /></td>
            </tr>						
 
            <tr>
                <td><?php submit_button(); ?></td>
            </tr>
 
        </table>
 
      </form>
			
		<!-- Reset button begins -->
		<?php
		// Check whether the restore button has been pressed AND also check the nonce
		if (isset($_POST['reset_button']) && check_admin_referer('reset_button_clicked')) {
			// the button has been pressed AND we've passed the security check
			reset_button_action();
		}?>
		
		<form action="options-general.php?page=easy-contact-form" method="post">
		<?php  wp_nonce_field('reset_button_clicked');?>
		<input type="hidden" value="true" name="reset_button" />
		<?php submit_button('Restore defaults');?>
		</form>
		
		<!-- Reset button ends -->
		
		<!-- Download contacts button begins -->
		<div id="ecf-download-button">
			<?php submit_button('Download contacts');?>
		</div>
		
		<!-- Download contacts button ends -->
		
		<!-- View contacts button begins -->
		<?php
		// Check whether the restore button has been pressed AND also check the nonce
		if (isset($_POST['view_contacts']) && check_admin_referer('view_contacts_button_clicked')) {
			// the button has been pressed AND we've passed the security check
			view_contacts_button_action();
		}?>
		
		<form action="options-general.php?page=easy-contact-form" method="post">
		<?php  wp_nonce_field('view_contacts_button_clicked');?>
		<input type="hidden" value="true" name="view_contacts" />
		<?php submit_button('View Contacts');?>
		</form>
		
		<!-- View contacts button ends -->
			
    </div><!-- wrap -->
<?php
}