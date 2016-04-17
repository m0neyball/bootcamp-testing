<?php
use App\Product;

class ProductTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Product
     */
    protected $product;

    public function setUp ()
    {
        $this->product = new Product('Fallout 4', 59);
    }

    /**
     * @test product has name
     */
    public function a_product_has_name ()
    {
        $this->assertEquals('Fallout 4', $this->product->getName());
    }

    /**
     * @test product has cost
     */
    public function a_product_has_cost ()
    {
        $this->assertEquals(59, $this->product->getCost());
    }
}