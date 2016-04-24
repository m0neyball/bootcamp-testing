<?php

namespace App;

class Expression
{
    protected $expression = '';

    public static function make() : Expression
    {
        return new static;
    }

    public function find(string $value):Expression
    {
        return $this->add($this->sanitize($value));
    }

    public function then(string $value) : Expression
    {
        return $this->find($value);
    }

    public function anything() : Expression
    {
        return $this->add('.*');
    }

    public function anythingBut(string $value) : Expression
    {
        $value = $this->sanitize($value);

        return $this->add("(?!$value).*?");
    }

    public function maybe(string $value) : Expression
    {
        $value = $this->sanitize($value);

        return $this->add("(?:$value)?");
    }

    protected function add($value) : Expression
    {
        $this->expression .= $value;

        return $this;
    }

    protected function sanitize(string $value) : string
    {
        return preg_quote($value, '/');
    }

    public function test($value) : bool
    {
        return (bool) preg_match($this->getRegex(), $value);
    }

    /**
     * @return string
     */
    public function getRegex() : string
    {
        return '/'. $this->expression .'/';
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->getRegex();
    }

}