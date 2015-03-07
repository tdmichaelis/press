<?php

return array(

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => function($app) {

        return array(

            'name'  => 'gallery',
            'label' => 'Gallery',
            'core'  => true,
            'icon'  => $app['url']->to('plugins/widgets/gallery/widget.svg'),
            'view'  => 'plugins/widgets/gallery/views/widget.php',
            'item'  => array('title', 'content', 'media'),
            'settings' => array(
                'grid'                 => 'default',
                'gutter'               => 'default',
                'gutter_dynamic'       => '20',
                'filter'               => 'none',
                'filter_align'         => 'left',
                'columns'              => '1',
                'columns_small'        => 0,
                'columns_medium'       => 0,
                'columns_large'        => 0,
                'columns_xlarge'       => 0,
                'animation'            => 'none',

                'image_width'          => 'auto',
                'image_height'         => 'auto',
                'media_border'         => 'none',
                'overlay'              => 'default',
                'panel'                => 'blank',
                'overlay_center'       => 'icon',
                'overlay_background'   => 'hover',
                'hover_overlay'        => true,
                'overlay_animation'    => 'fade',
                'image_animation'      => 'scale',

                'title'                => true,
                'content'              => true,
                'title_size'           => 'panel',
                'link'                 => false,
                'link_style'           => 'button',
                'link_icon'            => 'share',
                'link_text'            => 'View',

                'lightbox'             => true,
                'lightbox_width'       => 'auto',
                'lightbox_height'      => 'auto',
                'lightbox_caption'     => 'content',
                'lightbox_link'        => false,
                'lightbox_style'       => 'button',
                'lightbox_icon'        => 'search',
                'lightbox_text'        => 'Details',

                'class'                => ''
            )

        );
    },

    'events' => array(

        'init.site' => function($event, $app) {
            $app['scripts']->add('uikit-grid', 'vendor/assets/uikit/js/components/grid.min.js', array('uikit'));
            $app['scripts']->add('uikit-lightbox', 'vendor/assets/uikit/js/components/lightbox.min.js', array('uikit'));
        },

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('gallery.edit', 'plugins/widgets/gallery/views/edit.php', true);
        }

    )

);
