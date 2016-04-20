<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2016/4/20
 * Time: 下午1:39
 */

namespace App;


class Order
{
    protected $products = [];

    public function add(Product $product)
    {
        $this->products[] = $product;
    }

    public function products()
    {
        return $this->products;
    }

    public function total()
    {
       return array_reduce($this->products, function($carry, $product){
           return $carry + $product->cost();
       });
    }
}