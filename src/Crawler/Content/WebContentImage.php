<?php
namespace Crawler\Content;

use Crawler\Content\FileSystem\ImagesSystemHandler;

class WebContentImage extends WebContent implements IWebContentImage {


    /**
     * WebContentImage constructor.
     * @param string $url
     * @param ImagesSystemHandler $imagesSystemHandler
     */
    public function __construct($url, $imagesSystemHandler)
    {
        $this->setFileSystemHandler(new ImagesSystemHandler());
        parent::__construct($url);
    }

    /**
     * @var \DOMDocument
     */
    protected $domDocument;

    /**
     * @var \DOMXPath
     */
    protected $domXpath;
}