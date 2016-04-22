<?php

class ExpressionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_finds_a_string ()
    {
        $regex = Expression::make ()->find ('www');
        $this->assertRegExp ($regex, 'www');

        $regex = Expression::make ()->then ('www');
        $this->assertRegExp ($regex, 'www');
    }

    /**
     * @test
     */
    public function it_checks_for_anything ()
    {
        $regex = Expression::make ()->anything ();
        $this->assertRegExp ($regex, 'foo');
    }
}