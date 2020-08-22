<?php

namespace Tests\Feature\Http\Requests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductRequestTest extends TestCase
{
    use DatabaseMigrations;

    public function testCheckIfAllFieldsIsValidated()
    {
        $response = $this->postJson('/api/products');

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
                'description',
                'price'
            ]);
    }

    public function testCheckIfPriceFieldIsLessThan100()
    {
        $response = $this->postJson('/api/products', [
            'price' => 50,
            'name' => 'test',
            'description' => 'test'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'price'
            ]);
    }
}
