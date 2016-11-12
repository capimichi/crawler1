<?php
namespace Crawler;

interface ICrawler{

    /**
     * ICrawler constructor.
     * @param array $startingUrls
     * @param array $itemsSelectors
     * @param array $nextpageSelectors
     * @param array $singleFieldsSelectors
     */
    public function __construct( $startingUrls, $itemsSelectors, $nextpageSelectors, $singleFieldsSelectors );

    /**
     * @param array $options
     * @return array
     */
    public function getArchives( $options );

    /**
     * @return array
     */
    public function getStartingUrls();

    /**
     * @param array $urls
     * @return void
     */
    public function setStartingUrls($urls);

}