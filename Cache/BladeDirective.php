<?php

namespace App\Cache;

class BladeDirective
{
    /**
     * List of partials to be cached
     */
    protected $keys = [];

    /**
     * Lari\Cache\MLVCache
     */
    protected $cache;

    public function __construct(ViewCache $cache)
    {
        $this->cache = $cache;
    }
    /**
     *  Start output buffering
     * @param $key string/model
     * @return void
     */
    public function setup($key, $tag = null)
    {
        ob_start();

        $this->keys[] = $key = $this->cache->normalizeKey($key, $tag);

        return $this->cache->has($key);
    }
    /**
     * Display code fragment
     * @return response
     */
    public function flush()
    {
        return $this->cache->put(
            array_pop($this->keys), ob_get_clean()
        );
    }
}
