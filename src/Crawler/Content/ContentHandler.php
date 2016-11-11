<?php
namespace Crawler\Content;

/**
 * Class ContentHandler
 * @package Crawler\Content
 */
class ContentHandler{

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $html;

    public function __construct( $url )
    {
        $this->setUrl($url);
    }

    protected function downloadContent(){

    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param string $html
     */
    public function setHtml($html)
    {
        $this->html = $html;
    }

}