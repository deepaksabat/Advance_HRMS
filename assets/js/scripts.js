var $ = jQuery;

$(document).ready(function(){
	if ( $('.textarea-wysihtml5').length > 0 ) {
		$('.textarea-wysihtml5').wysihtml5({
			toolbar: {
				'fa': true
			}
		});
	}

    // var screenWidth=window.screen.width;
    // if ( screenWidth >= 1920){
    //     $('body').addClass("no-nav-animation left-bar-open");
    //     var handler = setTimeout(function(){
    //         $('body').removeClass("no-nav-animation");
    //         clearTimeout(handler);
    //     }, 200);
    // }

});


$('#left-nav .nav-bottom-sec').slimScroll({
	height: '100%',
	size: '4px',
	color: '#999'
});


$('#bar-setting').click(function(e){
	e.preventDefault();

	if ( $(window).width() > 767 ) {
		$('body.has-left-bar').toggleClass('left-bar-open');
	} else {
		$('.left-nav-bar .nav-bottom-sec').slideToggle( 500, function(){
			$('body.has-left-bar').toggleClass('left-bar-open');
		});
	}

});



$('#left-navigation').find('li.has-sub>a').on('click', function(e){
	e.preventDefault();
	var $thisParent = $(this).parent();

	if ( $thisParent.hasClass('sub-open') ) {

		// Hide the Submenu
		$thisParent.removeClass('sub-open').children('ul.sub').slideUp(150);

	} else {

		// Show the Submenu
		$thisParent.addClass('sub-open').children('ul.sub').slideDown(150);

		// Hide Others Submenu
		$thisParent.siblings('.sub-open').removeClass('sub-open').children('ul.sub').slideUp(150);

	}
});


// alertify customize

alertify.warning = alertify.extend("warning");
alertify.info = alertify.extend("info");

// Tooltip init

$(function () {
	$('[data-toggle="tooltip"]').tooltip()
});

// Form
(function(){

	$('.form-group.form-group-default .form-control').on('focus', function(e){
		$(this).closest('.form-group').addClass('focused');
	}).on('blur', function(e){
		var $closest = $(this).closest('.form-group');
		if ($(this).val().length > 0) {
			$closest.addClass('filled');
		} else {
			$closest.removeClass('filled');
		}
		$closest.removeClass('focused');
	});

	$('.form-group.form-group-default select.form-control').on('change', function(){
		$(this).closest('.form-group').addClass('filled');
	});

})();



