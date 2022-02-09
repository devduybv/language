import $ from 'jquery';

document.addEventListener('DOMContentLoaded', function() {
    var getflagclass = document.querySelector(".lang.selected>.flag-icon").getAttribute("class");
    var datavalue = document.querySelector(".lang.selected").getAttribute("data-value");
    document.querySelector(".current_lang >.lang>.lang-txt").innerText = datavalue;
    document.querySelector(".current_lang >.lang>.flag-icon ").setAttribute("class", getflagclass);
    $(".translate_wrapper .current_lang").click(function(e) {
        e.stopPropagation();
        $(this).parent().toggleClass("active");

        setTimeout(function() {
            document.querySelector(".more_lang").classList.toggle("active");
        }, 5);
    });
    const url = window.location.origin;
    $(".more_lang .lang").click(function() {
        $(this).addClass("selected").siblings().removeClass("selected");
        document.querySelector(".more_lang").classList.remove("active");

        var getflagclass = $(this).find(".flag-icon").attr("class");
        var lang = $(this).attr("data-value");

        document.querySelector(".current_lang .lang-txt").innerText = lang;
        if (document.querySelector(".current_lang img") !== null) {
            document.querySelector(".current_lang img").setAttribute("class", getflagclass);
        }
        location.href = url + "/change-language/" + lang;
    });
    var lang = document.querySelector('.more_lang .selected').getAttribute('data-value');
    document.querySelector('html').setAttribute('lang', lang);
    document.querySelector('body').classList.add(lang);
}, false);