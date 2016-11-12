<?php
namespace Crawler\Content\FileSystem;

class CacheSystemHandler extends FileSystemHandler {

    public function __construct($url, $basePath = null)
    {
        $this->url = $url;
        if($basePath == null){
            $basePath = dirname(dirname(dirname(dirname(__FILE__)))) . "/var/cache/";
        }
        $this->basePath = $basePath;
    }



}