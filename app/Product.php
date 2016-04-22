<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2016/4/20
 * Time: 上午10:49
 */

namespace App;


class Product
{
    protected $name;
    protected $cost;

    public function __construct($name, $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
    }

    public function name()
    {
        return $this->name;
    }

    public function cost()
    {
        return $this->cost;
    }
}