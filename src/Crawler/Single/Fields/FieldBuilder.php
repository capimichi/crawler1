<?php
namespace Crawler\Single\Fields;

use Crawler\Selector;

/**
 * Class FieldBuilder
 * @package Crawler\Single\Fields
 */
class FieldBuilder
{

    /**
     * @var Field
     */
    protected $field;


    /**
     * FieldBuilder constructor.
     * @param int $type
     */
    public function __construct($type)
    {
        switch ($type){
            case FieldTypes::STRING:
                $this->field = new FieldString();
                break;
            case FieldTypes::URL:
                $this->field = new FieldUrl();
                break;
            case FieldTypes::IMAGE:
                $this->field = new FieldImage();
                break;
        }
        $this->field->setSelectors(array());
        $this->field->setMultiple(false);
        $this->field->setRewrites(array());
    }


    /**
     * @param Selector $selector
     * @return FieldBuilder $this
     */
    public function addSelector($selector)
    {
        $selectors = $this->field->getSelectors();
        $selectors[] = $selector;
        $this->field->setSelectors($selectors);
        return $this;
    }


    /**
     * @param string $name
     * @return FieldBuilder $this
     */
    public function setName($name)
    {
        $this->field->setName($name);
        return $this;
    }

    /**
     * @param bool $multiple
     * @return FieldBuilder $this
     */
    public function setMultiple($multiple)
    {
        $this->field->setMultiple($multiple);
        return $this;
    }

    /**
     * @param Rewrite $rewrite
     * @return FieldBuilder $this
     */
    public function addRewrite($rewrite){
        $rewrites = $this->field->getRewrites();
        $rewrites[] = $rewrite;
        $this->field->setRewrites($rewrites);
        return $this;
    }

    /**
     * @return FieldBuilder $this
     * @throws \Exception
     */
    public function validate()
    {
        if(count($this->field->getSelectors()) < 1){
            throw new \Exception("Selectors not defined");
        }

        if(empty($this->field->getName())){
            throw new \Exception("Name not defined");
        }
        return $this;
    }

    /**
     * @return Field
     */
    public function build()
    {
        $this->validate();
        return $this->field;
    }
}