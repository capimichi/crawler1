# Crawler
This is a super easy and fast configurable crawler.

## Introduction
It is based on two main objects:

* Archive (the page containg the list of produts, and the pagination links)
* Single (the page containing the single product, with ipotetical title, image and all fields you need)

## Getting started
The crawler is very fast to use, all you need is to include autoload.php file:
```
include_once '/path/to/src/autoload.php'
```
then you can create your crawler like this:
```
$crawler = new Crawler(array(
    "http://www.example.com/category1",
    "http://www.example.com/category2",
    "http://www.example.com/categoryN"
), array(
    new Selector(SelectorTypes::CLASSNAME, "ProductImage"),
    new Selector(SelectorTypes::TAGNAME, "a"),
), array(
    new Selector(SelectorTypes::CLASSNAME, "nav-next")
), array(
    new FieldString("title", false, array(
        new Selector(SelectorTypes::TAGNAME, "h1")
    )),
    new FieldImage("image", false, array(
        new Selector(SelectorTypes::CLASSNAME, "ProductThumbImage"),
        new Selector(SelectorTypes::TAGNAME, "img")
    ))
));
```
Here the explanation of the code: <br>
Crawler class constructor accepts 4 arguments:
1. Array of starting urls
2. Array of selectors objects creating the xpath to the products url in archive, for example, if archive contains products like this: <br>```<div class="product"><a href="url/to/product">My special product</a></div>```<br>the argument would be: <br>```array( new Selector(SelectorTypes::CLASSNAME, "product"), new Selector(SelectorTypes::TAGNAME, "a"))```
3. Selectors objects creating the xpath to the archive next page url, se above example
4. Array of fields for the single products