<?php

namespace YOOtheme\Widgetkit\Content;

use YOOtheme\Framework\Application;
use YOOtheme\Framework\ApplicationAware;

class Type extends ApplicationAware implements TypeInterface
{
    /**
     * @var array
     */
    protected $config = array();

    /**
     * @var callable
     */
    protected $items;

    /**
     * {@inheritdoc}
     */
    public function getConfig($name = null)
    {
        if ($name === null) {
            return $this->config;
        } elseif (array_key_exists($name, $this->config)) {
            return $this->config[$name];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getItems(ContentInterface $content)
    {
        $items = new ItemCollection($this->app);

        if (is_callable($this->items)) {
            call_user_func($this->items, $items, $content, $this->app);
        }

        return $items;
    }

    /**
     * {@inheritdoc}
     */
    public function load(Application $app, array $config)
    {
        if (isset($config['config'])) {
            $this->config = is_callable($config['config']) ? call_user_func($config['config'], $app) : $config['config'];
        }

        if (isset($config['items'])) {
            $this->items = $config['items'];
        }

        if ($name = (string) $this->getConfig('name')) {
            $app['types'][$name] = $this;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return $this->getConfig();
    }
}
