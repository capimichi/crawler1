<?php
namespace Crawler\Content\Web;

use Crawler\Content\FileSystem\ImagesSystemHandler;

class WebContentImage extends WebContent
{


    /**
     * WebContentImage constructor.
     * @param string $url
     */
    public function __construct($url)
    {
        $this->setFileSystemHandler(new ImagesSystemHandler($url));
        parent::__construct($url);
    }

    /**
     * @return string
     */
    public function getContent(){
        if(!isset($this->content)){
            $fileSystemHandler = new ImagesSystemHandler($this->getUrl());
            if($fileSystemHandler->isFileDownloaded()){
                $content = $this->fetchCachedContent($fileSystemHandler->getFilePath());
            } else {
                $content = $this->downloadContent();
                $fileSystemHandler->saveContent($content);
            }
            $this->setContent($content);
        }
        return $this->content;
    }

}