<?php

class Expression
{
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
}