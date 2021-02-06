<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'admin'], function ($api) {

        $api->get('language/all', 'VCComponent\Laravel\Language\Http\Controllers\Api\Admin\LanguageController@list');
        $api->resource('language', 'VCComponent\Laravel\Language\Http\Controllers\Api\Admin\LanguageController');

        $api->get('languageable/list', 'VCComponent\Laravel\Language\Http\Controllers\Api\Admin\LanguageableController@list');

        $api->get('languages/get-list-of-languages', function () {
            $data_language_list = config('language.languages');
            return $data_language_list;
        });
    });
});
