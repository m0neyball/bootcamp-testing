<?php

class BladeDirective
{
    /**
     * @var RussianCache
     */
    private $cache;

    public function __construct (RussianCache $cache)
    {
        $this->cache = $cache;
    }

    public function setUp ($key)
    {
            $this->cache->has($key);
    }
}