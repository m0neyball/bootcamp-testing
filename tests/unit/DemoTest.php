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

    /**
     * @test it normalizes a cacheable model for the cache key
     */
    public function it_normalizes_a_cacheable_model_for_the_cache_key()
    {
        $cache = $this->prophesize(RussianCache::class);
        $directive = new BladeDirective($cache->reveal());

        $cache->has('stub-cache-key')->shouldBeCalled();

        $directive->setUp(new ModelStub);

    }

    /**
     * @test it normalizes an array for the cache key
     */
    public function it_normalizes_an_array_for_the_cache_key()
    {
        $cache = $this->prophesize(RussianCache::class);
        $directive = new BladeDirective($cache->reveal());

        $item = ['foo', 'bar'];
        $cache->has(md5('foobar'))->shouldBeCalled();

        $directive->setUp($item);

    }
}

class ModelStub
{
    public function getCacheKey()
    {
        return 'stub-cache-key';
    }
}