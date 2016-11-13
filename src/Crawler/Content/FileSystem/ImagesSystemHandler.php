<?php
namespace Crawler\Content\FileSystem;

class ImagesSystemHandler extends FileSystemHandler {

    public function __construct($url, $basePath = null)
    {
        $urlParsed = parse_url($url);
        $url = $urlParsed['scheme'] . "://" . $urlParsed['host'] . $urlParsed['path'];
        $this->url = $url;
        if($basePath == null){
            $basePath = dirname(dirname(dirname(dirname(__FILE__)))) . "/var/images/";
        }
        $this->basePath = $basePath;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->getUrl());
        $file = mb_ereg_replace("([\.]{2,})", '', $file);
        $file = $file;
        return $file;
    }


}