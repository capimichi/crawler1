<?php
namespace Crawler\Single;

use Crawler\CrawlObjectBuilder;
use Crawler\Single\Fields\Field;

class CrawlSingleBuilder extends CrawlObjectBuilder {

    /**
     * CrawlSingleBuilder constructor.
     */
    public function __construct()
    {
        $this->buildObject = new CrawlSingle();
        $this->buildObject->setFields(array());
        parent::__construct();
    }

    /**
     * @param Field $field
     * @return CrawlSingleBuilder $this
     */
    public function addField($field){
        $fields = $this->buildObject->getFields();
        $fields[] = $field;
        $this->buildObject->setFields($fields);
        return $this;
    }

    /**
     * @param string $url
     * @return CrawlSingleBuilder
     */
    public function setUrl($url)
    {
        return parent::setUrl($url);
    }

    /**
     * @param \Crawler\Content\WebContentPage $webContentPage
     * @return CrawlSingleBuilder
     */
    public function setWebContentPage($webContentPage)
    {
        return parent::setWebContentPage($webContentPage);
    }

    /**
     * @param string $urlKeyName
     * @return CrawlSingleBuilder $this
     */
    public function setUrlKeyName($urlKeyName)
    {
        $this->buildObject->setUrlKeyName($urlKeyName);
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function validate()
    {
        if(count($this->buildObject->getFields()) < 1){
            throw new \Exception("Fields not added");
        }
        parent::validate();
    }

    /**
     * @return CrawlSingle
     */
    public function build()
    {
        return parent::build();
    }
}