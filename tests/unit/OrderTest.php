<?php
use App\Order;
use App\Product;

class OrderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Order
     */
    protected $order;

    public function setUp ()
    {
        $this->order = new Order();
        $product = new Product('Fallout 4', 59);
        $product2 = new Product('Pillowcase', 7);
        $this->order->add($product);
        $this->order->add($product2);
    }
    /**
     * @test order consists of products
     */
    public function an_order_consists_of_products ()
    {
        $this->assertCount(2, $this->order->products());
    }

    /**
     * @test an order can determine the_total cost of all its products
     */
    public function an_order_can_determine_the_total_cost_of_all_its_products ()
    {
        $this->assertEquals(66, $this->order->total());
    }

}