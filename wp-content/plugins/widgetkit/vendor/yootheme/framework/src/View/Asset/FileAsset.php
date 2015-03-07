<?php

namespace YOOtheme\Framework\View\Asset;

class FileAsset extends Asset
{
    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        if ($this->content === null && $this['path']) {
            $this->content = file_get_contents($this['path']);
        }

        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function hash($salt = '')
    {
        return hash('crc32b', $this->source.$this['version'].$salt);
    }
}
