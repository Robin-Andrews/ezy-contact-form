<?php
// reset data on first arrival
$sent = false;
$data = Array();
$msg = '<span style="color: ' . esc_attr( get_option('font_color') ) . '">' . esc_attr( get_option('user_message') ) . '</span>';

// check if form is posted
if (!empty($_POST)) {
	$data = $_POST;
		
	// sanitize form values
	$data['visitor_name'] = sanitize_text_field( $data['visitor_name'] );
	$data['email'] = sanitize_email( $data['visitor_email'] );
	$data['telephone'] = sanitize_text_field( $data['telephone'] );
	$data['enquiry'] = esc_textarea( $data["enquiry"] );
	
	// check they entered their name
	if (empty($data['visitor_name'])) {
		$msg = 'Please enter your name';
	
	// check they entered an email address
	} elseif (empty($data['visitor_email'])) {
		$msg = 'Please enter your email address';
		
	// check email address is valid
	} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
		$msg = 'The email address entered is not valid';
	
	// check enquiry entered
	} elseif (empty($data['enquiry'])) {
		$msg = 'Please enter an enquiry';
			
	// We're good
	} else {	
		
		// Write to CSV file;
		$csv = rtrim(implode($data, ','), ',') . PHP_EOL;
		file_put_contents(ECF_CSV_PATH, $csv, FILE_APPEND);
		
		// set success message and reset input variables
		$msg = '<span style="color: ' . esc_attr( get_option('success_message_color') ) . '">' . esc_attr( get_option('success_message') ) . '</span>';
		$sent = true;
		$data = Array();
	}
}

?>

<!-- Contact form markup -->

<div id="ecf-container" style="background-color: <?= esc_attr( get_option('bg_color') ); ?>; opacity: 0.84">
	<!-- Minimal Bootstrap classes are added in case theme uses it -->
	<h1 class="text-center"><?= esc_attr( get_option('header_text') ); ?></h1>
	
	<div id="ecf-message">
		<?= $msg ?>
	</div><!-- ecf-message -->	
	
	<form action="<?= esc_url( $_SERVER['REQUEST_URI'] );?>" method="post" role="form">
	
		<!-- name begins -->
		<div class="form-group">
			<label class="control-label" for="name">Name</label>
			
			<!-- Although not displayed, the labels are included for screen readers -->
			
			<input class="form-control" id="name" name="visitor_name" type="text" value="<?= isset($data['visitor_name']) ? htmlspecialchars($data['visitor_name']) : '' ?>" placeholder="Your name" required>
			
			<!-- Stress alert! "name" cannot be used as a field name and will lead to a "page does not exist error" -->
			
			<!-- A concious decision to avoid closing tags on self-closing elements. I'm happy to use them if the house styleguide requires them, but my guide here is default simplcity -->
			
			<span class="ecf-required">*</span>
		</div>
		
		<!-- name ends -->
		
		<!-- email begins -->
				
		<div class="form-group">
			<label class="control-label" for="email">Email</label>
			<input class="form-control" id="email" name="visitor_email" type="email" value="<?= isset($data['email']) ? htmlspecialchars($data['visitor_email']) : '' ?>" placeholder="Your email address" required><span class="ecf-required">*</span>
		</div>
		
		<!-- email ends-->		
		
		<div class="form-group">
		<label class="control-label" for="telephone">Telephone</label>
			<input class="form-control" id="telephone" name="telephone" type="tel" value="<?= isset($data['telephone']) ? htmlspecialchars($data['telephone']) : '' ?>" placeholder="Your telephone number">
			<span class="ecf-not-required">*</span>
		</div>
		
		<!-- telephone ends -->
		
		<!-- enquiry begins -->
		
		<div class="form-group">
		<label class="control-label" for="enquiry">Enquiry</label>
			<textarea class="form-control" id="enquiry" name="enquiry" placeholder="Your enquiry" rows=5 required><?= isset($data['enquiry']) ? htmlspecialchars($data['enquiry']) : '' ?></textarea>
			<span class="ecf-required">*</span>
		</div>
		
		<!-- enquiry ends -->
		
		<!-- Submit begins -->
		
		<div class="form-group">
			<button class="ecf-button btn btn-primary" name="submit" type="submit">Submit</button>
		</div>
		
		<!-- Submit ends -->
	
	</form>
		
</div><!-- ecf-container -->