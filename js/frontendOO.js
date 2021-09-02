jQuery(document).ready(function($){


	$('#mobile_menu_toggler').click(function(){     
		$('#mobile_menu').stop(true,true).slideToggle(500);
	});

	/* ---------------------------------------------------------------- */
	/* Mobile Navigation - Sub Menus
	/* ---------------------------------------------------------------- */

	$('#mobile_menu li.menu-item-has-children a').click(function () {
		$(this).next('ul').toggle();
	});


	// Shopping bag hover function
	jQuery(document).on("mouseenter", "li.shopping-bag-item", function() {

		if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
			jQuery(this).find('ul.sub-menu').first().stop( true, true ).fadeIn(200);
			shopBagHovered = true;
		}
	}).on("mouseleave", "li.shopping-bag-item", function() {

		if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
			jQuery(this).find('ul.sub-menu').first().stop( true, true ).fadeOut(150);
			shopBagHovered = false;
		}
	});

	if ( jQuery('.product-grid').length > 0 ) {
		jQuery('.product-grid').equalHeights();
	}


});

(function($){

	var masonryItems = $('.blog-masonry').find('.masonry-items'), 
		itemWidth = masonryItems.find('li.blog-item').first().width();
	console.log(itemWidth);
	masonryItems.isotope({
		percentPosition: true,
  		itemSelector: '.blog-item',
		layoutMode: 'masonry',
		masonry: {
    	//	columnWidth: itemWidth
  		}
  	});

  	setTimeout(function() {
		masonryItems.isotope('layout');
	}, 500);

  	var portfolioContainer = $('.portfolio-wrap').find('.filterable-items');

	if (portfolioContainer.hasClass('masonry-items')) {
		portfolioContainer.isotope({
			itemSelector: '.masonry-item',
			layoutMode: 'masonry',
			masonry: {}
		});
	} else {
		portfolioContainer.isotope({
			itemSelector: '.portfolio-item',
			layoutMode: 'fitRows'
		});
	}

	setTimeout(function() {
		portfolioContainer.isotope('layout');
	}, 500);

	$('.filter-wrap .filtering li').each(function() {
		var filter = $(this),
			filterName = $(this).find('a').attr('class'),
			portfolioItems = $(this).parents('.portfolio-wrap').find('.filterable-items');

		portfolioItems.find('.portfolio-item').each( function() {
			if ( $(this).hasClass(filterName) ) {
				filter.addClass('has-items');
			}
		});
	});

	$('.post-filter-tabs li').on('click', 'a', function(e) {
		e.preventDefault();
		$(this).parent().parent().find('li').removeClass('selected');
		$(this).parent().addClass('selected');
    	var selector = $(this).data('filter');
    	var portfolioItems = $('.portfolio-wrap').find('.filterable-items');
    	portfolioItems.isotope({ filter: selector });
    });

	$(".yith-wcqv-button:contains('Quick View')").css("display", "none");
	$(".yith-wcqv-button:contains('Quick View')").remove();

})(jQuery);	

