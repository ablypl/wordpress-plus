<?php
namespace App\Support\UrlGenerator;
/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class PostUrlGenerator extends AbstractUrlGenerator implements UrlGeneratorInterface
{
    /**
     *
     */
    const URL = "/%s";
    /**
     * @var
     */
    private $post;

    /**
     * @param $post
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * @return string
     */
    public function get()
    {
        return sprintf(static::URL, $this->post->slug);
    }
}