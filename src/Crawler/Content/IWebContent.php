<?php
namespace Crawler\Content;

/**
 * Interface IWebContentHandler
 * @package Crawler\Content
 */
interface IWebContent
{

    /**
     * @return string
     */
    public function getContent();

    /**
     * @return string
     */
    public function getUrl();

}