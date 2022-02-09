<?php

namespace VCComponent\Laravel\Language\Http\Controllers\Web;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends BaseController
{
    public function __construct()
    {

    }
    public function changeLanguage($language)
    {
        Cookie::queue(Cookie::forever('webpress_language', $language));
        return redirect()->back();

    }
}
