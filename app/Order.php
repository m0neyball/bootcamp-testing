<?php
namespace App;

class Order
{
    protected $products = [];

    public function add ($product)
    {
        $this->products[] = $product;
    }
}