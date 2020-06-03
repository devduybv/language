<?php

namespace VCComponent\Laravel\Language\Http\Controllers\Web;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class LanguageController extends BaseController
{
    public function __construct()
    {

    }
    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }
}
