<?php
namespace Crawler;

 class Crawler implements ICrawler {

     /**
      * ICrawler constructor.
      * @param array $startingUrls
      * @param array $itemsSelectors
      * @param array $nextpageSelectors
      * @param array $singleFieldsSelectors
      */
     public function __construct($startingUrls, $itemsSelectors, $nextpageSelectors, $singleFieldsSelectors)
     {

     }

     /**
      * @param array $options
      * @return array
      */
     public function getArchives($options)
     {
         // TODO: Implement getArchives() method.
     }

     /**
      * @return array
      */
     public function getStartingUrls()
     {
         // TODO: Implement getStartingUrls() method.
     }

     /**
      * @param array $urls
      * @return void
      */
     public function setStartingUrls($urls)
     {
         // TODO: Implement setStartingUrls() method.
     }


 }