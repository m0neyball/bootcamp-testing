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
    }
}
