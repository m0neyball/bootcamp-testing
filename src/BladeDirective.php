<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2016/4/22
 * Time: 下午5:26
 */

class BladeDirective
{
    protected $cache;
    
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
        if (is_object($item) && method_exists($item, 'getCacheKey'))
        {
            return $item->getCacheKey();
        }

        return $item;
    }
}