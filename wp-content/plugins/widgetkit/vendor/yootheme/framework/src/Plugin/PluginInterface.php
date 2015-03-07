<?php

namespace YOOtheme\Framework\Plugin;

use YOOtheme\Framework\Application;

interface PluginInterface
{
    /**
     * Loads the plugin.
     *
     * @param Application $app
     * @param array       $config
     */
    public function load(Application $app, array $config);
}
