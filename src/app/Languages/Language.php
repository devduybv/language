<?php

namespace VCComponent\Laravel\Language\Languages;

class Language
{
    public function getAvailableLanguages()
    {
        return config('language.list-language');
    }
}
