<?php

namespace App\Support\UrlGenerator;


/**
 * @author    Sebastian Szczepański
 * @copyright Fitatu Sp. z o.o.
 */
class AuthorUrlGenerator extends AbstractUrlGenerator implements UrlGeneratorInterface
{
    /**
     *
     */
    const URL = "/author/%s";
    /**
     * @var
     */
    private $author;

    /**
     * @param $author
     */
    public function __construct($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function get()
    {
        return sprintf(static::URL, $this->author->slug);
    }
}