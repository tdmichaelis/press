<?php

namespace YOOtheme\Framework\View;

use YOOtheme\Framework\View\Loader\LoaderInterface;

class View
{
    /**
     * @var LoaderInterface
     */
    protected $loader;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * @var array
     */
    protected $globals = array();

    /**
     * @var array
     */
    protected $macros = array();

    /**
     * @var array
     */
    protected $cache = array();

    /**
     * Constructor.
     *
     * @param LoaderInterface $loader
     */
    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * Gets a global parameter.
     *
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $array = $this->globals;

        if (isset($array[$key])) {
            return $array[$key];
        }

        foreach (explode('.', $key) as $segment) {

            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return $default;
            }

            $array = $array[$segment];
        }

        return $array;
    }

    /**
     * Sets a global parameter.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return self
     */
    public function set($key, $value)
    {
        $keys = explode('.', $key);
        $array =& $this->globals;

        while (count($keys) > 1) {

            $key = array_shift($keys);

            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = array();
            }

            $array =& $array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $this;
    }

    /**
     * Sets a macro.
     *
     * @param string   $name
     * @param callable $callable
     */
    public function macro($name, $callable)
    {
        if (!isset($this->macros[$name]) && is_callable($callable)) {
            $this->macros[$name] = $callable;
        }
    }

    /**
     * Renders a macro.
     *
     * @param  string $name
     * @param  array  $args
     * @return mixed
     */
    public function __call($name, $args)
    {
        if (isset($this->macros[$name])) {

            ob_start();
            $output = call_user_func_array($this->macros[$name], $args);

            return ob_get_clean().$output;
        }

        throw new \BadMethodCallException("Method {$name} does not exist.");
    }

    /**
     * Renders a template.
     *
     * @param  string $name
     * @param  array  $parameters
     * @return string|false
     */
    public function render($name, array $parameters = array())
    {
        foreach ($parameters as $key => $value) {
            if (strpos($key, '.') !== false) {
                $this->set($key, $value);
            }
        }

        return $this->evaluate($this->load($name), array_replace($this->globals, $parameters));
    }

    /**
     * Evaluates a template.
     *
     * @param  string $template
     * @param  array  $parameters
     * @return string|false
     */
    protected function evaluate($template, array $parameters = array())
    {
        $this->template = $template;
        $this->parameters = $parameters;

        unset($template, $parameters);
        extract($this->parameters, EXTR_SKIP);

        if (file_exists($this->template)) {

            ob_start();
            require $this->template;

            $this->template = null;
            $this->parameters = null;

            return ob_get_clean();
        }

        return false;
    }

    /**
     * Loads a template.
     *
     * @param  string $name
     * @return string
     */
    protected function load($name)
    {
        if (isset($this->cache[$name])) {
            return $this->cache[$name];
        }

        $template = $this->loader->load($name);

        if ($template === false) {
            throw new \InvalidArgumentException(sprintf('The template "%s" does not exist.', $name));
        }

        return $this->cache[$name] = $template;
    }
}
