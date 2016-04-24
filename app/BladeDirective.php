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
        $this->cache->has(
            $this->normalizeKey($key)
        );
    }

    protected function normalizeKey($item)
    {
        if (is_object($item) && method_exists($item, 'getCacheKey')) {
            return $item->getCacheKey();
        }

        return $item;
    }
}