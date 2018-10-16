// Change Alertify position to top
$('#top').on('click', function(e){
	e.preventDefault();
	if ( !$('body').hasClass('alertify-top') ) {
		$('body').addClass('alertify-top');
	}
});

// Change Alertify position to bottom
$('#bottom').on('click', function(e){
	e.preventDefault();
	if ( $('body').hasClass('alertify-top') ) {
		$('body').removeClass('alertify-top');
	}
});

// Add Alertify Border
$('#add-border').on('click', function(e){
	e.preventDefault();
	if ( !$('body').hasClass('alertify-border') ) {
		$('body').addClass('alertify-border');
	}
});

// Remove Alertify Border
$('#remove-border').on('click', function(e){
	e.preventDefault();
	if ( $('body').hasClass('alertify-border') ) {
		$('body').removeClass('alertify-border');
	}
});





/*============== Alfetify Alets ==============*/

$('#button_error').on('click', function(){
	alertify.log("<i class='fa fa-times-circle'></i> <span>You have Deleted The User</span>", "error", 0);
});

$('#button_success').on('click', function(){
	alertify.log("<i class='fa fa-check-circle-o'></i> <span>New Task Added</span>", "success");
});

$('#button_warning').on('click', function(){
	alertify.log("<i class='fa fa-exclamation-circle'></i> <span>Only 9 counts left</span>", "warning");
});

$('#button_info').on('click', function(){
	alertify.log("<i class='fa fa-info'></i> <span>You have a new message</span>", "info");
});