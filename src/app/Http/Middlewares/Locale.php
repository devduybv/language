<?php
namespace VCComponent\Laravel\Language\Http\Middlewares;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use VCComponent\Laravel\Language\Languages\Facades\Language;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->hasLanguageQueryParam($request)) {
            $locale = $request->get('lang');
        } elseif ($this->hasLanguageCookie()) {
            $locale = Cookie::get('webpress_language');
        }
        if (isset($locale)) {
            App::setLocale($locale);
        }
        return $next($request);
    }

    public function hasLanguageQueryParam($request)
    {
        return $request->has('lang') && $this->isValidLocale($request->get('lang'));
    }
    public function hasLanguageCookie()
    {
        return Cookie::has('webpress_language') && $this->isValidLocale(Cookie::get('webpress_language'));
    }
    public function isValidLocale($locale)
    {
        return in_array($locale, Language::getSupportedLocales());
    }
}
