import $ from 'jquery';


$(document).ready(function () {

    var getflagclass = $('.lang.selected>.flag-icon').attr('class');
    var datavalue = $('.lang.selected').attr('data-value');

    $('.current_lang >.lang>.lang-txt').text(datavalue);
    $('.current_lang >.lang>.flag-icon ').attr('class', getflagclass);



    $('.translate_wrapper .current_lang').click(function (e) {
        e.stopPropagation();
        $(this).parent().toggleClass('active');

        setTimeout(function () {
            $('.more_lang').toggleClass('active');
        }, 5);
    });
    $(document).click(function (e) {
        $('.translate_wrapper, .more_lang').removeClass('active');
    });

    const url = window.location.origin;
    $('.more_lang .lang').click(function () {
        $(this).addClass('selected').siblings().removeClass('selected');
        $('.more_lang').removeClass('active');

        var getflagclass = $(this).find('.flag-icon').attr('class');
        var lang = $(this).attr('data-value');

        $('.current_lang .lang-txt').text(lang);
        $('.current_lang img').attr('class', getflagclass);

        location.href = url + '/change-language/' + lang;
    });

});

