var $ = require('jquery');
	window.jQuery = $;
	window.$ = $;
var Mustache = 	require('mustache'),
		header = require('./modules/header.js');
//require('./modules/user.js');
//require('./modules/cart.js');
//require('./modules/products.js');
var Head = require('./modules/header.js');

var $mainMenu = $('#mainMenu'),
		$faq = $('#faq'),
		$faqNav = $faq.find('nav');



(function() {
//	var user = new User(),
//			cart = new Cart(),
//			products = new Products();
var			header =  new Head($mainMenu);

	$(window).bind('mousewheel DOMMouseScroll scroll', navMenuController);
	
	function navMenuController() {
		header.scrollPosition = null;
		header.position = null;
		header.render;
	}
})();


 