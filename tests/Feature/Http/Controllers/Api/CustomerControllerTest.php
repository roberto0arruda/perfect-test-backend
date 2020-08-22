<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Customer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testCheckIfIndexFunctionIsWorking()
    {
        $customer = factory(Customer::class)->create();
        $expected = [
            'data' => [
                [
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'cpf' => $customer->cpf
                ]
            ]];

        $response = $this->get(route('customers.index'));

        $response
            ->assertStatus(200)
            ->assertJson($expected);
    }

    public function testCheckIfShowFunctionIsWorking()
    {
        $customer = factory(Customer::class)->create();

        $response = $this->get(route('customers.show', ['customer' => $customer->id]));
        $response
            ->assertStatus(200)
            ->assertJson($customer->toArray());

        $response = $this->get(route('customers.show', ['customer' => 2]));
        $response
            ->assertStatus(404)
            ->assertJsonFragment([
                'message' => 'Not Found'
            ]);
    }

    public function testCheckIfStoreFunctionIsWorking()
    {
        $response = $this->postJson(route('customers.store'), [
            'name' => 'test_customer',
            'email' => 'email@test.com',
            'cpf' => '012.345.678-90'
        ]);

        $id = $response->json('id');
        $customer = Customer::find($id);
        $response
            ->assertStatus(201)
            ->assertJson($customer->toArray());
    }

    public function testCheckIfUpdateFunctionIsWorking()
    {
        $customer = factory(Customer::class)->create([
            'name' => 'test_customer',
            'email' => 'email@test.com',
            'cpf' => '012.345.678-90'
        ]);

        $response = $this->putJson(
            route('customers.update', ['customer' => $customer->id]),
            [
                'name' => 'test_update',
                'email' => 'email@testupdate.com',
                'cpf' => '000.000.000-00'
            ]
        );

        $id = $response->json('id');
        $customer = Customer::find($id);
        $response
            ->assertStatus(200)
            ->assertJson($customer->toArray())
            ->assertJsonFragment([
                'name' => 'test_update',
                'email' => 'email@testupdate.com',
                'cpf' => '000.000.000-00'
            ]);
    }

    public function testCheckIfDestroyFunctionIsWorking()
    {
        $customer = factory(Customer::class)->create();

        $response = $this->delete(
            route('customers.destroy', ['customer' => $customer->id])
        );

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted Successfully'
            ]);

        $response = $this->delete(
            route('customers.destroy', ['customer' => $customer->id])
        );

        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Not Found'
            ]);
    }

}
