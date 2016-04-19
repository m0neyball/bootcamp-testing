<?php
use App\Product;
use App\Order;

class OrderTest extends TestCase
{
    /**
     * @test
     */
    public function an_order_consists_of_products ()
    {
        $order = new Order();
        $product1 = new Product('Fallout 4', 59);
        $product2 = new Product('Pillowcase', 7);
        $order->add ($product1);
        $order->add ($product2);
        // $this->assertEquals (2, count ($order->products ()));
        $this->assertCount (2, $order->products ());
    }

    /**
     * @test
     */
    public function an_order_can_determine_the_total_cost_of_all_its_products ()
    {
        $order = new Order();
        $product1 = new Product('Fallout 4', 59);
        $product2 = new Product('Pillowcase', 7);
        $order->add ($product1);
        $order->add ($product2);
        $this->assertEquals (66, $order->total ());
    }
}