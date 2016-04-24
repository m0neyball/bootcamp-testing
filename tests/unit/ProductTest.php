<?php
use App\Product;

class ProductTest extends TestCase
{
    protected $product;

    public function setUp ()
    {
        $this->product = new Product('Fallout 4', 59);
    }

    /**
     * @test
     */
    public function aProductHasName ()
    {
        $this->assertEquals ('Fallout 4', $this->product->name ());
    }

    public function testAProductHasCost ()
    {
        $this->assertEquals (59, $this->product->cost ());
    }
}