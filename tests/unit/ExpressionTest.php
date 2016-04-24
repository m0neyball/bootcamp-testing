<?php

use App\Expression;

class ExpressionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test it finds a string
     */
    public function it_finds_a_string()
    {
        $regex = Expression::make()->find('www');
        $this->assertRegExp($regex, 'www');

        $regex = Expression::make()->then('www');
        $this->assertRegExp($regex, 'www');
    }

    /**
     * @test it checks for anything
     */
    public function it_checks_for_anything()
    {
        $regex = Expression::make()->anything();

        $this->assertRegExp($regex, 'foo');
    }

    /**
     * @test it maybe has a value
     */
    public function it_maybe_has_a_value()
    {
        $regex = Expression::make()->maybe('http');

        $this->assertRegExp($regex, 'http');
        $this->assertRegExp($regex, '');
    }

    /**
     * @test it can chain method calls
     */
    public function it_can_chain_method_calls()
    {
        $regex = Expression::make()->find('fod')->maybe('bar')->then('biz');

        $this->assertRegExp($regex, 'foobarbiz');
    }
}