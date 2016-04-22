<?php

class Expression
{
    protected $expression = '';

    public static function make ()
    {
        return new static;
    }

    public function find ($value)
    {
        $value = $this->sanitize($value);
        // return '/' . $value . '/';
        $this->expression .= $value;

        return $this;
    }

    public function then ($value)
    {
        return $this->find ($value);
    }

    public function anything ()
    {
        // return '/' . '.*' . '/';
        $this->expression .= '.*';

        return $this;
    }

    public function maybe ($value)
    {
        $value = $this->sanitize($value);
        // return '/(' . $value . ')?/';
        $this->expression .= '(' . $value . ')?';

        return $this;
    }

    protected function sanitize ($value)
    {
        return preg_quote ($value, '/');
    }

    public function test ($value)
    {
        // var_dump($this->__toString());
        return (bool) preg_match ($this->getRegex (), $value);
    }

    public function getRegex ()
    {
        return '/' . $this->expression . '/';
    }

    public function __toString ()
    {
        return $this->getRegex ();
    }
}