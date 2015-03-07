<?php

namespace YOOtheme\Framework\View\Asset;

abstract class Asset implements AssetInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var string
     */
    protected $content;

    /**
     * Constructor.
     *
     * @param string $name
     * @param string $source
     * @param array  $options
     */
    public function __construct($name, $source, array $options = array())
    {
        $this->name    = $name;
        $this->source  = $source;
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * {@inheritdoc}
     */
    public function dump(array $filters = array())
    {
        $asset = clone $this;

        foreach ($filters as $filter) {
            $filter->filterContent($asset);
        }

        return $asset->getContent();
    }

    /**
     * Sets an option.
     *
     * @param string $name  The option name
     * @param mixed  $value The option value
     */
    public function offsetSet($name, $value)
    {
        $this->options[$name] = $value;
    }

    /**
     * Gets a option value.
     *
     * @param string $name The option name
     *
     * @return mixed The option value
     */
    public function offsetGet($name)
    {
        return isset($this->options[$name]) ? $this->options[$name] : null;
    }

    /**
     * Returns true if the option exists.
     *
     * @param string $name The option name
     *
     * @return bool true if the option exists, false otherwise
     */
    public function offsetExists($name)
    {
        return isset($this->options[$name]);
    }

    /**
     * Removes an option.
     *
     * @param string $name The option name
     */
    public function offsetUnset($name)
    {
        unset($this->options[$name]);
    }
}
