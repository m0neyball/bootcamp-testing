<?php

namespace App;

class Expression
{
    protected $exporession = '';

    public static function make()
    {
        return new static;
    }

    public function find($value)
    {
        $this->exporession .= $value;

        return $this;
    }

    public function then($value)
    {
        return $this->find($value);
    }

    public function anything()
    {
        $this->exporession .= '.*';

        return $this;
    }

    public function maybe($value)
    {
        $this->exporession .= '('.$value.')?';

        return $this;
    }

}