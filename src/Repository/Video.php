<?php

namespace VideoShare\Repository;

/**
 * Class Video
 * @package VideoShare\Repository
 */
class Video
{
    private $id;
    private $tags;
    private $title;
    private $url;

    /**
     * Video constructor.
     * @param $id
     * @param $tags
     * @param $title
     * @param $url
     */
    public function __construct($id, $tags, $title, $url)
    {
        $this->id = $id;
        $this->tags = $tags;
        $this->title = $title;
        $this->url = $url;
    }

    /**
     * @param $fields
     * @return Video
     */
    public static function getVideoInstance($fields)
    {
        return new self(
            !empty($fields['id']) ? $fields['id'] : null,
            !empty($fields['tags']) ? $fields['tags'] : null,
            !empty($fields['title']) ? $fields['title'] : null,
            $fields['url']
        );
    }

    public function __toString()
    {
        $title = $this->getTitle();
        $url = $this->getUrl();
        $tags = $this->getTags();
        $tags = !empty($tags) ? implode(',', $tags) : '';

        return "importing: \"$title\"; Url: $url; Tags: $tags";
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }
}
