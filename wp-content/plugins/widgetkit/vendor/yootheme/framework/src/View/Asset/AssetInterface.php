<?php

namespace YOOtheme\Framework\View\Asset;

interface AssetInterface extends \ArrayAccess
{
    /**
     * Returns the asset name.
     *
     * @return string
     */
    public function getName();

    /**
     * Returns the asset source.
     *
     * @return string
     */
    public function getSource();

    /**
     * Returns the asset options.
     *
     * @return array
     */
    public function getOptions();

    /**
     * Returns the asset content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Sets the asset content.
     *
     * @param string $content
     */
    public function setContent($content);

    /**
     * Gets the unique asset hash.
     *
     * @param  string $salt
     * @return string
     */
    public function hash($salt = '');

    /**
     * Applies filters and returns the asset as a string.
     *
     * @param  array $filters
     * @return string
     */
    public function dump(array $filters = array());
}
