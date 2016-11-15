<?php
namespace Crawler\Content;

class WebContentImageBuilder extends WebContentBuilder {

    public function __construct()
    {
        $this->buildObject = new WebContentImage();
        $this->buildObject->setBasePath(dirname(dirname(dirname(dirname(__FILE__)))) . "/var/images/");
        parent::__construct();
    }
}