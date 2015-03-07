<?php

use YOOtheme\Framework\View\View;
use YOOtheme\Framework\View\Asset\AssetManager;
use YOOtheme\Framework\View\Asset\Filter\CssImageBase64Filter;
use YOOtheme\Framework\View\Asset\Filter\CssImportResolverFilter;
use YOOtheme\Framework\View\Asset\Filter\CssRewriteUrlFilter;
use YOOtheme\Framework\View\Asset\Filter\CssRtlFilter;
use YOOtheme\Framework\View\Asset\Filter\FilterManager;
use YOOtheme\Framework\View\Loader\ResourceLoader;

return array(

    'name' => 'framework/view',

    'main' => function($app) {

        $app['view'] = function($app) {

            $view = new View($app['view.loader']);
            $view->set('app', $app);

            return $view;
        };

        $app['view.loader'] = function($app) {
            return new ResourceLoader($app['locator']);
        };

        $app['styles'] = function($app) {
            return new AssetManager($app['view.loader'], $app['filters'], $app['version'], $app['styles.cache']);
        };

        $app['styles.cache'] = function($app) {
            return isset($app['path.cache']) ? $app['path.cache'].'/%name%.css' : null;
        };

        $app['scripts'] = function($app) {
            return new AssetManager($app['view.loader'], $app['filters'], $app['version'], $app['scripts.cache']);
        };

        $app['scripts.cache'] = function($app) {
            return isset($app['path.cache']) ? $app['path.cache'].'/%name%.js' : null;
        };

        $app['filters'] = function($app) {
            return new FilterManager(array(
                'CssImageBase64'    => new CssImageBase64Filter($app['request']),
                'CssImportResolver' => new CssImportResolverFilter,
                'CssRewriteUrl'     => new CssRewriteUrlFilter($app['url']),
                'CssRtl'            => new CssRtlFilter,
            ));
        };
    }

);
