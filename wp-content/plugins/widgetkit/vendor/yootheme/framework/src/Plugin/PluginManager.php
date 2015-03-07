<?php

namespace YOOtheme\Framework\Plugin;

use YOOtheme\Framework\Application;
use YOOtheme\Framework\ApplicationAware;

class PluginManager implements \ArrayAccess
{
    /**
     * @var array
     */
    protected $paths = array();

    /**
     * @var array
     */
    protected $plugins = array();

    /**
     * Gets a plugin by name.
     *
     * @param  string $name
     * @return PluginInterface|null
     */
    public function get($name)
    {
        return isset($this->plugins[$name]) ? $this->plugins[$name] : null;
    }

    /**
     * Loads all plugins.
     *
     * @param Application $app
     */
    public function load(Application $app)
    {
        foreach ($this->loadConfigs() as $config) {

            $name = $config['name'];

            if (isset($this->plugins[$name])) {
                continue;
            }

            if (isset($config['autoload'])) {
                foreach ($config['autoload'] as $namespace => $path) {
                    $app['autoloader']->addPsr4($namespace, $config['path']."/$path");
                }
            }

            if (isset($config['events'])) {
                foreach ($config['events'] as $event => $listener) {
                    $app->on($event, $listener);
                }
            }

            if (is_string($class = $config['main'])) {

                $plugin = new $class;

                if ($plugin instanceof ApplicationAware) {
                    $plugin->setApplication($app);
                }

                if ($plugin instanceof PluginInterface) {
                    $plugin->load($app, $config);
                }

                $this->plugins[$name] = $plugin;

            } elseif (is_callable($config['main'])) {

                $this->plugins[$name] = call_user_func($config['main'], $app, $config) ?: true;
            }
        }
    }

    /**
     * Loads all plugin configs.
     *
     * @return array
     */
    public function loadConfigs()
    {
        $configs = array();
        $include = array();

        foreach ($this->paths as $path) {

            $paths = glob($path, GLOB_NOSORT) ?: array();

            foreach ($paths as $p) {

                if (!is_array($config = include($p)) && !isset($config['main'])) {
                    continue;
                }

                $config['path'] = strtr(dirname($p), '\\', '/');

                if (!isset($config['name'])) {
                    $config['name'] = basename($config['path']);
                }

                if (isset($config['include'])) {
                    $include = array_merge($include, (array) $config['include']);
                }

                $configs[] = $config;
            }
        }

        if ($this->paths = $include) {
            $configs = array_merge($configs, $this->loadConfigs());
        }

        return $configs;
    }

    /**
     * Adds a plugin path(s).
     *
     * @param  string|array $paths
     * @return self
     */
    public function addPath($paths)
    {
        $this->paths = array_merge($this->paths, (array) $paths);

        return $this;
    }

    /**
     * Checks if a plugin exists.
     *
     * @param  string $name
     * @return bool
     */
    public function offsetExists($name)
    {
        return isset($this->plugins[$name]);
    }

    /**
     * Gets a plugin by name.
     *
     * @param  string $name
     * @return bool
     */
    public function offsetGet($name)
    {
        return $this->get($name);
    }

    /**
     * Sets a plugin.
     *
     * @param string $name
     * @param string $plugin
     */
    public function offsetSet($name, $plugin)
    {
        $this->plugins[$name] = $plugin;
    }

    /**
     * Unset a plugin.
     *
     * @param string $name
     */
    public function offsetUnset($name)
    {
        unset($this->plugins[$name]);
    }
}
