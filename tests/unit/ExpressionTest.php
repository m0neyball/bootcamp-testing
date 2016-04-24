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
        $this->assertTrue($regex->test('www'));

        $regex = Expression::make()->then('www');
        $this->assertTrue($regex->test('www'));
    }

    /**
     * @test it checks for anything
     */
    public function it_checks_for_anything()
    {
        $regex = Expression::make()->anything();

        $this->assertTrue($regex->test('foo'));
    }

    /**
     * @test it maybe has a value
     */
    public function it_maybe_has_a_value()
    {
        $regex = Expression::make()->maybe('http');

        $this->assertTrue($regex->test('http'));
        $this->assertTrue($regex->test(''));
    }

    /**
     * @test it can chain method calls
     */
    public function it_can_chain_method_calls()
    {
        $regex = Expression::make()->find('www')->maybe('.')->then('larcasts');

        $this->assertTrue($regex->test('www.larcasts'));
        $this->assertFalse($regex->test('wwwXlarcasts'));
    }
}