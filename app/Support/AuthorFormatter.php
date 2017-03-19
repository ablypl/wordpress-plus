<?php

namespace App\Support;


/**
 * @author    Sebastian Szczepański
 * @copyright Fitatu Sp. z o.o.
 */
class AuthorFormatter
{
    private $author;

    /**
     */
    public function __construct($author)
    {
        $this->author = $author;
    }

    public function get()
    {
        return [
            'name'  => $this->author->display_name,
            'photo' => $this->author->getAvatar(),
            'url'   => $this->author->url,
        ];
    }

    public static function format($post)
    {
        $formatter = new static($post);

        return $formatter->get();
    }
}