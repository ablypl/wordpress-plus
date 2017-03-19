<?php

namespace App\Support\UrlGenerator;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class AbstractUrlGenerator
{
    /**
     * @param $item
     * @return string
     */
    public static function getUrl($item)
    {
        $url = new static($item);

        return $url->get();
    }
}