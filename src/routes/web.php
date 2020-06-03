<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/'], function () {
    Route::middleware(['web'])->group(function () {

        Route::get('change-language/{language}', 'VCComponent\Laravel\Language\Http\Controllers\Web\LanguageController@changeLanguage')->name('user.change-language');
    });
});
