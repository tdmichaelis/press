<?php

namespace YOOtheme\Widgetkit\Widget;

use YOOtheme\Framework\Application;
use YOOtheme\Framework\ApplicationAware;
use YOOtheme\Widgetkit\Content\ContentInterface;

class Widget extends ApplicationAware implements WidgetInterface
{
    /**
     * @var array
     */
    protected $config = array();

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
    public function render(ContentInterface $content, array $settings)
    {
        static $nesting = 0;

        $output = $nesting++ < 10 ? $this['view']->render($this->getConfig('view'), array('widget' => $this, 'items' => $content->getItems(), 'settings' => array_merge($this->getConfig('settings'), $settings))) : '';

        $nesting--;

        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function load(Application $app, array $config)
    {
        if (isset($config['config'])) {
            $this->config = is_callable($config['config']) ? call_user_func($config['config'], $app) : $config['config'];
        }

        if ($name = $this->getConfig('name')) {
            $app['widgets'][$name] = $this;
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
