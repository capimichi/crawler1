<?php
namespace Crawler\Single\Fields;

/**
 * Interface IFieldImage
 * @package Crawler\Single\Fields
 */
interface IFieldImage extends IField {

    /**
     * @return string
     */
    public function getSrc();

    /**
     * @return string
     */
    public function getDownloadedImage();
}