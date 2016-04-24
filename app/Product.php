<?php
namespace App;

class Product
{
    protected $name;

    protected $cost;

    /**
     * Product constructor.
     *
     * @param $name
     */
    public function __construct ($name, $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
    }

    /**
     * @return mixed
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCost ()
    {
        return $this->cost;
    }
}