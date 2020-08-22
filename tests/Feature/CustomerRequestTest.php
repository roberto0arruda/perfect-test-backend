<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerRequestTest extends TestCase
{
    public function testCheckIfAllFieldsIsValidated()
    {
        $response = $this->postJson('/api/customers');

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'name', 'email', 'cpf'
            ]);
    }
}
