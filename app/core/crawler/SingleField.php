<?php
class SingleField{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $multiple;

    /**
     * @var array
     */
    protected $selectors;

    /**
     * @var Single
     */
    protected $parent;


    public function __construct( $name, $multiple, $selectors, $parent )
    {
        $this->setName($name);
        $this->setMultiple($multiple);
        $this->setSelectors($selectors);
        $this->parent = $parent;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return boolean
     */
    public function isMultiple()
    {
        return $this->multiple;
    }

    /**
     * @param boolean $multiple
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;
    }

    /**
     * @return array
     */
    public function getSelectors()
    {
        return $this->selectors;
    }

    /**
     * @param array $selectors
     */
    public function setSelectors($selectors)
    {
        $this->selectors = $selectors;
    }

    /**
     * @return string
     */
    public function getXpathQuery(){
        $xpathQueryBuilder = new XpathQueryBuilder();
        foreach($this->getSelectors() as $singleSelector){
            switch ($singleSelector->type){
                case "tagname":
                    $xpathQueryBuilder->addQuery($singleSelector->tagname);
                    break;
                case "class":
                    $xpathQueryBuilder->addQueryByClass($singleSelector->class);
                    break;
                case "id":
                    $xpathQueryBuilder->addQueryById($singleSelector->id);
                    break;
            }
        }
        return $xpathQueryBuilder->getQuery();
    }

    /**
     * @return Single
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Single $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

}