<?php

namespace YOOtheme\Widgetkit;

use YOOtheme\Framework\Application as BaseApplication;
use YOOtheme\Framework\Event\EventSubscriberInterface;
use YOOtheme\Widgetkit\Content\ContentProvider;
use YOOtheme\Widgetkit\Image\ImageProvider;
use YOOtheme\Widgetkit\Helper\Shortcode;

class Application extends BaseApplication implements EventSubscriberInterface
{
    /**
     * Constructor.
     *
     * @param array $values
     */
    public function __construct(array $values = array())
    {
        parent::__construct($values);

        $this['content']   = new ContentProvider($this);
        $this['image']     = new ImageProvider($this);
        $this['shortcode'] = new Shortcode;
        $this['types']     = new Collection;
        $this['widgets']   = new Collection;

        $this->extend('locator', function ($locator, $app) {
            return $locator->addPath('', $app['path']);
        });

        $this->extend('translator', function ($translator, $app) {
            return $translator->addResource('languages/'.$app['locale'].'.json');
        });

        $this->on('boot', function ($event, $app) {

            $app['plugins']->addPath($app['path'].'/plugins/*/*/plugin.php');

            foreach ($app['templates'] as $path) {
                $app['locator']->addPath('plugins', $path);
                $app['plugins']->addPath($path.'/*/*/plugin.php');
            }
        });

        $this['events']->addSubscriber($this);
    }

    public function init()
    {
        // controller
        $this['controllers']->add('YOOtheme\Widgetkit\Controller\ContentController');
        $this['controllers']->add('YOOtheme\Widgetkit\Controller\ImageController');

        // combine assets
        if (!$this['debug']) {
            $this['styles']->combine('styles', 'widgetkit-*' , array('CssImportResolver', 'CssRewriteUrl', 'CssImageBase64'));
            $this['scripts']->combine('scripts', 'widgetkit-*')->combine('uikit', 'uikit*')->combine('angular', 'angular*')->combine('application', 'application{,-translator,-templates}');
        }

        // site event
        if (!$this['admin']) {
            $this->trigger('init.site', array($this));
        }
    }

    public function initSite()
    {
        // styles
        $this->on('view', function($event, $app) {
            if (!$app['config']->get('theme.support')) {
                $app['styles']->add('widgetkit-site', 'assets/css/site.css');
            }
        });

        // scripts
        $this['scripts']->register('uikit', 'vendor/assets/uikit/js/uikit.min.js');
    }

    public function initAdmin()
    {
        // angular
        $this['angular']->set('name', 'widgetkit');
        $this['angular']->set('types', $this['types']->toArray());
        $this['angular']->set('widgets', $this['widgets']->toArray());
        $this['angular']->set('images', array(
            'audio'       => $this['url']->to('assets/images/preview-audio.svg'),
            'video'       => $this['url']->to('assets/images/preview-video.svg'),
            'iframe'      => $this['url']->to('assets/images/preview-iframe.svg'),
            'placeholder' => $this['url']->to('assets/images/preview-placeholder.svg')
        ));
        $this['angular']->addTemplate('picker', 'views/picker.php', true);

        // widgetkit
        $this['styles']->add('widgetkit-admin', 'assets/css/admin.css');
        $this['scripts']->add('widgetkit-fields', 'assets/js/fields.js', array('angular'));
        $this['scripts']->add('widgetkit-application', 'assets/js/application.js', array('uikit', 'uikit-notify', 'uikit-nestable', 'uikit-sortable', 'application-translator', 'angular-resource', 'widgetkit-fields'));
        $this['scripts']->add('widgetkit-controllers', 'assets/js/controllers.js', array('widgetkit-application'));
        $this['scripts']->add('widgetkit-directives', 'assets/js/directives.js', array('widgetkit-application'));
        $this['scripts']->add('widgetkit-environment', 'assets/js/environment.js', array('widgetkit-application'));
    }

    public function renderWidget(array $attrs)
    {
        if (!isset($attrs['id'], $attrs['widget']) or !$content = $this['content']->get($attrs['id']) or !$widget = $this['widgets']->get($attrs['widget'])) {
            return '';
        }

        $app    = $this;
        $regex  = '/(?P<attr>href|src|poster)=([\"\'])(?!\/|\#|(mailto|news|(ht|f)tp(s?))\:)(?P<url>[^\"\'>]+)\2/xiU';

        $attrs = array_map(function ($value) {
            return in_array($value, array('true', 'false')) ? $value == 'true' : $value;
        }, $attrs);

        return preg_replace_callback($regex, function ($matches) use ($app) {
            return sprintf('%s="%s"', $matches['attr'], $app['url']->to($matches['url']));
        }, $widget->render($content, $attrs));
    }

    public function install()
    {
        $sql = "CREATE TABLE IF NOT EXISTS @widgetkit (
            id int(10) NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            type VARCHAR(255) NOT NULL,
            data longtext NOT NULL,
            PRIMARY KEY  id (id)
        ) DEFAULT CHARSET=utf8;";

        if ($this['db']->executeQuery($sql) === false) {
            throw new \RuntimeException('Unable to create Widgetkit database.');
        }
    }

    public function uninstall()
    {
        $sql = "DROP TABLE IF EXISTS @widgetkit";

        if ($this['db']->executeQuery($sql) === false) {
            throw new \RuntimeException('Unable to delete Widgetkit database.');
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            'init'       => array('init', -5),
            'init.site'  => 'initSite',
            'init.admin' => 'initAdmin'
        );
    }
}
