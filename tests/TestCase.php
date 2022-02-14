<?php

namespace VCComponent\Laravel\Language\Test;

use Dingo\Api\Provider\LaravelServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use VCComponent\Laravel\Language\Providers\LanguageServiceProvider;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return VCComponent\Laravel\Generator\Providers\GeneratorServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [
            LaravelServiceProvider::class,
            LanguageServiceProvider::class,

        ];
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(__DIR__ . '/../tests/Stubs/Factory');
        $this->loadMigrationsFrom(__DIR__ . '/../src/database/migrations');
        \Illuminate\Support\Facades\Route::middleware(\VCComponent\Laravel\Language\Http\Middlewares\Locale::class)->any('/', function () {
            return 'OK';
        });

    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'base64:TEQ1o2POo+3dUuWXamjwGSBx/fsso+viCCg9iFaXNUA=');
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('language.namespace', 'language-management');
        $app['config']->set('language.models', [
            'language' => \VCComponent\Laravel\Language\Entities\Language::class,

        ]);
        $app['config']->set('language.transformers', [
            'language' => \VCComponent\Laravel\Language\Transformers\LanguageTransformer::class,
        ]);
        $app['config']->set('language.auth_middleware', [
            'admin' => [
                'middleware' => '',
            ],
            'frontend' => [
                'middleware' => '',
            ],
        ]);
        $app['config']->set('language.supportedLocales', [
            'vi', 'en', 'ja',
        ]);

        $app['config']->set('language.languages', [
            [
                "name" => "English",
                "code" => "en",
            ],
        ]);

        $app['config']->set('api', [
            'standardsTree' => 'x',
            'subtype' => '',
            'version' => 'v1',
            'prefix' => 'api',
            'domain' => null,
            'name' => null,
            'conditionalRequest' => true,
            'strict' => false,
            'debug' => true,
            'errorFormat' => [
                'message' => ':message',
                'errors' => ':errors',
                'code' => ':code',
                'status_code' => ':status_code',
                'debug' => ':debug',
            ],
            'middleware' => [
            ],
            'auth' => [
            ],
            'throttling' => [
            ],
            'transformer' => \Dingo\Api\Transformer\Adapter\Fractal::class,
            'defaultFormat' => 'json',
            'formats' => [
                'json' => \Dingo\Api\Http\Response\Format\Json::class,
            ],
            'formatsOptions' => [
                'json' => [
                    'pretty_print' => false,
                    'indent_style' => 'space',
                    'indent_size' => 2,
                ],
            ],
        ]);

    }
    public function assertValidation($response, $field, $error_message)
    {
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            "errors" => [
                $field => [
                    $error_message,
                ],
            ],
        ]);
    }
    public function assertTranslationExists($response, $error_message)
    {
        $response->assertStatus(500);
        $response->assertJson([
            "message" => $error_message,
        ]);
    }
}
