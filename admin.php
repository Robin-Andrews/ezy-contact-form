<?php
add_action('admin_menu', function() {
  add_options_page( 'Easy Contact Form Settings Page', 'Easy Contact Form', 'manage_options', 'easy-contact-form', 'ecf_admin_page_callback' );
});

add_action( 'admin_init', function() {
    register_setting( 'ecf_plugin_settings', 'header_text' );
});

function test_button_action()
{
	ecf_restore_defaults();
	header('Location: '.$_SERVER['REQUEST_URI']);
	exit();
}

function ecf_admin_page_callback(){
?>
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
                <td><?php submit_button(); ?></td>
            </tr>
 
        </table>
 
      </form>
			
		<?php
		// Check whether the restore button has been pressed AND also check the nonce
		if (isset($_POST['test_button']) && check_admin_referer('test_button_clicked')) {
			// the button has been pressed AND we've passed the security check
			test_button_action();
		}?>
		
		<form action="options-general.php?page=easy-contact-form" method="post">
		<?php  wp_nonce_field('test_button_clicked');?>
		<input type="hidden" value="true" name="test_button" />
		<?php submit_button('Restore defaults');?>
		</form>
		
    </div><!-- wrap -->
<?php
}