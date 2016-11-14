<?php
namespace Crawler\Single\Fields;

/**
 * Class Rewrite
 * @package Crawler\Single\Fields
 */
class Rewrite{
    /**
     * @var string
     */
    protected $search;

    /**
     * @var string
     */
    protected $replace;

    /**
     * Rewrite constructor.
     * @param $search
     * @param $replace
     */
    public function __construct($search, $replace)
    {
        $this->setSearch($search);
        $this->setReplace($replace);
    }

    /**
     * @return mixed
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @return mixed
     */
    public function getReplace()
    {
        return $this->replace;
    }

    /**
     * @param mixed $search
     */
    protected function setSearch($search)
    {
        $this->search = $search;
    }

    /**
     * @param mixed $replace
     */
    protected function setReplace($replace)
    {
        $this->replace = $replace;
    }


}