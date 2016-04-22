<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2016/4/22
 * Time: 下午5:03
 */
class ProphecyExampleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function test_something()
    {
        $directive = $this->prophesize(BaldeDirective::class);

        $directive->foo()->shouldBeCalled();

    }
}