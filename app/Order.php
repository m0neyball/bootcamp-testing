<?php
namespace App;

class Order
{
    protected $products = [];

    /**
     * @param Product $product
     */
    public function add (Product $product)
    {
        $this->products[] = $product;
    }

    /**
     *
     */
    public function products ()
    {
        return $this->products;
    }
}