<?php

namespace App\Support\UrlGenerator;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class CategoryUrlGenerator
{
    const URL = '/category/%s';
    protected $slug;

    /**
     */
    public function __construct($category)
    {
        $this->slug = $category->slug;
    }

    public function get()
    {
        return sprintf(static::URL, $this->slug);
    }
}