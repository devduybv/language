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
    public function should_get_session_language_web()
    {
        $response = $this->call('GET', 'change-language/en');
        $response->assertSessionHas('website_language', 'en');
    }

}
