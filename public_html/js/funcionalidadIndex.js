// Scripts de la
$(function () {
	$('a[href*="#"]:not([href="#"])').click(function () {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top
				}, 1100);
				return false;
			}
		}
		;
	});

});

$(function () {

	var $menu = $('#main header nav');
	var $click = $('.mobile');
	$click.on('click', function(e){
		e.preventDefault();
		$menu.slideToggle();
		$menu.css('display', 'flex');
	});
	$('.pull').click(function(e){
		e.preventDefault();
		$menu.slideToggle();
		$menu.css('display', 'flex');
	})
	
	$('#formContacto').submit(function () {
		$('#overlay').show();
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: 'json',
			success: function (json) {
				$('#overlay h2').append(json.msg);
				$('#overlay select').append(json.options);
				$('#formContacto').get(0).setAttribute('action', 'home/guardar');
			}
		});
		return false;
	});

	var templatePreguntas = $('#preguntasTemplate').html();
	var $preguntas = $('#preguntas');
	var $link = $('#getQuestions');

	$.ajax({
		type: 'GET',
		url: 'home/getQuestions',
		dataType: 'json',
		success: function(json) {
			$.each(json, function(indice, obj) {
				$preguntas.append(Mustache.render(templatePreguntas, obj));
			});
		}
	})

	$link.on('click', function(){
		$('#faq').slideToggle();
	})
	
	$(".hexIn").click(function () {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("textoTecnica").innerHTML = xmlhttp.responseText;
			}
		};
		xmlhttp.open("GET", "home/texto_tecnica?id=" + $(this).data("tecnica"), true);
		xmlhttp.send();
	});
});

$(function(){
  $('.carousel').slick({
	centerMode: true,
	canterPadding: 10,
	dots: true,
	infinite: true,
	slidesToShow: 3,
	slidesToScroll: 3,
	responsive: [
	{
		breakpoint: 1030,
		settings: {
			slidesToShow: 2,
			slidesToScroll: 2
		}
	},
	{
		breakpoint: 769,
		settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
		}
	}, 
	{
		breakpoint: 500,
		settings: {
			slidesToScroll: 1,
			slidesToShow: 1,
			dots: false,
			arrows: false
		}
	},
	{
		breakpoint: 740,
		settings: {
			slidesToScroll: 2,
			slidesToShow: 2,
			dots: false
		}
	}
	]
  });
});