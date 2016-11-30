<?php
namespace Crawler\Archive;

use Crawler\CrawlObject;
use Crawler\Utils\XpathQueryBuilder;
use Crawler\Single\CrawlSingle;
use Crawler\Single\CrawlSingleBuilder;
use Crawler\Crawler;

/**
 * Class CrawlArchive
 * @package Crawler\Archive
 */
class CrawlArchive extends CrawlObject
{

    /**
     * @var array
     */
    protected $itemsSelectors;

    /**
     * @var array
     */
    protected $nextpageSelectors;

    /**
     * @var array
     */
    protected $itemsSingleOpened;

    /**
     * @var array
     */
    protected $itemsSingleInline;

    /**
     * @var array
     */
    protected $singleFields;

    /**
     * @var array
     */
    protected $archiveFields;

    /**
     * @var array
     */
    protected $itemsArchive;

    /**
     * CrawlArchive constructor.
     */
    public function __construct()
    {
        $this->setSingleFields(array());
        $this->setArchiveFields(array());
    }

    public function getItems($openSingle = false){
        if($openSingle){
            if(!isset($this->itemsSingleOpened)){{
                $items = array();
                $xpathQueryBuilder = new XpathQueryBuilder();
                $query = $xpathQueryBuilder->addQueryBySelectors($this->getItemsSelectors())->getQuery();
                $elements = $this->getXpath()->query($query);
                for ($i = 0; $i < $elements->length; $i++) {
                    $urlObj = $elements->item($i)->attributes->getNamedItem("href");
                    if ($urlObj != null)
                        $url = $this->parseUrl($urlObj->nodeValue);
                        $builder = new CrawlSingleBuilder();
                        foreach($this->getSingleFields() as $field){
                            $builder->addField($field);
                        }
                        $builder->setUrl($url);
                        $contentPageBuilder = new WebContentPageBuilder();
                        $contentPageBuilder
                            ->setUrl($url)
                            ->setVerbose($this->isVerbose())
                            ->setInterval($this->getInterval())
                            ->setTimeout($this->getTimeout())
                            ->setUseragent($this->getUseragent())
                            ->setProxyUrl($this->getProxyUrl())
                            ->setProxyType($this->getProxyType())
                            ->setConnectionTimeout($this->getConnectionTimeout())
                            ->setVerifyPeer($this->isVerifyPeer());

                        // TODO: Parametri al WebContentPage

                        $builder->setWebContentPage($contentPageBuilder->build());
                        $items[] = $builder->build();
                    }
                }
                $this->setItemsSingleOpened($items);

            }
            return $this->itemsSingleOpened;
        } else {
            if(!isset($this->itemsSingleInline)){
                $xpathQueryBuilder = new XpathQueryBuilder();
                $query = $xpathQueryBuilder->addQueryBySelectors($this->getItemsSelectors())->getQuery();
                $elements = $this->getXpath()->query($query);
                $items = array();
                for ($i = 0; $i < $elements->length; $i++) {
                    $document = new \DOMDocument();
                    $document->appendChild($document->importNode($elements->item($i), true));
                    $builder = new CrawlSingleBuilder();
                    foreach($this->getSingleFields() as $field){
                        $builder->addField($field);
                    }
                    $builder->setUrl("");
                    $contentPageBuilder = new WebContentPageBuilder();
                    $contentPageBuilder
                        ->setUrl("")
                        ->setDomDocument($document);

                    // TODO: Parametri al WebContentPage

                    $builder->setWebContentPage($contentPageBuilder->build());
                    $items[] = $builder->build();
                }
                $this->setItemsSingleInline($items);
            }
            return $this->itemsSingleInline;
        }
    }

    /**
     * @param array $itemsSingleOpened
     */
    public function setItemsSingleOpened($itemsSingleOpened)
    {
        $this->itemsSingleOpened = $itemsSingleOpened;
    }

    /**
     * @param array $itemsSingleInline
     */
    public function setItemsSingleInline($itemsSingleInline)
    {
        $this->itemsSingleInline = $itemsSingleInline;
    }

    /**
     * @param array $itemsArchive
     */
    public function setItemsArchive($itemsArchive)
    {
        $this->itemsArchive = $itemsArchive;
    }

    /**
     * @return string|null
     */
    public function getNextpageUrl()
    {
        $xpathQueryBuilder = new XpathQueryBuilder();
        $query = $xpathQueryBuilder->addQueryBySelectors($this->getNextpageSelectors())->getQuery();
        $xpath = $this->getXpath();
        $url = null;
        $elements = $xpath->query($query);
        if ($elements->length > 0) {
            $element = null;
            for ($i = 0; $i < $elements->length; $i++) {
                $element = $elements->item($i);
            }
            if ($element != null) {
                $attributes = $element->attributes;
                if ($attributes != null) {
                    $urlObj = $attributes->getNamedItem("href");
                    if ($urlObj != null) {
                        $url = $this->parseUrl($urlObj->nodeValue);
                    }
                }
            }
        }
        return $url;
    }

    /**
     * @param array $selectors
     * @return void
     */
    public function setItemsSelectors($selectors)
    {
        $this->itemsSelectors = $selectors;
    }

    /**
     * @param array $selectors
     * @return void
     */
    public function setNextpageSelectors($selectors)
    {
        $this->nextpageSelectors = $selectors;
    }


    /**
     * @return mixed
     */
    public function getItemsSelectors()
    {
        return $this->itemsSelectors;
    }

    /**
     * @return mixed
     */
    public function getNextpageSelectors()
    {
        return $this->nextpageSelectors;
    }

    /**
     * @return array
     */
    public function getSingleFields()
    {
        return $this->singleFields;
    }

    /**
     * @param array $singleFields
     */
    public function setSingleFields($singleFields)
    {
        $this->singleFields = $singleFields;
    }

    /**
     * @return array
     */
    public function getArchiveFields()
    {
        return $this->archiveFields;
    }

    /**
     * @param array $archiveFields
     */
    public function setArchiveFields($archiveFields)
    {
        $this->archiveFields = $archiveFields;
    }

    /**
     * @param array $itemsUrls
     */
    protected function setItemsUrls($itemsUrls)
    {
        $this->itemsUrls = $itemsUrls;
    }


}
