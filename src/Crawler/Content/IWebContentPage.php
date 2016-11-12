<?php
namespace Crawler\Content;

interface IWebContentPage extends IWebContent {


    /**
     * @return \DOMDocument
     */
    public function getDomDocument();

    /**
     * @return \DOMXPath
     */
    public function getDomXpath();
}