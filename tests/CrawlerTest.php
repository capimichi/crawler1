<?php
include_once "vendor/autoload.php";

use Crawler\CrawlerBuilder;
use Crawler\Selector;
use Crawler\SelectorTypes;
use Crawler\Single\Fields\FieldBuilder;
use Crawler\Single\Fields\FieldTypes;

class CrawlerTest extends PHPUnit_Framework_TestCase
{

    public function testCrawler(){

        $crawlerBuilder = (new CrawlerBuilder())->addStartingUrl("http://magento2.magentiamo.it/collections/erin-recommends.html")
            ->addItemSelector(new Selector(SelectorTypes::CLASSNAME, "product-item-info"))
            ->addItemSelector(new Selector(SelectorTypes::CLASSNAME, "product"))
            ->addNextpageSelector(new Selector(SelectorTypes::CLASSNAME, "pages-items"))
            ->addNextpageSelector(new Selector(SelectorTypes::CLASSNAME, "next"));
         $field = (new FieldBuilder(FieldTypes::STRING))->setName("title")
            ->setMultiple(false)
            ->addSelector(new Selector(SelectorTypes::TAGNAME, "h1"))->build();
        $crawlerBuilder->addField($field);
        $crawler = $crawlerBuilder->build();
        $archives = $crawler->getArchives();
        $items = $crawler->getItems();
        $this->assertEquals(3, count($archives), "Testing archvies number");
        $this->assertEquals(22, count($items), "Testing items number");
    }
}

