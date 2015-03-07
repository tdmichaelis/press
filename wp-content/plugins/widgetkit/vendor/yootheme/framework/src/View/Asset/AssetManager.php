<?php

namespace YOOtheme\Framework\View\Asset;

use YOOtheme\Framework\View\Asset\Filter\FilterManager;
use YOOtheme\Framework\View\Loader\LoaderInterface;

class AssetManager implements \IteratorAggregate
{
    /**
     * @var LoaderInterface
     */
    protected $loader;

    /**
     * @var FilterManager
     */
    protected $filters;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $cache;

    /**
     * @var AssetCollection
     */
    protected $registered;

    /**
     * @var array
     */
    protected $queued = array();

    /**
     * @var array
     */
    protected $combine = array();

    /**
     * Constructor.
     *
     * @param LoaderInterface $loader
     * @param string          $version
     */
    public function __construct(LoaderInterface $loader, FilterManager $filters, $version = null, $cache = null)
    {
        $this->loader     = $loader;
        $this->filters    = $filters ?: new FilterManager;
        $this->version    = $version;
        $this->cache      = $cache;
        $this->registered = new AssetCollection;
    }

    /**
     * Gets a registered asset.
     *
     * @param  string $name
     * @return Asset
     */
    public function get($name)
    {
        return $this->registered->get($name);
    }

    /**
     * Adds a registered asset or a new asset to the queue.
     *
     * @param  string $name
     * @param  mixed  $asset
     * @param  array  $dependencies
     * @param  array  $options
     * @return self
     */
    public function add($name, $asset = null, $dependencies = array(), $options = array())
    {
        if ($asset !== null) {
            $this->registered->add($instance = $this->create($name, $asset, $dependencies, $options));
        } else {
            $instance = $this->registered->get($name);
        }

        if ($instance) {
            $this->queued[$name] = true;
        }

        return $this;
    }

    /**
     * Removes an asset from the queue.
     *
     * @param  string $name
     * @return self
     */
    public function remove($name)
    {
        unset($this->queued[$name]);

        return $this;
    }

    /**
     * Removes all assets from the queue.
     *
     * @return self
     */
    public function removeAll()
    {
        $this->queued = array();

        return $this;
    }

    /**
     * Registers an asset.
     *
     * @param  string $name
     * @param  mixed  $asset
     * @param  array  $dependencies
     * @param  array  $options
     * @return self
     */
    public function register($name, $asset, $dependencies = array(), $options = array())
    {
        $this->registered->add($this->create($name, $asset, $dependencies, $options));

        return $this;
    }

    /**
     * Unregisters an asset.
     *
     * @param  string $name
     * @return self
     */
    public function unregister($name)
    {
        $this->registered->remove($name);
        $this->remove($name);

        return $this;
    }

    /**
     * Combines a assets to a file and applies filters.
     *
     * @param  string $name
     * @param  string $pattern
     * @param  array  $filters
     * @return self
     */
    public function combine($name, $pattern, $filters = array())
    {
        $this->combine[$name] = compact('pattern', 'filters');

        return $this;
    }

    /**
     * Gets queued assets with resolved dependencies, optionally all registered assets.
     *
     * @param  bool $registered
     * @return AssetCollection
     */
    public function all($registered = false)
    {
        if ($registered) {
            return $this->registered;
        }

        $assets = array();

        foreach (array_keys($this->queued) as $name) {
            $this->resolveDependencies($this->registered->get($name), $assets);
        }

        $assets = new AssetCollection($assets);

        foreach ($this->combine as $name => $options) {
            $assets = $this->doCombine($assets, $name, $options);
        }

        return $assets;
    }

    /**
     * Resolves asset dependencies.
     *
     * @param  AssetInterface   $asset
     * @param  AssetInterface[] $resolved
     * @param  AssetInterface[] $unresolved
     * @return AssetInterface[]
     * @throws \RuntimeException
     */
    public function resolveDependencies($asset, &$resolved = array(), &$unresolved = array())
    {
        $unresolved[$asset->getName()] = $asset;

        if (isset($asset['dependencies'])) {
            foreach ($asset['dependencies'] as $dependency) {
                if (!isset($resolved[$dependency])) {

                    if (isset($unresolved[$dependency])) {
                        throw new \RuntimeException(sprintf('Circular asset dependency "%s > %s" detected.', $asset->getName(), $dependency));
                    }

                    if ($d = $this->registered->get($dependency)) {
                        $this->resolveDependencies($d, $resolved, $unresolved);
                    }
                }
            }
        }

        $resolved[$asset->getName()] = $asset;
        unset($unresolved[$asset->getName()]);

        return $resolved;
    }

