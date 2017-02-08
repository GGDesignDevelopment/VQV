(function() {
    // Modelos para manejar el header, los estados, y las posiciones
    var header = {
            position: 'main',
            state: states,
        },
        positions = {
            main: 'Verde que te Quiero Verde.',
            about: 'Sobre nosotras.',
            faq: 'Preguntas Frecuentes',
            footer: 'Contactate.'
        },
        states = {
            scroll: false,
            responsive: false
        };


    // Cache de elementos del dom
    var $header = $('#mainMenu'),
        $burguer = $('#burguer'),
        $headerText = $header.find('h2'),
        $nav = $header.find('nav');

    var docHeight = $(document).height(),
        responsive = ($(window).width() < 768) ? true : false,
        mainScroll = $('#main').offset().top,
        aboutScroll = $('#about').offset().top,
        faqScroll = $('#faq').offset().top,
        footScroll = $('footer').offset().top;

    $(window).bind('mousewheel DOMMouseScroll scroll', render);
    $burguer.on('click', navToggle);

    function navToggle(e) {
        $nav.toggleClass('expand');
        e.preventDefault();
    };

    function render() {

        _calcPos($(this).scrollTop());

        $headerText.html(header.position);

        var scroll = $(this).scrollTop() > 0 ? true : false;

        if (scroll) {
            $header.addClass('scroll');
        } else {
            $header.removeClass('scroll')
        }
    }

    function _calcPos(scroll) {
        var footPos = (faqScroll - footScroll) / 2;
        if (scroll >= 0 && scroll < aboutScroll) {
            header.position = positions.main;
        } else
        if (scroll >= aboutScroll && scroll < faqScroll) {
            header.position = positions.about;
        } else
        if (scroll >= faqScroll && scroll < footScroll) {
            header.position = positions.faq;
        }
    }


})();

(function() {

    //DOM CACHE
    var $faq = $('#faq'),
        $nav = $faq.find('nav'),
        $firstDiv = $('#first'),
        $secDiv = $('#preguntas'),
        template = $('#templateQuestions').html();


    $nav.on('click', 'a', toggleQuestions);
    $faq.on('click', 'a.question', _linkToggle);
    $(document).ready(_renderQuestions);

    function toggleQuestions(e) {
        e.preventDefault();
        $faq.find('.active').removeClass('active')
        var pos = $(this).data('posicion');
        if (pos == 0) {
            $firstDiv.addClass('active');
        } else {
            $secDiv.addClass('active');
        }
    }

    function _renderQuestions() {
        var questions = {};
        $.ajax({
            type: 'GET',
            url: baseURL + 'home/getQuestions',
            dataType: 'json',
            success: function(json) {
                $.each(json, function(i, obj) {
                    $secDiv.append(Mustache.render(template, obj));
                })
            }
        });
    }

    function _linkToggle(e) {
        var id = $(this).data('id');
        if ($(this).next().hasClass('active')) {
            $secDiv.find('p.active').slideUp().removeClass('active');
        } else {
            $secDiv.find('p.active').slideUp().removeClass('active');
            $secDiv.find('p[data-id="' + id + '"]').addClass('active');
            $secDiv.find('p[data-id="' + id + '"]').slideDown();
        }
        e.preventDefault();

    }



})();
(function() {

    var $formWrap = $('#form-wrap'),
        $form = $formWrap.find('form'),
        $send = $form.find('input[type=submit]'),
        $input = $form.find('input');
    succesMsg = $('#fomr-sent').html(),
        errorMsg = $('#form-error').html(),
        placeholder = null;

    $input.on('focus', '.eval', clearVal);
    $input.on('blur', '.eval', reassignVal);
    $input.on('keyup', '.eval', getFormVal);
    $form.on('click', 'input[type=submit]', suscribe);

    function suscribe(e) {
        console.log('suscribe');
        $.ajax({
            type: 'POST',
            url: baseURL + 'home/suscribir',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(json) {
                _suscribeSucces(json)
            },
            error: function() {
                _suscribeError();
            }
        });
        e.preventDefault();
    }

    function clearVal(e) {
        placeholder = $(this).val();
        if (placeholder != '') {
            $(this).val('');
        }
    }

    function reassignVal() {
        console.log('Reassign: ' + placeholder);
        $(this).val(placeholder);
    }

    function getFormVal() {
        placeholder = $(this).val();
        console.log('getFormVal: ' + placeholder);
    }

    function _suscribeSucces() {
        $formWrap.html(Mustache.render(succesMsg))
    }

    function _suscribeError() {
        $formWrap.html(Mustache.render(errorMsg))
    }

})();
