<?php

class Expression
{
    protected $expression ='';

    public static function make()
    {
        return new static;
    }

    public function find($value)
    {
        $this->expression .= $value;

        return $this;
    }

    public function then($value)
    {
        return $this->find($value);
    }

    public function anything()
    {
        $this->expression .= '.*';

        return $this;
    }

    public function maybe($value)
    {

        return '/('.$value.')?/';

        $this->expression .= '('.$value.')?';

        return $this;
    }

    public function test($value)
    {
        return (bool)preg_match($this->__toString(), $value);
    }

    public function __toString()
    {
        return '/' . $this->expression . '/';
    }
}