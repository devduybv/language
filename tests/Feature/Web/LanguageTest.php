<?php

namespace VCComponent\Laravel\Language\Test\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use VCComponent\Laravel\Language\Test\TestCase;

class LanguageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function should_get_cookie_language_web()
    {
        $response = $this->call('GET', 'change-language/en');
        $response->assertCookie('webpress_language', 'en');
    }

}
