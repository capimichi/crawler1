<?php
namespace Crawler\Single;

use Crawler\CrawlObject;

class CrawlSingle extends CrawlObject {

    /**
     * @var array
     */
    protected $fields;

    public function __construct($url, $fields)
    {
        parent::__construct($url);
        $this->setFields($fields);
        for($i = 0; $i < count($this->fields); $i++){
            $fields[$i]->setXpath($this->getXpath());
        }
    }

    /**
     * @param array $fields
     * @return void
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }


    /**
     * @return array
     */
    public function getExport()
    {
        $export = array(
            'url' => $this->getUrl()
        );
        foreach($this->getFields() as $field){
            foreach($field->getExport() as $key => $value){
                $export[$key] = $value;
            }
        }
        return $export;
    }

    /**
     * @return array
     */
    protected function getFields()
    {
        return $this->fields;
    }


}