<?php

namespace App;

class BladeDirective
{
    /**
     * @var RussianCache
     */
    private $cache;

    /**
     * BladeDirective constructor.
     *
     * @param RussianCache $cache
     */
    public function __construct(RussianCache $cache)
    {
        $this->cache = $cache;
    }

    public function setUp($key)
    {
        $this->cache->has($key);
    }
}