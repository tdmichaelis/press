<?php

namespace YOOtheme\Framework\View\Asset;

class StringAsset extends Asset
{
    /**
     * {@inheritdoc}
     */
    public function __construct($name, $source, array $options = array())
    {
        parent::__construct($name, null, $options);

        $this->setContent($source);
    }

    /**
     * {@inheritdoc}
     */
    public function hash($salt = '')
    {
        return hash('crc32b', $this->content.$salt);
    }
}
