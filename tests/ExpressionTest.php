<?php

class ExpressionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_finds_a_string ()
    {
        $regex = Expression::make ()->find ('www');
        // $this->assertRegExp ((string) $regex, 'www');
        $this->assertTrue($regex->test('www'));
        $regex = Expression::make ()->then ('www');
        // $this->assertRegExp ((string) $regex, 'www');
        $this->assertTrue($regex->test('www'));
    }

    /**
     * @test
     */
    public function it_checks_for_anything ()
    {
        $regex = Expression::make ()->anything ();
        // $this->assertRegExp ($regex->__toString(), 'foo');
        // $this->assertTrue(!! preg_match($regex, 'foo'));
        $this->assertTrue ($regex->test ('foo'));
    }

    /**
     * @test
     */
    public function it_maybe_has_a_value ()
    {
        $regex = Expression::make ()->maybe ('http');
        // $this->assertRegExp ($regex, 'http');
        // $this->assertRegExp ($regex, '');
        $this->assertTrue ($regex->test ('http'));
        $this->assertTrue ($regex->test (''));
    }

    /**
     * @test
     */
    public function it_can_chain_method_calls ()
    {
        $regex = Expression::make ()->find ('www')->maybe ('.')->then ('moneyball');

        $this->assertTrue($regex->test('www.moneyball'));
        $this->assertFalse($regex->test('wwwXmoneyball'));
    }

    /**
     * @test
     */
    public function it_can_exclude_values ()
    {
        $regex = Expression::make ()
            ->find ('foo')
            ->anythingBut('bar')
            ->then('biz');

        $this->assertTrue($regex->test('foobazbiz'));
        $this->assertFalse($regex->test('foobarbiz'));
    }
}