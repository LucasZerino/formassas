(function ($) {

	"use strict";
	
	// Preload
	$(window).on('load', function () { // makes sure the whole site is loaded
		$('[data-loader="circle-side"]').fadeOut(); // will first fade out the loading animation
		$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
		$('body').delay(350).css({
			'overflow': 'visible'
		});
	})

	// Submit loader mask 
	var form = $("form#wrapped");
	form.on('submit', function () {
		form.validate();
		if (form.valid()) {
			$("#loader_form").fadeIn();
		}
	});

	/* Round Input Slider */
	$("#budget_slider").roundSlider({
		radius: 100,
		min: 400,
		max: 3000,
		step: 100,
		editableTooltip: false,
		width: 20,
		handleSize: "+16",
		handleShape: "dot",
		sliderType: "min-range",

		// SVG related properties
		svgMode: false,
		borderWidth: 1,
		borderColor: "#ededed",
		pathColor: null,
		rangeColor: null,
		tooltipColor: "#333",
		value: 1200
	});


    // Float labels
	var floatlabels = new FloatLabels( 'form', {
		style: 1
	});

	// Tooltips
	const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    // Cost Calculator
    $('.products input').on('change', function() {
	  var mysum = 0;
	  $('.products').find('input:checked').each(function() {
	    mysum += $(this).data('price') 
	  });
	  $('.final_price').val('$' + mysum);
	});
		
})(window.jQuery); 