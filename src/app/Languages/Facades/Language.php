<?php

namespace VCComponent\Laravel\Language\Languages\Facades;

use Illuminate\Support\Facades\Facade;

class Language extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'language';
    }
}
