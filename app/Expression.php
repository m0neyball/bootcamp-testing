<?php

namespace App;

class Expression
{
    public static function make()
    {
        return new static;
    }

    public function find($value)
    {
        return '/'.$value .'/';
    }

    public function then($value)
    {
        return $this->find($value);
    }

    public function anything()
    {
        return '/' . '.*' . '/';
    }

    public function maybe($value)
    {
        return '/('.$value.')?/';
    }
}