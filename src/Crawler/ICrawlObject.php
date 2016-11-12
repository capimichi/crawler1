<?php
namespace Crawler;

/**
 * Interface ICrawlObject
 * @package Crawler
 */
interface ICrawlObject
{

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @param string $url
     * @return void
     */
    public function setUrl($url);

    /**
     * @return string
     */
    public function getHtml();

    /**
     * @return \DOMXPath
     */
    public function getXpath();
}