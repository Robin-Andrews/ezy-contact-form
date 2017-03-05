<?php
// reset data on first arrival
$sent = false;
$data = Array();
$msg = 'Please enter your details'; // stores user message

// check if form is posted
if (!empty($_POST)) {
	$data = $_POST;
	
	// sanitize form values
	$data['visitor_name'] = sanitize_text_field( $data['visitor_name'] );
	$data['email'] = sanitize_email( $data['email'] );
	$data['telephone'] = sanitize_text_field( $data['telephone'] );
	$data['enquiry'] = esc_textarea( $data["enquiry"] );
	
	// Write to CSV file;
	$csv = rtrim(implode($data, ','), ',') . PHP_EOL;
	$file = MY_PLUGIN_PATH . "/data/contacts.csv";
	file_put_contents($file, $csv, FILE_APPEND);
	
	// set thank-you message and reset input variables
	$success_msg = '<span style="color: #1E9600;">' . esc_attr( get_option('success_message') ) . '</span>';
	$sent = true;
	$data = Array();
}

?>
<div id="ra-contact-container" style="background-color: <?= esc_attr( get_option('bg_color') ); ?>; opacity: 0.84">
	<!-- Minimal Bootstrap classes are added in case theme uses it -->
	<h1 class="text-center"><?= esc_attr( get_option('header_text') ); ?></h1> <!-- set in admin or use default -->
	
	<div id="ra-contact-success-message">
		<?= $sent == true? $success_msg : esc_attr( get_option('user_message') ) ?>
	</div><!-- ra-contact-success-message -->	
	
	<form action="<?= esc_url( $_SERVER['REQUEST_URI'] );?>" method="post" role="form">
		
		<div class="form-group"> <!-- name -->
			<label class="control-label" for="name">Name</label>
			
			<!-- although not displayed, the labels are included for screen readers -->
			
			<input class="form-control" id="name" name="visitor_name" type="text" value="<?= isset($data['visitor_name']) ? htmlspecialchars($data['visitor_name']) : '' ?>" placeholder="Your name" required>
			
			<!-- Stress alert! "name" cannot be used as a field name and will lead to a "page does not exist error" -->
			
			<!-- A concious decision to avoid closing tags on self-closing elements. I'm happy to use them if the house styleguide requires them, but my guide here is default simplcity -->
			
			<span class="ra-contact-required">*</span>
		</div>
				
		<div class="form-group"> <!-- email -->
			<label class="control-label" for="email">Email</label>
			<input type="email" class="form-control" id="email" name="email" type="text" value="<?= isset($data['email']) ? htmlspecialchars($data['email']) : '' ?>" placeholder="Your email address" required><span class="ra-contact-required">*</span>
		</div>
		
		<div class="form-group"> <!-- telephone -->
		<label class="control-label" for="telephone">Telephone</label>
			<input class="form-control" id="telephone" name="telephone" type="tel" value="<?= isset($data['telephone']) ? htmlspecialchars($data['telephone']) : '' ?>" placeholder="Your telephone number">
			<span class="ra-contact-not-required">*</span>
		</div>
		
		<div class="form-group"> <!-- enquiry -->
		<label class="control-label" for="enquiry">Enquiry</label>
			<textarea class="form-control" id="enquiry" name="enquiry" placeholder="Your enquiry" rows=5 required><?= isset($data['enquiry']) ? htmlspecialchars($data['enquiry']) : '' ?></textarea>
			<span class="ra-contact-required">*</span>
		</div>
		
		<div class="form-group">
			<button class="ra-contact-button btn btn-primary" name="submit" type="submit">Submit</button>
		</div>
	
	</form>
		
</div><!-- ra-contact-container -->