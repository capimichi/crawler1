# Crawler
This is a super easy and fast configurable crawler.

## Introduction
It is based on two main objects:

* Archive (the page containg the list of produts, and the pagination links)
* Single (the page containing the single product, with ipotetical title, image and all fields you need)

## Installation

```sh
composer require capimichi/crawler
```

## Getting started
The crawler is very fast to use, all you need is to include autoload.php file:
```php
include_once '/path/to/src/autoload.php'
```
then you can create your crawler like this:
```php
use Crawler\CrawlerBuilder;
use Crawler\Selector;
use Crawler\SelectorTypes;
use Crawler\Single\Fields\FieldBuilder;
use Crawler\Single\Fields\FieldTypes;

$crawlerBuilder = (new CrawlerBuilder())->addStartingUrl("http://example-archive.com/products")
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
$export = array();
foreach($items as $item){
    array_push($export, $item->getExport());
}
```
Here the explanation of the code: <br>
CrawlerBuilder let you add starting urls to your crawler with method:
```php
addStartingUrl($url)
```
then you can add items selectors, in our example we ad an archive like this:
```html
<ul class="products">
    <li class="product-item-info"><a class="product" href="/url-to-item"></a>...</li>
    <li class="product-item-info"><a class="product" href="/url-to-item"></a>...</li>
    <li class="product-item-info"><a class="product" href="/url-to-item"></a>...</li>
</ul>
```
so we added these selectors:
```php
addItemSelector(new Selector(SelectorTypes::CLASSNAME, "product-item-info"))
addItemSelector(new Selector(SelectorTypes::CLASSNAME, "product"))
```
Our page had pagination like this:
```html
<ul class="pages-items">
    <li class="item"><a class="page" href="/url-to-item">1</a></li>
    <li class="item"><a class="page" href="/url-to-item">2</a></li>
    <li class="item"><a class="next" href="/url-to-item">Next page</a></li>
</ul>
```
so we added these selectors:
```php
addNextpageSelector(new Selector(SelectorTypes::CLASSNAME, "pages-items"))
addNextpageSelector(new Selector(SelectorTypes::CLASSNAME, "next")
```
<b>Note: The selectors order is important, and it should be as specific as possible</b>

Then our example had pages of single products like this:
```html
<div class="product">
    <h1>Title of our product</h1>
    <img src="/image.png">
</div> 
```
we liked to grab only the title of the product, so we added this field:
```php
$field = (new FieldBuilder(FieldTypes::STRING))->setName("title")
            ->setMultiple(false)
            ->addSelector(new Selector(SelectorTypes::TAGNAME, "h1"))->build();
$crawlerBuilder->addField($field);
```
Then we created the crawler with build method:
```php
$crawler = $crawlerBuilder->build();
```
and now we can get all needed informations:
```php
$archives = $crawler->getArchives();
$items = $crawler->getItems();
$export = array();
foreach($items as $item){
    array_push($export, $item->getExport());
}
```
