<?php

namespace YOOtheme\Framework\Config;

class Config implements \ArrayAccess
{
    /**
     * @var array
     */
    protected $values;

    /**
     * Constructor.
     *
     * @param array $values
     */
    public function __construct(array $values = array())
    {
        $this->values = $values;
    }

    /**
     * Checks if a key exists.
     *
     * @param  string $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->values[$key]);
    }

    /**
     * Gets a value.
     *
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return isset($this->values[$key]) ? $this->values[$key] : $default;
    }

    /**
     * Sets a value.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return self
     */
    public function set($key, $value)
    {
        $this->values[$key] = $value;

        return $this;
    }

    /**
     * Adds multiple values.
     *
     * @param  array $values
     * @return self
     */
    public function add(array $values)
    {
        $this->values = array_merge($this->values, $values);

        return $this;
    }

    /**
     * Clears all values.
     *
     * @return self
     */
    public function clear()
    {
        $this->values = array();

        return $this;
    }

    /**
     * Checks if a key exists.
     *
     * @param  string $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
     * Gets a value.
     *
     * @param  string $key
     * @return bool
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * Sets a value.
     *
     * @param string $key
     * @param string $value
     */
    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Unsets a value.
     *
     * @param string $key
     */
    public function offsetUnset($key)
    {
        unset($this->values[$key]);
    }
}
