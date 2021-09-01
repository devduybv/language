<?php

namespace VCComponent\Laravel\Language\Test\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use VCComponent\Laravel\Language\Entities\Label;
use VCComponent\Laravel\Language\Test\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function should_get_label_list_admin()
    {
        $labels = factory(Label::class, 5)->create()->toArray();
        $response = $this->json('GET', 'api/admin/labels');
        $response->assertStatus(200);
        foreach ($labels as $item) {
            $response->assertJsonFragment([
                'key' => $item['key'],
                'value' => $item['value'],
            ]);
        }
    }

    /**
     * @test
     */
    public function should_get_label_list_with_constraints_admin()
    {
        $labels = factory(Label::class, 5)->create()->toArray();
        $value_constraints = $labels[0]['key'];
        unset($labels[0]['languages']);
        unset($labels[0]['created_at']);
        unset($labels[0]['updated_at']);

        $constraints = '{"key":"' . $value_constraints . '"}';

        $response = $this->json('GET', 'api/admin/labels?constraints=' . $constraints);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [$labels[0]],
        ]);
    }
    /**
     * @test
     */

    public function should_get_label_list_with_search_admin()
    {
        factory(Label::class, 5)->create();
        $label = factory(Label::class)->create(['value' => 'value_test'])->toArray();
        unset($label['created_at']);
        unset($label['updated_at']);
        unset($label['languages']);
        $response = $this->json('GET', 'api/admin/labels?search=value_test');
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [$label],
        ]);

    }

    /**
     * @test
     */

    public function should_get_label_list_with_order_admin()
    {
        $data = factory(Label::class, 5)->create()->toArray();
        $labels = array_map(function ($label) {
            unset($label['created_at']);
            unset($label['updated_at']);
            unset($label['languages']);
            return $label;

        }, $data);
        $order_by = '{"id":"desc"}';
        $listId = array_column($labels, 'id');
        array_multisort($listId, SORT_DESC, $labels);
        $response = $this->json('GET', 'api/admin/labels?order_by=' . $order_by);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => $labels,
        ]);
    }

    /**
     * @test
     */
    public function should_get_label_list_paginate_admin()
    {
        $labels = factory(Label::class, 5)->create()->toArray();
        $response = $this->json('GET', 'api/admin/labels?page=1');
        $response->assertStatus(200);
        foreach ($labels as $item) {
            $response->assertJsonFragment([
                'key' => $item['key'],
                'value' => $item['value'],
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

}
