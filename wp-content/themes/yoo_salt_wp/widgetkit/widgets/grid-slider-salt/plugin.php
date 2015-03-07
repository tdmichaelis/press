<?php
/**
* @package   Salt
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

return array(

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => function($app) {

        return array(

            'name'  => 'grid-slider-salt',
            'label' => 'Grid Slider Salt',
            'icon'  => $app['url']->to('plugins/widgets/grid-slider/widget.svg'),
            'view'  => 'plugins/widgets/grid-slider-salt/views/widget.php',
            'item'  => array('title', 'content', 'media'),
            'settings' => array(
                'grid'              => 'default',
                'gutter'            => 'default',
                'gutter_dynamic'    => '20',
                'filter'            => 'none',
                'filter_align'      => 'left',
                'columns'           => '1',
                'columns_small'     => 0,
                'columns_medium'    => 0,
                'columns_large'     => 0,
                'columns_xlarge'    => 0,
                'panel0'            => 'box',
                'panel1'            => 'box',
                'panel2'            => 'box',
                'panel3'            => 'box',
                'panel4'            => 'box',
                'panel5'            => 'box',
                'animation'         => 'none',

                'image_width'       => 'auto',
                'image_height'      => 'auto',
                'media_align'       => 'teaser',
                'media_width'       => '1-2',
                'media_breakpoint'  => 'medium',
                'content_align'     => true,

                'nav'                => 'dotnav',
                'nav_overlay'        => true,
                'nav_align'          => 'center',
                'thumbnail_width'    => '70',
                'thumbnail_height'   => '70',
                'slidenav'           => 'default',
                'nav_contrast'       => true,
                'animation'          => 'fade',
                'slices'             => '15',
                'duration'           => '500',
                'autoplay'           => false,
                'interval'           => '3000',
                'autoplay_pause'     => true,
                'kenburns'           => false,

                'title'              => true,
                'content'            => true,
                'title_size'         => 'panel',
                'text_align'         => 'left',
                'link'               => true,
                'link_style'         => 'button',
                'link_text'          => 'Read more',
                'badge_style'        => 'badge',

                'class'              => ''
            )

        );
    },

    'events' => array(

        'init.site' => function($event, $app) {
            $app['scripts']->add('uikit-grid', 'vendor/assets/uikit/js/components/grid.min.js', array('uikit'));
        },

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('grid-slider-salt.edit', 'plugins/widgets/grid-slider-salt/views/edit.php', true);
        }

    )

);