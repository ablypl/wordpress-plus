<?php

namespace App\Support;

use App\Post;
use App\Support\UrlGenerator\CategoryUrlGenerator;
use App\Support\UrlGenerator\PostUrlGenerator;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class PostFormatter
{
    /**
     * @var Post
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
     * @param $size
     * @param $callback
     * @return mixed
     */
    public function remember($size, $callback)
    {
        $cache = app("Illuminate\\Contracts\\Cache\\Repository");

        return $cache->remember($this->post->getCacheKey().'.formatted.'.$size, env('CACHE_DURATION_IN_MINUTES', 60), $callback);
    }

    /**
     * @param $post
     * @return mixed
     */
    public static function format($post, $size = null)
    {
        $formatter = new static($post);

        return $formatter->get($size);
    }

    /**
     * @param string $size
     * @return mixed
     */
    public function get($size = null)
    {
        $size = $size ?: 'content';
        $methodName = "get".ucfirst($size)."Size";

        return $this->{$methodName}();
    }

    /**
     * @return mixed
     */
    public function getContentSize()
    {
        return $this->remember('content', function () {
            return collect([
                'title'         => $this->post->title,
                'category'      => [
                    'name' => $this->post->taxonomies->first()->name,
                    'url'  => (new CategoryUrlGenerator($this->post->taxonomies()->first()))->get()
                ],
                'photo'         => [
                    'small'     => $this->post->getThumbnailSize('menu-thumbnail'),
                    'thumbnail' => $this->post->getThumbnailSize(),
                ],
                'comment_count' => $this->post->comment_count,
                'author'        => AuthorFormatter::format($this->post->author),
                'url'           => PostUrlGenerator::getUrl($this->post)
            ]);
        });
    }

    /**
     *
     */
    public function getItemSize()
    {
        return $this->remember('item', function () {
            return collect([
                'title'  => $this->post->title,
                'ID'  => $this->post->ID,
                'author' => $this->post->author->display_name,
                'url'    => PostUrlGenerator::getUrl($this->post),
                'diffForHuman' => $this->post->created_at->diffForHumans(),
                'views' => $this->post->meta->views
            ]);
        });
    }

    /**
     *
     */
    public function getSingleSize()
    {
        return $this->remember($size, function () {
            return collect([
                'title'         => $this->post->title,
                'excerpt'       => $this->post->excerpt,
                'content'       => $this->post->content,
                'categories'    => [
                    [
                        'name' => $this->post->taxonomies->first()->name,
                        'url'  => (new CategoryUrlGenerator($this->post->taxonomies()->first()))->get()
                    ]
                ],
                'photo'         => [
                    'thumbnail' => $this->post->getThumbnailSize(),
                    'main' => $this->post->getThumbnailSize('main'),
                ],
                'comment_count' => $this->post->comment_count,
                'author'        => AuthorFormatter::format($this->post->author),
                'url'           => PostUrlGenerator::getUrl($this->post)
            ]);
        });
    }

}