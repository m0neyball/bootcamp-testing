<?php
use App\Order;
use App\Product;

class OrderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test order consists of products
     */
    public function an_order_consists_of_products ()
    {
        $order = new Order();

        $product = new Product('Fallout 4', 59);
        $product2 = new Product('Pillowcase', 7);

        $order->add($product);
        $order->add($product2);

        $this->assertCount(2, $order->products());
    }

    /**
     * @test an order can determine the_total cost of all its products
     */
    public function an_order_can_determine_the_total_cost_of_all_its_products ()
    {
        $order = new Order();

        $product = new Product('Fallout 4', 59);
        $product2 = new Product('Pillowcase', 7);

        $order->add($product);
        $order->add($product2);

        $this->assertEquals(66, $order->total());
    }
}