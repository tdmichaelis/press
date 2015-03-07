<?php

return array(

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => function($app) {

        return array(

            'name'  => 'slideshow',
            'label' => 'Slideshow',
            'core'  => true,
            'icon'  => $app['url']->to('plugins/widgets/slideshow/widget.svg'),
            'view'  => 'plugins/widgets/slideshow/views/widget.php',
            'item'  => array('title', 'content', 'media'),
            'settings' => array(
                'nav'                => 'dotnav',
                'nav_overlay'        => true,
                'nav_align'          => 'center',
                'thumbnail_width'    => '70',
                'thumbnail_height'   => '70',
                'thumbnail_alt'      => false,
                'slidenav'           => 'default',
                'nav_contrast'       => true,
                'animation'          => 'fade',
                'slices'             => '15',
                'duration'           => '500',
                'autoplay'           => false,
                'interval'           => '3000',
                'autoplay_pause'     => true,
                'kenburns'           => false,
                'fullscreen'         => false,
                'min_height'         => '300',

                'media'              => true,
                'image_width'        => 'auto',
                'image_height'       => 'auto',
                'overlay'            => 'none',
                'overlay_animation'  => 'fade',
                'overlay_background' => true,

                'title'              => true,
                'content'            => true,
                'title_size'         => 'h3',
                'link'               => true,
                'link_style'         => 'button',
                'link_text'          => 'Read more',
                'badge'              => true,
                'badge_style'        => 'badge',

                'class'              => ''
            )

        );
    },

    'events' => array(

        'init.site' => function($event, $app) {
            $app['scripts']->add('uikit-slideshow', 'vendor/assets/uikit/js/components/slideshow.min.js', array('uikit'));
            $app['scripts']->add('uikit-slideshow-fx', 'vendor/assets/uikit/js/components/slideshow-fx.min.js', array('uikit'));
        },

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('slideshow.edit', 'plugins/widgets/slideshow/views/edit.php', true);
        }

    )

);
