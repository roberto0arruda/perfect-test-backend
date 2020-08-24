<?php

namespace Tests\Unit;

use App\Sale;
use PHPUnit\Framework\TestCase;

class SaleTest extends TestCase
{
    public function testCheckIfSaleColumnsIsCorrect()
    {
        $sale = new Sale;

        $expected = [
            'product_id',
            'customer_id',
            'date',
            'quantity',
            'discount',
            'status'
        ];

        $arrayCompared = array_diff($expected, $sale->getFillable());

        $this->assertCount(0, $arrayCompared);
    }
}
