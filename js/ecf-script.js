(function($) {
// Prevent caching so latest resutlts show
$.ajaxSetup({ cache: false });

// Path th CSV using WP Localization
var file = php_vars.ECF_CSV_URL;

// Toggle showing CSV contents
$('#ecf-view-contacts-button').on('click', function(e){
	$('#ecf-view-contacts-field').load(file);
	$('#ecf-view-contacts-field').toggle();
});
	
})( jQuery );