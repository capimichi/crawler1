<?php
namespace Crawler\Archive;

/**
 * Interface ICrawlArchive
 * @package Crawler\Archive
 */
interface ICrawlArchive{

    /**
     * @return array
     */
    public function getItems();

    /**
     * @return string|null
     */
    public function getNextpageUrl();

    /**
     * @param array $selectors
     * @return void
     */
    public function setItemsSelectors($selectors);

    /**
     * @param array $selectors
     * @return void
     */
    public function setNextpageSelectors($selectors);

}