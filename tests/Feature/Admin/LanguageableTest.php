<?php

namespace VCComponent\Laravel\Language\Test\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use VCComponent\Laravel\Language\Entities\Language;
use VCComponent\Laravel\Language\Entities\Languageable;
use VCComponent\Laravel\Language\Test\TestCase;

class LanguageableTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function should_get_languageable_list_admin()
    {
        $languageable = factory(Languageable::class, 5)->create();
        $languageable = $languageable->map(function ($e) {
            unset($e['updated_at']);
            unset($e['created_at']);
            return $e;
        })->toArray();
        $response = $this->json('GET', 'api/admin/languageable/list');
        $response->assertStatus(200);
        foreach ($languageable as $item) {
            $response->assertJsonFragment([
                'languageable_type' => $item['languageable_type'],
                'field' => $item['field'],
                'value' => $item['value'],
            ]);
        }

    }
    /**
     * @test
     */
    public function should_get_languageable_list_with_constraints_admin()
    {
        $languageable = factory(Languageable::class, 5)->create();
        $type_constraints = $languageable[0]->languageable_type;
        $languageable = $languageable->map(function ($e) {
            unset($e['updated_at']);
            unset($e['created_at']);
            return $e;
        })->toArray();
        $constraints = '{"languageable_type":"' . $type_constraints . '"}';
        $response = $this->json('GET', 'api/admin/languageable/list?constraints=' . $constraints);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'field' => $languageable[0]['field'],
            'field' => $languageable[0]['field'],
            'value' => $languageable[0]['value'],
        ]);
    }
    /**
     * @test
     */
    public function should_not_create_languageable_exists_admin()
    {
        factory(Languageable::class)->create(['languageable_type' => 'posts', 'field' => 'title']);
        $data = factory(Languageable::class)->make(['languageable_type' => 'posts', 'field' => 'title']);
        $response = $this->json('POST', 'api/admin/languageable', [$data]);
        $this->assertTranslationExists($response, 'Bản dịch đã tồn tại');
    }
    /**
     * @test
     */
    public function should_create_languageable_admin()
    {
        $data = factory(Languageable::class)->make(['languageable_type' => 'products', 'field' => 'name']);
        $response = $this->json('POST', 'api/admin/languageable', [$data]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('languageables', $data->toArray());
    }

    /**
     * @test
     */
    public function should_update_languageable_admin()
    {
        $languageable = factory(Languageable::class)->make(['value' => 'value']);
        $languageable->save();
        $id = $languageable->id;
        $languageable->value = "value test";
        $response = $this->json('PUT', 'api/admin/languageable/' . $id, [$languageable]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertDatabaseHas('languageables', ['value' => 'value test']);
        $this->assertDatabaseMissing('languageables', ['value' => 'value']);
    }

    /**
     * @test
     */
    public function should_get_config_language_admin()
    {
        $check = [
            "name" => "English",
            "code" => "en",
        ];
        $response = $this->json('GET', 'api/admin/languages/get-list-of-languages');
        $response->assertStatus(200);
        $response->assertJsonFragment($check);
    }
}
