<?php
namespace Crawler\Content;

class WebContentPageBuilder extends WebContentBuilder {

    public function __construct()
    {
        $this->buildObject = new WebContentPage();
        $this->buildObject->setBasePath(dirname(dirname(dirname(dirname(__FILE__)))) . "/var/cache/");
        parent::__construct();
    }
}