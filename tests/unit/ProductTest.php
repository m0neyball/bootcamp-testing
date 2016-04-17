<?php
use App\Product;

class ProductTest extends PHPUnit_Framework_TestCase
{
    public function testAProductHasName ()
    {
        $product = new Product('Fallout 4', 59);

        $this->assertEquals('Fallout 4', $product->getName());
    }

    public function testAProductHasCost ()
    {
        $product = new Product('Fallout 4', 59);

        $this->assertEquals(59, $product->getCost());
    }
}