    /**
     * IteratorAggregate interface implementation.
     */
    public function getIterator()
    {
        return $this->all()->getIterator();
    }

    /**
     * Create an asset instance.
     *
     * @param  string $name
     * @param  mixed  $asset
     * @param  array  $dependencies
     * @param  array  $options
     * @throws \InvalidArgumentException
     * @return AssetInterface
     */
    protected function create($name, $asset, $dependencies = array(), $options = array())
    {
        if (is_string($options)) {
            $options = array('type' => $options);
        }

        if (!isset($options['type'])) {
            $options['type'] = 'file';
        }

        if (!isset($options['version'])) {
            $options['version'] = $this->version;
        }

        if ($dependencies) {
            $options = array_merge($options, array('dependencies' => (array)$dependencies));
        }

        if ('string' == $options['type']) {
            return new StringAsset($name, $asset, $options);
        }

        if ('file' == $options['type']) {

            $options['path'] = $this->loader->load($asset);

            return new FileAsset($name, $asset, $options);
        }

        throw new \InvalidArgumentException('Unable to determine asset type.');
    }

    /**
     * Combines assets matching a pattern to a single file asset, optionally applies filters.
     *
     * @param  AssetCollection $assets
     * @param  string          $name
     * @param  array           $options
     * @return AssetCollection
     */
    protected function doCombine(AssetCollection $assets, $name, $options = array())
    {
        extract($options);

        $combine = new AssetCollection;
        $pattern = $this->globToRegex($pattern);

        foreach ($assets as $asset) {
            if (preg_match($pattern, $asset->getName())) {
                $combine->add($asset);
            }
        }

        $file = strtr($this->cache, array('%name%' => $name));

        if ($names = $combine->names() and $file = $this->doCache($combine, $file, $filters)) {
            $assets->remove(array_slice($names, 1));
            $assets->replace(array_shift($names), $this->create($name, $file));
        }

        return $assets;
    }

    /**
     * Writes an asset collection to a cache file, optionally applies filters.
     *
     * @param  AssetCollection $assets
     * @param  string          $file
     * @param  array           $filters
     * @return mixed
     */
    protected function doCache(AssetCollection $assets, $file, $filters = array())
    {
        $filters = $this->filters->get($filters);

        if (count($assets)) {

            $time = 0;
            $salt = implode(',', array_keys($filters)).",{$_SERVER['SCRIPT_NAME']}";
            $file = preg_replace('/(.*?)(\.[^\.]+)?$/i', '$1-'.$assets->hash($salt).'$2', $file, 1);

            foreach ($assets as $asset) {
                if ($path = $asset['path'] and $modified = filemtime($path) and $modified > $time) {
                    $time = $modified;
                }
            }

            if (!file_exists($file) || filemtime($file) < $time) {
                file_put_contents($file, $assets->dump($filters));
            }

            return $file;
        }

        return false;
    }

    /**
     * Converts a glob to a regular expression.
     *
     * @param  string $glob
     * @return string
     */
    protected function globToRegex($glob)
    {
        $regex  = '';
        $group  = 0;
        $escape = false;

        for ($i = 0; $i < strlen($glob); $i++) {

            $c = $glob[$i];

            if ('.' === $c || '(' === $c || ')' === $c || '|' === $c || '+' === $c || '^' === $c || '$' === $c) {
                $regex .= "\\$c";
            } elseif ('*' === $c) {
                $regex .= $escape ? '\\*' : '.*';
            } elseif ('?' === $c) {
                $regex .= $escape ? '\\?' : '.';
            } elseif ('{' === $c) {
                $regex .= $escape ? '\\{' : '(';
                if (!$escape) {
                    ++$group;
                }
            } elseif ('}' === $c && $group) {
                $regex .= $escape ? '}' : ')';
                if (!$escape) {
                    --$group;
                }
            } elseif (',' === $c && $group) {
                $regex .= $escape ? ',' : '|';
            } elseif ('\\' === $c) {
                if ($escape) {
                    $regex .= '\\\\';
                    $escape = false;
                } else {
                    $escape = true;
                }
                continue;
            } else {
                $regex .= $c;
            }

            $escape = false;
        }

        return '#^'.$regex.'$#';
    }
}
