<?php
namespace Crawler\Content;

class WebContentImage extends WebContent
{

    /**
     * WebContentImage constructor.
     * @param string $url
     */
    public function __construct($url, $basePath = null)
    {
        if($basePath == null){
            $basePath = dirname(dirname(dirname(dirname(__FILE__)))) . "/var/images/";
        }
        parent::__construct($url, $basePath);
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->getUrl());
        $file = mb_ereg_replace("([\.]{2,})", '', $file);
        $file = $file . $this->getExtension();
        return $file;
    }


    /**
     * @return string
     */
    public function getExtension(){
        $extension = ".jpg";
        $extensions = array(
            ".png",
            ".jpg",
            ".jpeg",
            ".gif",
            ".bmp"
        );
        $foundExtension = false;
        $i = 0;
        while(!$foundExtension && $i < count($extensions)) {
            if (strpos($this->getUrl(), $extensions[$i]) !== false) {
                $foundExtension = true;
            } else {
                $i++;
            }
        }
        if($foundExtension){
            $extension = $extensions[$i];
        }
        return $extension;
    }

}