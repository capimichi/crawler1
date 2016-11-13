<?php
namespace Crawler\Utils;

use Crawler\SelectorTypes;

class XpathQueryBuilder
{
    protected $query;

    /**
     * @return string
     */
    public function getQuery()
    {
        if (!isset($this->query)) {
            $this->setQuery("");
        }
        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * @param string $class
     * @param string $selector
     * @return XpathQueryBuilder
     */
    public function addQueryByClass($class, $selector = "*")
    {
        $query = $this->getQuery();
        $query .= "//{$selector}[contains(concat(' ', normalize-space(@class), ' '), ' {$class} ')]";
        $this->setQuery($query);
        return $this;
    }

    /**
     * @param string $id
     * @param string $selector
     * @return XpathQueryBuilder
     */
    public function addQueryById($id, $selector = "*")
    {
        $query = $this->getQuery();
        $query .= "//{$selector}[contains(concat(' ', normalize-space(@id), ' '), ' {$id} ')]";
        $this->setQuery($query);
        return $this;
    }

    /**
     * @param string $selector
     * @return XpathQueryBuilder
     */
    public function addQuery($selector)
    {
        $query = $this->getQuery();
        $query .= "//{$selector}";
        $this->setQuery($query);
        return $this;
    }

    /**
     * @param array $selectors
     */
    public function addQueryBySelectors($selectors)
    {
        $query = $this->getQuery();
        foreach ($selectors as $singleSelector) {
            switch ($singleSelector->getType()) {
                case SelectorTypes::TAGNAME:
                    $query .= "//{$singleSelector->getValue()}";
                    break;
                case SelectorTypes::CLASSNAME:
                    $query .= "//*[contains(concat(' ', normalize-space(@class), ' '), ' {$singleSelector->getValue()} ')]";
                    break;
                case SelectorTypes::ID:
                    $query .= "//*[contains(concat(' ', normalize-space(@id), ' '), ' {$singleSelector->getValue()} ')]";
                    break;
            }
        }
        $this->setQuery($query);
        return $this;
    }
}