<?php

namespace Tests\Feature;

use App\Customer;
use Exception;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModelCustomerTest extends TestCase
{
    use DatabaseMigrations;

    public function testCheckIfTheCustomerListingIsWorking()
    {
        factory(Customer::class, 2)->create();

        $customers = Customer::all();

        $this->assertCount(2, $customers);

        $customerKey = array_keys($customers->first()->getAttributes());
        $this->assertEqualsCanonicalizing(
            [
                'id',
                'name',
                'email',
                'cpf',
                'created_at',
                'updated_at',
            ],
            $customerKey
        );
    }

    public function testCheckIfCreatingCustomerIsWorking()
    {
        $customer = factory(Customer::class)->create([
            'name' => 'test',
            'email' => 'customer@test.com',
            'cpf' => '123.456.789-11'
        ]);

        $this->assertEquals('test', $customer->name);
        $this->assertEquals('customer@test.com', $customer->email);
        $this->assertEquals('123.456.789-11', $customer->cpf);
    }

    public function testCheckIfUpdateCustomerIsWorking()
    {
        $customer = factory(Customer::class)->create();

        $data = [
            'name' => 'test_updated',
            'email' => 'updated@test.com',
            'cpf' => '012.345.678-90'
        ];

        $customer->update($data);

        foreach ($data as $key => $value) {
            $this->assertEquals($value, $customer->{$key});
        }
    }

    /** @test
     * @throws Exception
     */
    public function testCheckIfDeletingCustomerIsWorking()
    {
        /** @var Customer $product */
        $customer = factory(Customer::class)->create();
        $customer->delete();

        $this->assertNull(Customer::find($customer->id));
    }
}
