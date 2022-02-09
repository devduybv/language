document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector(".lang.selected") !== null) {
        var getflagclass = document.querySelector(".lang.selected>.flag-icon").getAttribute("class");
        var datavalue = document.querySelector(".lang.selected").getAttribute("data-value");
        document.querySelector(".current_lang >.lang>.lang-txt").innerText = datavalue;
        document.querySelector(".current_lang >.lang>.flag-icon ").setAttribute("class", getflagclass);
        var lang = document.querySelector('.more_lang .selected').getAttribute('data-value');
        document.querySelector('html').setAttribute('lang', lang);
    }
    var el_current_lang = document.querySelectorAll(".translate_wrapper .current_lang");
    for (var i = 0; i < el_current_lang.length; i++) {
        el_current_lang[i].addEventListener('click', function(e) {
            e.stopPropagation();
            this.parentElement.classList.toggle('active')
            setTimeout(function() {
                document.querySelector(".more_lang").classList.toggle("active");
            }, 5);
        });
    };
    const url = window.location.origin;
    var elements = document.querySelectorAll(".more_lang .lang");
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener('click', function() {
            document.querySelector(".more_lang .lang").classList.remove("selected");
            this.classList.add("selected");
            document.querySelector(".more_lang").classList.remove("active");
            var getflagclass = document.querySelector(".more_lang .selected .flag-icon").getAttribute("class");
            var lang = this.getAttribute("data-value");
            document.querySelector(".current_lang .lang-txt").innerText = lang;
            if (document.querySelector(".current_lang img") !== null) {
                document.querySelector(".current_lang img").setAttribute("class", getflagclass);
            }
            location.href = url + "/change-language/" + lang;
        });
    };

});