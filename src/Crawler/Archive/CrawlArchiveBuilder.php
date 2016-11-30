<?php
namespace Crawler\Archive;
use Crawler\CrawlObjectBuilder;
use Crawler\Single\Fields\Field;

/**
 * Class CrawlArchiveBuilder
 * @package Crawler\Archive
 */
class CrawlArchiveBuilder extends CrawlObjectBuilder {

    /**
     * CrawlArchiveBuilder constructor.
     */
    public function __construct()
    {
        $this->buildObject = new CrawlArchive();
        $this->buildObject->setItemsSelectors(array());
        $this->buildObject->setNextpageSelectors(array());
        parent::__construct();
    }

    /**
     * @param $selector
     * @return CrawlArchiveBuilder $this
     */
    public function addItemSelector($selector){
        $selectors = $this->buildObject->getItemsSelectors();
        $selectors[] = $selector;
        $this->buildObject->setItemsSelectors($selectors);
        return $this;
    }

    /**
     * @param $selector
     * @return CrawlArchiveBuilder $this
     */
    public function addNextpageSelector($selector){
        $selectors = $this->buildObject->getNextpageSelectors();
        $selectors[] = $selector;
        $this->buildObject->setNextpageSelectors($selectors);
        return $this;
    }

    /**
     * @param \Crawler\Content\WebContentPage $webContentPage
     * @return CrawlArchiveBuilder
     */
    public function setWebContentPage($webContentPage)
    {
        return parent::setWebContentPage($webContentPage);
    }

    /**
     * @param string $url
     * @return CrawlArchiveBuilder
     */
    public function setUrl($url)
    {
        return parent::setUrl($url);
    }

    /**
     * @param Field $field
     * @return CrawlArchiveBuilder $this
     */
    public function addArchiveField($field)
    {
        $fields = $this->buildObject->getArchiveFields();
        $fields[] = $field;
        $this->buildObject->setArchiveFields($fields);
        return $this;
    }

    /**
     * @param Field $field
     * @return CrawlArchiveBuilder $this
     */
    public function addSingleField($field)
    {
        $fields = $this->buildObject->getSingleFields();
        $fields[] = $field;
        $this->buildObject->setSingleFields($fields);
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function validate(){
        if(count($this->buildObject->getItemsSelectors()) < 1){
            throw new \Exception("No items selector added in archive");
        }
        if(count($this->buildObject->getNextpageSelectors()) < 1){
            throw new \Exception("No next page selector added in archive");
        }
        parent::validate();
    }

    /**
     * @return CrawlArchive
     */
    public function build()
    {
        return parent::build();
    }
}