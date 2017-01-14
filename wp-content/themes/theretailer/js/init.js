var gbtr_order_review_content_global_var = 'close';

jQuery(document).ready(function($) {
	
	"use strict";

	$(".gbtr_menu_mobiles select").customSelect({customClass:'menu_select'});
	$(".woocommerce_ordering select").customSelect({customClass:'theretailer_product_sort'});
	$(".woocommerce-ordering select").customSelect({customClass:'theretailer_product_sort'});

	$('.gbtr_menu_mobiles_inside').css('visibility', 'visible').animate({opacity: 1.0}, 200);
	
	$(".gbtr_menu_mobiles select").change(function() {
		window.location.href = this.options[this.selectedIndex].value;
	});
	
	//dropdown menu
	$('#menu').superfish({
		hoverClass	: 'sfHover',
		pathClass	: 'overideThisToUse',
		pathLevels	: 1,
		delay		: 300,
		animation	: {opacity:'show'},
		speed		: 300,
		autoArrows	: true,
		disableHI	: false,		// true disables hoverIntent detection
		onInit		: function(){}, // callback functions
		onBeforeShow: function(){},
		onShow		: function(){},
		onHide		: function(){},
		onIdle		: function(){}
	});
	
	//light/dark footer clears
	$('.gbtr_light_footer_wrapper .grid_3:nth-child(4n)').after("<div class='clr'></div>");
	$('.gbtr_dark_footer_wrapper .grid_3:nth-child(4n)').after("<div class='clr'></div>");
	
	//tools bar search
	if ( $.trim( $('.gbtr_tools_search_inputtext').val() ) ) {
	}
	$('.gbtr_tools_search').mouseenter(function(){
		$('.gbtr_tools_search_inputtext').animate({width: "show"}, 0);
    }).mouseleave(function(){
			$('.gbtr_tools_search_inputtext').hide(0);
    });
	$('.gbtr_tools_search_inputtext').blur(function() {
		if ( !$.trim( $('.gbtr_tools_search_inputtext').val() ) ) {
			$(this).hide(0);
		}
	});
	
	//minicart	
	//fix hoverIntent() with live()
	$(".gbtr_header_wrapper").on("mouseenter", ".gbtr_little_shopping_bag_wrapper", function() {
		if(!$(this).data('init'))
        {
            $(this).data('init', true);
            $(this).hoverIntent
            (
                function()
                {
					$('.gbtr_minicart_wrapper').fadeIn(200);
                },

                function()
                {
                    $('.gbtr_minicart_wrapper').fadeOut(200);
                }
            );
            $(this).trigger('mouseenter');
        }
	});
	
	
	$(".gbtr_header_wrapper").on("mouseenter", ".shopping_bag_centered_style", function() {
		if(!$(this).data('init'))
        {
            $(this).data('init', true);
            $(this).hoverIntent
            (
                function()
                {
					$('.gbtr_minicart_wrapper').fadeIn(200);
                },

                function()
                {
                    $('.gbtr_minicart_wrapper').fadeOut(200);
                }
            );
            $(this).trigger('mouseenter');
        }
	});
	
	//woocommerce widget filters
	$('.product_list_widget > li > a > img').each(function() {
		$(this).parent().before(this);
		$(this).wrap('<div class="product_list_widget_img_wrapper" />');
	});
	
	$('.product_list_widget > li > a').each(function() {
		if ($.trim($(this).text()).length > 30 ) { $(this).text($.trim($(this).text()).substr(0, 30) + "..."); }
	});
	
	$('.product_list_widget > li > .product_list_widget_img_wrapper').each(function() {
		$(this).parent().children('a').prepend(this);
	});
	
	// responsive tables
	$('.footable').footable();
	
	// home slideshow
	$('.gbtr_slideshow .default-slider').iosSlider({
		snapToChildren: true,
		scrollbar: true,
		scrollbarHide: true,
		desktopClickDrag: true,
		scrollbarLocation: 'top',
		scrollbarHeight: '2px',
		scrollbarBackground: '#fff',
		scrollbarBorder: '0',
		scrollbarMargin: '10px',
		scrollbarOpacity: '0.3',
		navNextSelector: $('.default-slider-next'),
		navPrevSelector: $('.default-slider-prev')
	});
	
	/*content tabs*/	
	$('.shortcode_tabgroup').find("div.panel").hide();
	$('.shortcode_tabgroup').find("div.panel:first").show();
	$('.shortcode_tabgroup').find("ul li:first").addClass('active');
	 
	$('.shortcode_tabgroup ul li a').click(function(){
		//$('.shortcode_tabgroup ul li').removeClass('active');
		$(this).parent().parent().parent().find('ul li').removeClass('active');
		$(this).parent().addClass('active');
		var currentTab = $(this).attr('href');
		$(this).parent().parent().parent().find('div.panel').hide();
		$(currentTab).fadeIn(300);
		return false;
	});
	
	/*content accordion*/
	$('.accordion').each(function(){
		var acc = $(this).attr("rel") * 2;
		$(this).find('.accordion-inner:nth-child(' + acc + ')').show();
		$(this).find('.accordion-inner:nth-child(' + acc + ')').prev().addClass("active");
	});
	
	$('.accordion .accordion-title').click(function() {
		if($(this).next().is(':hidden')) {
			$(this).parent().find('.accordion-title').removeClass('active').next().slideUp(200);
			$(this).toggleClass('active').next().slideDown(200);
		} else {
			$(this).parent().find('.accordion-title').removeClass('active').next().slideUp(200);
		}
		return false;
	});

	$('.gbtr_login_register_reg .button').click(function() {
		
		$('.gbtr_login_register_slider').animate({
			left: -$('.gbtr_login_register_wrapper').width()
		}, 300, function() {
			// Animation complete.
		});
	
		$('.gbtr_login_register_wrapper').animate({
			height: $('.gbtr_login_register_slide_2').height() + 100
		}, 300, function() {
			// Animation complete.
		});
		
		$('.gbtr_login_register_label_slider').animate({
			top: -$('.gbtr_login_register_switch').height()
		}, 300, function() {
			// Animation complete.
		});
	
	});
	
	$('.gbtr_login_register_log .button').click(function() {
		$('.gbtr_login_register_slider').animate({
			left: '0'
		}, 300, function() {
			// Animation complete.
		});
		
		$('.gbtr_login_register_wrapper').animate({
			height: $('.gbtr_login_register_slide_1').height() + 100
		}, 300, function() {
			// Animation complete.
		});
		
		$('.gbtr_login_register_label_slider').animate({
			top: '0'
		}, 300, function() {
			// Animation complete.
		});
	});

	
	/* button show */	
	$('.product_item').mouseenter(function(){
		$(this).find('.product_button').fadeIn(100, function() {
			// Animation complete.
		});
    }).mouseleave(function(){
		$(this).find('.product_button').fadeOut(100, function() {
			// Animation complete.
		});
    });
	
	$('p').filter(function() {
		return $.trim($(this).text()) === '' && $(this).children().length === 0;
	}).remove();
	
	$(".gallery").each(function() { 
		$(this).find('.fresco')
			.attr('data-fresco-group', $(this).attr('id'));
	});
	
	//audioPlayer	
	$('audio').audioPlayer();
	
	//fitVids	
	$(".entry-content").fitVids();
	
	$("#review_form_wrapper").show();
	
	$('.custom_show_review_form').click(function () {		
		$("#review_form_wrapper_overlay").show();
		$('#global_wrapper').hide();
	});
	
	$('#review_form_wrapper_overlay_close').click(function () {		
		$("#review_form_wrapper_overlay").hide();
		$('#global_wrapper').show();
	});
	
	$('.demo_top_message .close').click(function () {		
		$(".demo_top_message").slideUp();
	});
	
	$(".doubleSlider-1")
		.mouseenter(function() {
			$(".theretailer_zoom").addClass("translated");
		})
		.mouseleave(function() {
			$(".theretailer_zoom").removeClass("translated");
		});
	
	
});

jQuery(document).ajaxStop(function() {
	
	"use strict";

	if (gbtr_order_review_content_global_var === "open") {
		
		jQuery('.gbtr_order_review_content').show();
		jQuery(".gbtr_order_review_header").removeClass("gbtr_checkout_header_nonactive");
		
	} else {
		
		jQuery(".gbtr_order_review_header").addClass("gbtr_checkout_header_nonactive");
		
	}
	
});