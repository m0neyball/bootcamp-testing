<?php

use App\RussianCache;
use App\BladeDirective;

class DemoTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_normalizes_a_string_for_the_cache_key()
    {
        $cache = $this->prophesize(RussianCache::class);
        $directive = new BladeDirective($cache->reveal());

        $cache->has('cache-key')->shouldBeCalled();

        $directive->setUp('cache-key');
    }
}