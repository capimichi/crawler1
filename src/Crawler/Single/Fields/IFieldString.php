<?php
namespace Crawler\Single\Fields;

/**
 * Interface IFieldString
 * @package Crawler\Single\Fields
 */
interface IFieldString extends IField {

    /**
     * @return string
     */
    public function getString();

}