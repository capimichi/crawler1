<?php
namespace Crawler\Single\Fields;

/**
 * Interface IFieldUrl
 * @package Crawler\Single\Fields
 */
interface IFieldUrl extends IField {

    /**
     * @return string
     */
    public function getUrl();

}