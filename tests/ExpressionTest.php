<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExpressionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_finds_a_string()
    {
        $regex =  Expression::make()->find('www');

        $this->assertTrue($regex->test('www'));

        $regex =  Expression::make()->then('www');

        $this->assertTrue($regex->test('www'));
    }

    /**
     * @test
     */
    public function it_checks_for_anything()
    {
        $regex =  Expression::make()->anything();

//        $this->assertTrue(!!preg_match($regex, 'foo'));
        $this->assertTrue($regex->test('foo'));
    }

    /**
     * @test
     */
    public function it_maybe_has_a_value()
    {
        $regex =  Expression::make()->maybe('http');

        $this->assertTrue($regex->test('http'));
        $this->assertTrue($regex->test(''));
    }

    /**
     * @test
     */
    public function it_can_chain_method_calls()
    {
        $regex =  Expression::make()->find('www')->maybe('.')->then('laracasts');

        $this->assertTrue($regex->test('www.laracasts'));
        $this->assertFalse($regex->test('wwwXlaracasts'));
    }
}
