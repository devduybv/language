<?php

namespace VCComponent\Laravel\Language\Providers;

use Illuminate\Support\ServiceProvider;
use VCComponent\Laravel\Language\Repositories\LanguageableRepository;
use VCComponent\Laravel\Language\Repositories\LanguageableRepositoryEloquent;
use VCComponent\Laravel\Language\Repositories\LanguageRepository;
use VCComponent\Laravel\Language\Repositories\LanguageRepositoryEloquent;
use VCComponent\Laravel\Language\Languages\Language;


class LanguageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        $this->publishes([
            __DIR__ . '/../../resources/sass/change-language.scss' => base_path('/resources/sass/change-language/change-language.scss'),
            __DIR__ . '/../../resources/js/change-language.js' => base_path('/resources/js/change-language/change-language.js'),
            __DIR__ . '/../../resources/lang/vn' => base_path('/resources/lang/vn'),
            __DIR__ . '/../../config/language.php' => config_path('language.php'),
        ]);
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'locale');
    }

    /**
     * Register any package services
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('language', Language::class);
        $this->app->bind(LanguageRepository::class, LanguageRepositoryEloquent::class);
        $this->app->bind(LanguageableRepository::class, LanguageableRepositoryEloquent::class);
    }
}
