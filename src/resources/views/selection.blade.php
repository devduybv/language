<div class="translate_wrapper">

    <div class="current_lang">
        <div class="lang">
            <span class="flag-icon flag-icon-gb"></span>
            <span class="lang-txt">EN</span>
            <span class="fa fa-chevron-down chevron"></span>
        </div>
    </div>
    <div class="more_lang">
        @foreach($languages as $key=>$data)
        <div class="lang @if(Cookie::get('webpress_language') === $key) selected @endif" data-value='{{$key}}'>
            @foreach($data as $key=>$value)
            <span class="flag-icon flag-icon-{{$key}}"></span>
            <span class="lang-txt">{{$value}}</span> @endforeach
        </div>
        @endforeach


        <!-- <div class="lang  @if(Cookie::get('webpress_language')=== 'vn') selected @endif" data-value='vn'>
            <span class="flag-icon flag-icon-vn"></span>
            <span class="lang-txt">Việt Nam</span>
        </div>

        <div class="lang @if(Cookie::get('webpress_language')=== 'en') selected @endif" data-value='en'>
            <span class="flag-icon flag-icon-us"></span>
            <span class="lang-txt">English<span> (US)</span></span>
        </div>


        <div class="lang @if(Cookie::get('webpress_language')=== 'de') selected @endif" data-value='de'>
            <span class="flag-icon flag-icon-de"></span>
            <span class="lang-txt">Deutsch</span>
        </div>

        <div class="lang @if(Cookie::get('webpress_language')=== 'es') selected @endif" data-value='es'>
            <span class="flag-icon flag-icon-es"></span>
            <span class="lang-txt">Español</span>
        </div>


        <div class="lang @if(Cookie::get('webpress_language')=== 'fr') selected @endif" data-value='fr'>
            <span class="flag-icon flag-icon-fr"></span>
            <span class="lang-txt">Français</span>
        </div>


        <div class="lang @if(Cookie::get('webpress_language')=== 'pt') selected @endif" data-value="pt">
            <span class="flag-icon flag-icon-pt"></span>
            <span class="lang-txt">Português<span> (BR)</span></span>
        </div>

        <div class="lang @if(Cookie::get('webpress_language')=== 'ar') selected @endif" data-value="sa">
            <span class="flag-icon flag-icon-sa"></span>
            <span class="lang-txt">العربية <span> (SA)</span></span>
        </div> -->
    </div>
</div>
