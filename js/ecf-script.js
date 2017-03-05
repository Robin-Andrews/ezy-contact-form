(function($) {

var file = php_vars.MY_PLUGIN_URL + 'data/contacts.csv';
php_vars.MY_PLUGIN_URL

$('#ecf-view-contacts-field').css('display', 'none');
$('#ecf-view-contacts-field').load(file);
	
$('#ecf-view-contacts-button').on('click', function(e){
	$('#ecf-view-contacts-field').toggle();
});
	
})( jQuery );

