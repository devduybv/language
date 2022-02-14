<?php

namespace VCComponent\Laravel\Language\Test\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use VCComponent\Laravel\Language\Entities\Language;
use VCComponent\Laravel\Language\Test\TestCase;

class LanguageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function should_get_language_list_admin()
    {
        $languages = factory(Language::class, 5)->create()->toArray();
        $response = $this->json('GET', 'api/admin/language/all');
        $response->assertStatus(200);
        foreach ($languages as $item) {
            $response->assertJsonFragment([
                'name' => $item['name'],
                'code' => $item['code'],
            ]);
        }
    }

    /**
     * @test
     */
    public function should_get_language_list_with_constraints_admin()
    {
        $languages = factory(Language::class, 5)->create();
        $name_constraints = $languages[0]->name;
        $code_constraints = $languages[0]->code;
        $languages = $languages->map(function ($language) {
            unset($language['created_at']);
            unset($language['updated_at']);
            return $language;
        })->toArray();

        $constraints = '{"name":"' . $name_constraints . '", "code":"' . $code_constraints . '"}';

        $response = $this->json('GET', 'api/admin/language/all?constraints=' . $constraints);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [$languages[0]],
        ]);
    }
    /**
     * @test
     */

    public function should_get_language_list_with_search_admin()
    {
        factory(Language::class, 5)->create();
        $language = factory(Language::class)->create(['name' => 'english'])->toArray();
        unset($language['created_at']);
        unset($language['updated_at']);
        $response = $this->json('GET', 'api/admin/language/all?search=english');
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [$language],
        ]);
    }

    /**
     * @test
     */

    public function should_get_language_list_with_order_admin()
    {
        $languages = factory(Language::class, 5)->create();

        $languages = $languages->map(function ($language) {
            unset($language['created_at']);
            unset($language['updated_at']);
            return $language;
        })->toArray();
        $order_by = '{"id":"desc"}';
        $listId = array_column($languages, 'id');
        array_multisort($listId, SORT_DESC, $languages);

        $response = $this->json('GET', 'api/admin/language/all?order_by=' . $order_by);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => $languages,
        ]);
    }

    /**
     * @test
     */
    public function should_get_language_list_paginate_admin()
    {
        $languages = factory(Language::class, 5)->create()->toArray();
        $response = $this->json('GET', 'api/admin/language');
        $response->assertStatus(200);
        foreach ($languages as $item) {
            $response->assertJsonFragment([
                'name' => $item['name'],
                'code' => $item['code'],
            ]);
        }

        $response->assertJsonStructure([
            'data' => [],
            'meta' => [
                'pagination' => [
                    'total', 'count', 'per_page', 'current_page', 'total_pages', 'links' => [],
                ],
            ],
        ]);
    }

    /**
     * @test
     */
    public function should_get_language_list_with_constraints_paginate_admin()
    {
        $languages = factory(Language::class, 5)->create();
        $name_constraints = $languages[0]->name;
        $code_constraints = $languages[0]->code;
        $languages = $languages->map(function ($language) {
            unset($language['created_at']);
            unset($language['updated_at']);
            return $language;
        })->toArray();

        $constraints = '{"name":"' . $name_constraints . '", "code":"' . $code_constraints . '"}';

        $response = $this->json('GET', 'api/admin/language?constraints=' . $constraints);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [$languages[0]],
        ]);

        $response->assertJsonStructure([
            'data' => [],
            'meta' => [
                'pagination' => [
                    'total', 'count', 'per_page', 'current_page', 'total_pages', 'links' => [],
                ],
            ],
        ]);
    }

    /**
     * @test
     */
    public function should_get_language_list_with_search_paginate_admin()
    {
        factory(Language::class, 5)->create();
        $language = factory(Language::class)->create(['name' => 'english'])->toArray();
        unset($language['created_at']);
        unset($language['updated_at']);
        $response = $this->json('GET', 'api/admin/language?search=english');
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [$language],
        ]);

        $response->assertJsonStructure([
            'data' => [],
            'meta' => [
                'pagination' => [
                    'total', 'count', 'per_page', 'current_page', 'total_pages', 'links' => [],
                ],
            ],
        ]);
    }
    /**
     * @test
     */
    public function should_get_language_list_with_order_paginate_admin()
    {
        $languages = factory(Language::class, 5)->create();
        $languages = $languages->map(function ($language) {
            unset($language['created_at']);
            unset($language['updated_at']);
            return $language;
        })->toArray();
        $order_by = '{"id":"desc"}';
        $listId = array_column($languages, 'id');
        array_multisort($listId, SORT_DESC, $languages);

        $response = $this->json('GET', 'api/admin/language?order_by=' . $order_by);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => $languages,
        ]);
        $response->assertJsonStructure([
            'data' => [],
            'meta' => [
                'pagination' => [
                    'total', 'count', 'per_page', 'current_page', 'total_pages', 'links' => [],
                ],
            ],
        ]);
    }

    /**
     * @test
     */
    public function should_not_create_language_exists_admin()
    {
        factory(Language::class)->create(['name' => 'english', 'code' => 'en']);
        $data = factory(Language::class)->make(['name' => 'english', 'code' => 'en'])->toArray();
        $response = $this->json('POST', 'api/admin/language', $data);
        $this->assertValidation($response, 'name', 'The name has already been taken.');
        $this->assertValidation($response, 'code', 'The code has already been taken.');
    }
    /**
     * @test
     */

    public function should_not_create_language_required_admin()
    {
        $data = factory(Language::class)->make(['name' => '', 'code' => ''])->toArray();
        $response = $this->json('POST', 'api/admin/language', $data);
        $this->assertValidation($response, 'name', 'The name field is required.');
        $this->assertValidation($response, 'code', 'The code field is required.');
    }
    /**
     * @test
     */

    public function should_create_language_admin()
    {
        $data = factory(Language::class)->make()->toArray();
        $response = $this->json('POST', 'api/admin/language', $data);
        $response->assertStatus(200);
        $response->assertJson(['data' => $data]);
        $this->assertDatabaseHas('languages', $data);
    }

    /**
     * @test
     */
    public function should_not_get_language_not_exists_item_admin()
    {
        factory(Language::class)->create();
        $response = $this->json('GET', 'api/admin/language/2');
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function should_get_language_item_admin()
    {
        $language = factory(Language::class)->create();
        $response = $this->json('GET', 'api/admin/language/' . $language->id);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $language->name,
            'code' => $language->code,
        ]);
    }

    /**
     * @test
     */
    public function should_not_update_language_exists_admin()
    {
        factory(Language::class)->create(['name' => 'english', 'code' => 'en']);
        $language = factory(Language::class)->create();
        $id = $language->id;
        $language->name = 'english';
        $language->code = 'en';
        $data = $language->toArray();
        $response = $this->json('PUT', 'api/admin/language/' . $id, $data);
        $this->assertValidation($response, 'name', 'The name has already been taken.');
        $this->assertValidation($response, 'code', 'The code has already been taken.');

    }
    /**
     * @test
     */
    public function should_not_update_language_required_admin()
    {
        $language = factory(Language::class)->create();
        $id = $language->id;
        $language->name = '';
        $language->code = '';
        $data = $language->toArray();
        $response = $this->json('PUT', 'api/admin/language/' . $id, $data);
        $this->assertValidation($response, 'name', 'The name field is required.');
        $this->assertValidation($response, 'code', 'The code field is required.');
    }

    /**
     * @test
     */
    public function should_update_language_admin()
    {

        $language = factory(Language::class)->create();
        $id = $language->id;
        $language->name = 'America';
        $language->code = 'usa';
        $data = $language->toArray();
        unset($data['updated_at']);
        unset($data['created_at']);

        $response = $this->json('PUT', 'api/admin/language/' . $id, $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('languages', $data);
    }

    /**
     * @test
     */
    public function should_soft_delete_language_admin()
    {
        $language = factory(Language::class)->create()->toArray();
        unset($language['updated_at']);
        unset($language['created_at']);
        $this->assertDatabaseHas('languages', $language);
        $response = $this->json('DELETE', 'api/admin/language/' . $language['id']);
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertDeleted('languages', $language);

    }

}
