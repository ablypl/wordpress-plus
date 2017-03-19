<?php

namespace App\Cache;

use Illuminate\Contracts\Cache\Repository as Cache;

class ViewCache
{
    /**
     * Cache variable
     * @return void
     */
    protected $cache;

    protected $keys = [] ;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Cache code fragment
     * @return string
     */
    public function put($key, $code)
    {
        return $this->cache->tags('views')->rememberForever($key, function () use($code) {
            return $code;
        });
    }
    /**
     * Checks if there is cached fragment for given key
     * @return bool
     */
    public function has($key)
    {
        return $this->cache
            ->tags('views')
            ->has($key);
    }
    /**
     * Normalize cache key
     * @return string
     */
    public function normalizeKey($key, $tag = null)
    {
        // check if model was given
        if ($key instanceof \Illuminate\Database\Eloquent\Model) {
            $key = $key->getCacheKey();
        }
        $tag = !$tag ?: "_" . $tag;
        return $key . $tag;
    }

}
