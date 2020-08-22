<?php

namespace Tests\Unit;

use App\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function testCheckIfCustomerFieldsIsCorrect()
    {
        $customer = new Customer;

        $expected = ['name', 'email', 'cpf'];

        $arrayCompared = array_diff($expected, $customer->getFillable());

        $this->assertCount(0, $arrayCompared);
    }
}
