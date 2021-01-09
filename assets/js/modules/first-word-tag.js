"use strict";

jQuery(document).ready(function ($) {
	// Добавить тег в первом слове заголовка
	$('h1.single-page-title').each(function(){
		var me = $(this), t = me.text().split(' ');
		me.html( '<span class="fwextra">' + t.shift() + '</span> ' + t.join(' ') );
	});
});
