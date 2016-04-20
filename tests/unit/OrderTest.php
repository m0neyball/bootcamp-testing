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
    /** @test */
    function an_order_consists_of_products()
    {
        $order =new Order;

        $product = new Product('Fallout 4', 59);
        $product2 = new Product('Pillowcase', 7);

        $order->add($product);
        $order->add($product2);

        $this->assertCount(2, $order->products());
    }
}