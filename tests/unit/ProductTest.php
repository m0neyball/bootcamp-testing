<?php
use App\Product;

class ProductTest extends PHPUnit_Framework_TestCase
{
    public function testAProductHasName ()
    {
        $product = new Product('Fallout 4');

        $this->assertEquals('Fallout 4', $product->name());
    }
}