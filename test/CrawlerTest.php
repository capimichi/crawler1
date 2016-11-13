<?php
include_once "../vendor/autoload.php";

use Crawler\Crawler;
use Crawler\Selector;
use Crawler\SelectorTypes;
use Crawler\Single\Fields\FieldString;

class CrawlerTest extends \PHPUnit_Framework_TestCase
{
    public function testCanGetArchive(){

        $crawler = new Crawler(array(
            "http://shop.bridalsbylori.com/allure-couture-bridals/?sort=newest"
        ), array(
            new Selector(SelectorTypes::CLASSNAME, "ProductImage"),
            new Selector(SelectorTypes::TAGNAME, "a"),
        ), array(
            new Selector(SelectorTypes::CLASSNAME, "nav-next")
        ), array(
           new FieldString("title", "false", array(
                new Selector(SelectorTypes::TAGNAME, "h1")
           ))
        ));
        $this->assertGreaterThan(count($crawler->getArchives(array())), 0);
    }
}

