<?php

class Expression
{
    protected $expression ='';

    public static function make()
    {
        return new static;
    }

    protected function sanitize($value)
    {
        return $value = preg_quote($value, '/');
    }

    protected function add($value)
    {
        $this->expression .= $value;

        return $this;
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

    public function anythingBut($value)
    {
        $value = $this->sanitize($value);

        $this->expression .=  "(?!$value).*?";
        
        return $this;
    }

    public function maybe($value)
    {
        $value =  $this->sanitize($value);

        return $this->add("($value)?");
    }

    public function test($value)
    {
//        var_dump($this->getRegex());
        return (bool) preg_match($this->__toString(), $value);
    }

    public function getRegex()
    {
        return '/' . $this->expression . '/';
    }

    public function __toString()
    {
        return $this->getRegex();
    }
}