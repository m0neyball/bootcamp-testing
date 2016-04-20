<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2016/4/20
 * Time: 上午10:28
 */
use App\Product;

class ProductTest extends PHPUnit_Framework_TestCase
{
    protected $product;

    public function setUp()
    {
        $this->product = new Product('Fallout 4', 59);
    }
    /** @test */
    function a_product_has_a_name()
    {
//        $product = new Product('Fallout 4', 59);

        $this->assertEquals('Fallout 4', $this->product->name());
    }
    /** @test */
    function a_product_has_a_cost()
    {
//        $product = new Product('Fallout 4', 59);

        $this->assertEquals('59', $this->product->cost());
    }
}