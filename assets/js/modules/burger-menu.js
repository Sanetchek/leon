"use strict";

jQuery(document).ready(function ($) {
	// Burger menu change style
	$('.burger-menu').on('click', function () {
	    this.classList.toggle("change");
	    $('.main-menu').slideToggle();
	});
});
 