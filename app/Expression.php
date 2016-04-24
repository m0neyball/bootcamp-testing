<?php

namespace App;

class Expression
{
    protected $expression = '';

    public static function make()
    {
        return new static;
    }

    public function find($value)
    {
        return $this->add($this->sanitize($value));
    }

    public function then($value)
    {
        return $this->find($value);
    }

    public function anything()
    {
        return $this->add('.*');
    }

    public function maybe($value)
    {
        $value = $this->sanitize($value);

        return $this->add("(?:$value)?");
    }

    protected function add($value)
    {
        $this->expression .= $value;

        return $this;
    }

    protected function sanitize($value)
    {
        return preg_quote($value, '/');
    }

    public function test($value) : bool
    {
        return (bool) preg_match($this->getRegex(), $value);
    }

    public function getRegex()
    {
        return '/'. $this->expression .'/';
    }

    public function __toString()
    {
        return $this->getRegex();
    }

}