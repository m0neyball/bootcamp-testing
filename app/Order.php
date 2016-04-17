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

    public function total ()
    {
        return array_reduce($this->products, function ($carry, $product) {
            return $carry += $product->getCost();
        });

    }
}