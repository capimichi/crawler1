<?php
namespace Crawler\Single\Fields;

/**
 * Interface IField
 * @package Crawler\Single\Fields
 */
interface IField{

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return void
     */
    public function setName($name);

    /**
     * @return bool
     */
    public function isMultiple();

    /**
     * @param bool $multiple
     * @return void
     */
    public function setMultiple($multiple);

    /**
     * @return array
     */
    public function getSelectors();

    /**
     * @param array $selectors
     * @return void
     */
    public function setSelectors($selectors);

    /**
     * @param \DOMXPath $xpath
     * @return void
     */
    public function setXpath($xpath);

    /**
     * @param string $url
     * @return void
     */
    public function setUrl($url);

    /**
     * @return array
     */
    public function getExport();
}