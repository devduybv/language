<?php

namespace VCComponent\Laravel\Language\Languages;

class Language
{
    public function getSupportedLocales()
    {
        return config('language.supportsLocales');
    }
}
