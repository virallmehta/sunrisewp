( function($) {

	$('html, body').css('height', 'auto');

	//
	// General 
	//
	wp.customize('general_background_color',function( value ) {
		value.bind(function(to) {
			$('body').css('background-color', to ? to : '' );
		});
	});

	wp.customize('general_text_color',function( value ) {
		value.bind(function(to) {
			$('body').css('color', to ? to : '' );
		});
	});
	
	wp.customize('general_link_color',function( value ) {
		value.bind(function(to) {
			$('a, a:visited').css('color', to ? to : '' );
		});
	});

	wp.customize('general_link_hover_color',function( value ) {
		value.bind(function(to) {
			$('a:hover').css('color', to ? to : '' );
		});
	});

	wp.customize('general_h1_color',function( value ) {
		value.bind(function(to) {
			$('h1').css('color', to ? to : '' );
		});
	});

	wp.customize('general_h2_color',function( value ) {
		value.bind(function(to) {
			$('h2').css('color', to ? to : '' );
		});
	});

	wp.customize('general_h3_color',function( value ) {
		value.bind(function(to) {
			$('h3').css('color', to ? to : '' );
		});
	});

	wp.customize('general_h4_color',function( value ) {
		value.bind(function(to) {
			$('h4').css('color', to ? to : '' );
		});
	});

	wp.customize('general_h5_color',function( value ) {
		value.bind(function(to) {
			$('h5').css('color', to ? to : '' );
		});
	});

	wp.customize('general_h6_color',function( value ) {
		value.bind(function(to) {
			$('h6').css('color', to ? to : '' );
		});
	});

	//
	// Top Bar 
	//
	wp.customize('topbar_background_color',function( value ) {
		value.bind(function(to) {
			$('#top-header-bar').css('background-color', to ? to : '' );
		});
	});

	wp.customize('topbar_text_color',function( value ) {
		value.bind(function(to) {
			$('#top-header-bar').css('color', to ? to : '' );
		});
	});

	wp.customize('topbar_link_color',function( value ) {
		value.bind(function(to) {
			$('#top-header-bar a, #top-header-bar .menu > li > a').css('color', to ? to : '' );
		});
	});

	wp.customize('topbar_link_hover_color',function( value ) {
		value.bind(function(to) {
			$('#top-header-bar a:hover, #top-header-bar .menu > li > a:hover').css('color', to ? to : '' );
		});
	});

	//
	// Header 
	//
	wp.customize('header_background_color',function( value ) {
		value.bind(function(to) {
			$('#header').css('background-color', to ? to : '' );
		});
	});

	wp.customize('header_link_color',function( value ) {
		value.bind(function(to) {
			$('#header a, #header .menu > li > a').css('color', to ? to : '' );
		});
	});

	wp.customize('header_link_hover_color',function( value ) {
		value.bind(function(to) {
			$('#header a:hover, #header .menu > li > a:hover').css('color', to ? to : '' );
		});
	});

	//
	// Foooter 
	//
	wp.customize('footer_background_color',function( value ) {
		value.bind(function(to) {
			$('.footer-widgets-area').css('background-color', to ? to : '' );
		});
	});

	wp.customize('footer_text_color',function( value ) {
		value.bind(function(to) {
			$('.footer-widgets-area').css('color', to ? to : '' );
		});
	});

	wp.customize('footer_link_color',function( value ) {
		value.bind(function(to) {
			$('.footer-widgets-area a, .footer-widgets-area .menu > li > a').css('color', to ? to : '' );
		});
	});

	wp.customize('footer_link_hover_color',function( value ) {
		value.bind(function(to) {
			$('.footer-widgets-area a:hover, .footer-widgets-area .menu > li > a:hover').css('color', to ? to : '' );
		});
	});

	wp.customize('footer_copyright_background_color',function( value ) {
		value.bind(function(to) {
			$('.copyright-social-bar').css('background-color', to ? to : '' );
		});
	});

	wp.customize('footer_copyright_text_color',function( value ) {
		value.bind(function(to) {
			$('.copyright-social-bar').css('color', to ? to : '' );
		});
	});

	wp.customize('footer_copyright_link_color',function( value ) {
		value.bind(function(to) {
			$('.copyright-social-bar a, .copyright-social-bar .menu > li > a').css('color', to ? to : '' );
		});
	});

	wp.customize('footer_copyright_link_hover_color',function( value ) {
		value.bind(function(to) {
			$('.copyright-social-bar a:hover, .copyright-social-bar .menu > li > a:hover').css('color', to ? to : '' );
		});
	});

})(jQuery);