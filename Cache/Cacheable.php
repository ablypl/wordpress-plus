<?php

namespace App\Cache;


trait Cacheable
{
    /**
     * Get unique cache key for model
     * Format: App\User/1-213123213123
     * @return string
     */
    public function getCacheKey()
    {
        return sprintf("%s/%s-%s",
            get_class($this),
            $this->ID,
            $this->post_modified->timestamp
        );
    }
}