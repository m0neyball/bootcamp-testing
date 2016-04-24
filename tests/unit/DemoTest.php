<?php

class DemoTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function test_something()
    {
        $directive = $this->prophesize(BladeDirective::class);

        $directive->foo('bar')->shouldBeCalled()->willReturn('foobar');

        $response = $directive->reveal()->foo('bar');

        $this->assertEquals('foobar', $response);
    }
}

class BladeDirective
{
    public function foo()
    {

    }
}