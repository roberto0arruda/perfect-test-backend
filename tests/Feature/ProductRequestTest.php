<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductRequestTest extends TestCase
{
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
}
