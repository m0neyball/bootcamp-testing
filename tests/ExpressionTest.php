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

        $this->assertRegExp($regex, 'www');

        $regex =  Expression::make()->then('www');

        $this->assertRegExp($regex, 'www');
    }

    /**
     * @test
     */
    public function it_checks_for_anything()
    {
        $regex =  Expression::make()->anything();

        $this->assertRegExp($regex, 'foo');

    }

    /**
     * @test
     */
    public function it_maybe_has_a_value()
    {
        $regex =  Expression::make()->maybe('http');

        $this->assertRegExp($regex, 'http');
    }

    public function it_can_chain_method_calls()
    {
        $regex =  Expression::make()->find('foo')->maybe('bar')->then('biz');

        $this->assertRegExp($regex, 'boobarbiz');
    }
}
