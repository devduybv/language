<?php

namespace VCComponent\Laravel\Language\Test\Feature\Web;
use VCComponent\Laravel\Language\Test\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

// use VCComponent\Laravel\Language\Test\TestCase;

class LanguageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function should_get_has_param_language_web()
    {
        $this->call('GET', '/?lang=ja');
        $this->assertEquals('ja', app()->getLocale());

    }
    /**
     * @test
     */
    public function should_get_has_cookie_param_language_web()
    {
        $cookie = ['webpress_language' => 'vi'];
        $this->call('GET', '/?lang=ja', [], $cookie);
        $this->assertEquals('ja', app()->getLocale());

    }
    /**
     * @test
     */
    public function should_get_has_cookie_language_web()
    {
        $cookie = ['webpress_language' => 'vi'];
        $this->call('GET', '/', [], $cookie);
        $this->assertEquals('vi', app()->getLocale());

    }
     /**
     * @test
     */
    public function should_get_not_has_cookie_param_language_web()
    {
        $this->call('GET', '/');
        $this->assertEquals('en', app()->getLocale());

    }

}
