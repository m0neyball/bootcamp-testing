<?php
use App\Product;
use App\Order;
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2016/4/20
 * Time: 下午1:18
 */



class OrderTest extends PHPUnit_Framework_TestCase
{
    protected $order;
    
    public function setUp()
    {
        $this->order = $this->createOrderWithProducts();

    }
    
    /** @test */
    function an_order_consists_of_products()
    {
       

        $this->assertCount(2, $this->order->products());
    }
    /** @test */
    function an_order_can_determine_the_total_cost_of_all_its_products()
    {
       

        $this->assertEquals(66, $this->order->total());

    }

    protected function createOrderWithProducts()
    {
        $order =new Order;

        $product = new Product('Fallout 4', 59);
        $product2 = new Product('Pillowcase', 7);

        $order->add($product);
        $order->add($product2);

        return $order;
    }
}