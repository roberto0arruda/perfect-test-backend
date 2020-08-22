<?php

namespace Tests\Unit;

use App\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testCheckIfProductFieldsIsCorrect()
    {
        $product = new Product;

        $expected = ['name', 'description', 'price'];

        $arrayCompared = array_diff($expected, $product->getFillable());

        $this->assertCount(0, $arrayCompared);
    }
}
