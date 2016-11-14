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
     * @var bool
     */
    protected $regex;

    /**
     * Rewrite constructor.
     * @param $search
     * @param $replace
     */
    public function __construct($search, $replace, $regex = false)
    {
        $this->setSearch($search);
        $this->setReplace($replace);
        $this->setRegex($regex);
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
     * @return boolean
     */
    public function isRegex()
    {
        return $this->regex;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function convertValue($value){
        if($this->isRegex()){
            return preg_replace($this->getSearch(), $this->getReplace(), $value);
        } else {
            return str_replace($this->getSearch(), $this->getReplace(), $value);
        }
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

    /**
     * @param boolean $regex
     */
    public function setRegex($regex)
    {
        $this->regex = $regex;
    }

}