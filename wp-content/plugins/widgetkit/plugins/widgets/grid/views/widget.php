<?php

// Id
$settings['id'] = substr(uniqid(), -3);

// Grid
$grid  = 'uk-grid-width-1-'.$settings['columns'];
$grid .= $settings['columns_small'] ? ' uk-grid-width-small-1-'.$settings['columns_small'] : '';
$grid .= $settings['columns_medium'] ? ' uk-grid-width-medium-1-'.$settings['columns_medium'] : '';
$grid .= $settings['columns_large'] ? ' uk-grid-width-large-1-'.$settings['columns_large'] : '';
$grid .= $settings['columns_xlarge'] ? ' uk-grid-width-xlarge-1-'.$settings['columns_xlarge'] : '';

if ($settings['grid'] == 'dynamic') {
    $options   = array();
    $options[] = ($settings['gutter_dynamic']) ? 'gutter: ' . $settings['gutter_dynamic'] : '';
    $options[] = ($settings['filter'] != 'none') ? 'controls: \'#wk-' . $settings['id'] . '\'' : '';
    $options   = implode(',', array_filter($options));
    $grid_js   = $options ? 'data-uk-grid="{' . $options . '}"' : 'data-uk-grid';
} else {
    $grid .= ' uk-grid uk-grid-match';
    $grid .= ($settings['gutter'] == 'collapse') ? ' uk-grid-collapse' : '' ;
    $grid .= ($settings['gutter'] == 'small') ? ' uk-grid-small' : '' ;
    $grid_js = 'data-uk-grid-match="{target:\'> div > .uk-panel\', row:true}" data-uk-grid-margin';
}

// Panel
$panel = 'uk-panel';
switch ($settings['panel']) {
    case 'box' :
        $panel .= ' uk-panel-box';
        break;
    case 'primary' :
        $panel .= ' uk-panel-box uk-panel-box-primary';
        break;
    case 'secondary' :
        $panel .= ' uk-panel-box uk-panel-box-secondary';
        break;
    case 'hover' :
        $panel .= ' uk-panel-hover';
        break;
    case 'header' :
        $panel .= ' uk-panel-header';
        break;
    case 'space' :
        $panel .= ' uk-panel-space';
        break;
}

// Media Width
$media_width = 'uk-width-' . $settings['media_breakpoint'] . '-' . $settings['media_width'];

switch ($settings['media_width']) {
    case '1-5':
        $content_width = '4-5';
        break;
    case '1-4':
        $content_width = '3-4';
        break;
    case '3-10':
        $content_width = '7-10';
        break;
    case '1-3':
        $content_width = '2-3';
        break;
    case '2-5':
        $content_width = '3-5';
        break;
    case '1-2':
    default:
        $content_width = '1-2';
        break;
}

$content_width = 'uk-width-medium-' . $content_width;

// Content Align
$content_align  = $settings['content_align'] ? 'uk-flex-middle' : '';

// Title Size
switch ($settings['title_size']) {
    case 'panel':
        $title_size = 'uk-panel-title';
        break;
    case 'large':
        $title_size = 'uk-heading-large uk-margin-top-remove';
        break;
    default:
        $title_size = 'uk-' . $settings['title_size'] . ' uk-margin-top-remove';
        break;
}

// Link Style
switch ($settings['link_style']) {
    case 'button':
        $link_style = 'uk-button';
        break;
    case 'primary':
        $link_style = 'uk-button uk-button-primary';
        break;
    case 'button-large':
        $link_style = 'uk-button uk-button-large';
        break;
    case 'primary-large':
        $link_style = 'uk-button uk-button-large uk-button-primary';
        break;
    default:
        $link_style = '';
        break;
}

// Badge Style
switch ($settings['badge_style']) {
    case 'badge':
        $badge_style = 'uk-badge';
        break;
    case 'success':
        $badge_style = 'uk-badge uk-badge-success';
        break;
    case 'warning':
        $badge_style = 'uk-badge uk-badge-warning';
        break;
    case 'danger':
        $badge_style = 'uk-badge uk-badge-danger';
        break;
    case 'text-muted':
        $badge_style  = 'uk-text-muted';
        $badge_style .= ($settings['badge_position'] == 'panel') ? ' uk-panel-badge' : '';
        break;
    case 'text-primary':
        $badge_style  = 'uk-text-primary';
        $badge_style .= ($settings['badge_position'] == 'panel') ? ' uk-panel-badge' : '';
        break;
}

// Media Border
$border = ($settings['media_border'] != 'none') ? 'uk-border-' . $settings['media_border'] : '';

// Animation
$animation = ($settings['animation'] != 'none') ? ' data-uk-scrollspy="{cls:\'uk-animation-' . $settings['animation'] . ' uk-invisible\', target:\'> div > .uk-panel\', delay:300}"' : '';

// Filter Tags
$tags = array();
foreach ($items as $i => $item) {
    if ($item['tags']) {
        $tags = array_merge($tags, $item['tags']);
    }
}
$tags = array_unique($tags);

// Filter Nav
$tabs_center = '';
if ($settings['filter'] == 'tabs') {

    $filter  = 'uk-tab';
    $filter .= ($settings['filter_align'] == 'right') ? ' uk-tab-flip' : '';
    $filter .= ($settings['filter_align'] != 'center') ? ' uk-margin' : '';
    $tabs_center  = ($settings['filter_align'] == 'center') ? 'uk-tab-center uk-margin' : '';

} elseif ($settings['filter'] != 'none') {

    switch ($settings['filter']) {
        case 'text':
            $filter = 'uk-subnav';
            break;
        case 'lines':
            $filter = 'uk-subnav uk-subnav-line';
            break;
        case 'nav':
            $filter = 'uk-subnav uk-subnav-pill';
            break;
    }

    $filter .= ' uk-flex-' . $settings['filter_align'];
}

?>

<?php if ($tags && $settings['filter'] != 'none') : ?>

    <?php if ($tabs_center) : ?>
    <div class="<?php echo $tabs_center; ?>">
    <?php endif ?>

    <ul id="wk-<?php echo $settings['id']; ?>" class="<?php echo $filter; ?>">

        <li class="uk-active" data-uk-filter=""><a href="#"><?php echo $app['translator']->trans('All'); ?></a></li>

        <?php foreach ($tags as $i => $tag) : ?>
        <li data-uk-filter="<?php echo $tag; ?>"><a href="#"><?php echo ucfirst($tag); ?></a></li>
        <?php endforeach; ?>

    </ul>

    <?php if ($tabs_center) : ?>
    </div>
    <?php endif ?>

<?php endif; ?>

<div class="<?php echo $grid; ?> uk-text-<?php echo $settings['text_align']; ?> <?php echo $settings['class']; ?>" <?php echo $grid_js ?> <?php echo $animation; ?>>

<?php foreach ($items as $i => $item) :

        // Social Buttons
        $socials = '';
        if ($settings['social_buttons']) {
            $socials .= $item['twitter'] ? '<div><a class="uk-icon-button uk-icon-twitter" href="'. $item['twitter'] .'"></a></div>': '';
            $socials .= $item['facebook'] ? '<div><a class="uk-icon-button uk-icon-facebook" href="'. $item['facebook'] .'"></a></div>': '';
            $socials .= $item['google-plus'] ? '<div><a class="uk-icon-button uk-icon-google-plus" href="'. $item['google-plus'] .'"></a></div>': '';
            $socials .= $item['email'] ? '<div><a class="uk-icon-button uk-icon-envelope-o" href="mailto:'. $item['email'] .'"></a></div>': '';
        }

        // Media Type
        $attrs = array();
        $width = $item['media.width'];
        $height = $item['media.height'];

        if ($item->type('media') == 'image') {
            $attrs['alt'] = $item['title'];
            $width = ($settings['image_width'] != 'auto') ? $settings['image_width'] : $width;
            $height = ($settings['image_height'] != 'auto') ? $settings['image_height'] : $height;
            
            if ($border || $settings['media_animation'] != 'none') {

                $attrs['class'] = '';

                if ($border) {
                    $attrs['class'] .= $border;
                }

                if ($settings['media_animation'] != 'none') {
                    $attrs['class']  .= ' uk-overlay-' . $settings['media_animation'];
                }
            }
        }

        if ($item->type('media') == 'video') {
            $attrs['class']    = 'uk-responsive-width';
            $attrs['controls'] = '';
        }

        if ($item->type('media') == 'iframe') {
            $attrs['class']    = 'uk-responsive-width';
        }

        if ($width) {
            $attrs['width'] = $width;
        }

        if ($height) {
            $attrs['height'] = $height;
        }

        if (($item->type('media') == 'image') && ($settings['image_width'] != 'auto' || $settings['image_height'] != 'auto')) {
            $media = $item->thumbnail('media', $width, $height, $attrs);
        } else {
            $media = $item->media('media', $attrs);
        }

        // Link and Overlay
        $overlay = '';
        $overlay_hover = '';

        if ($item['link']) {

            if ($settings['panel_link']) {

                $panel .= ($settings['panel'] == 'box') ? ' uk-panel-box-hover' : '';
                $panel .= ($settings['panel'] == 'primary') ? ' uk-panel-box-primary-hover' : '';
                $panel .= ($settings['panel'] == 'secondary') ? ' uk-panel-box-secondary-hover' : '';

                if (($settings['media_overlay'] == 'icon') ||
                    ($socials && $settings['media_overlay'] == 'social-buttons') ||
                    ($item['media'] && $settings['media'] && $settings['media_animation'] != 'none')) {
                    $panel .= ' uk-overlay-hover';
                }

            } elseif ($settings['media_overlay'] == 'link' || $settings['media_overlay'] == 'icon') {
                $overlay = '<a class="uk-position-cover" href="' . $item['link'] . '"></a>';
                $overlay_hover = ' uk-overlay-hover';
            }

            if ($settings['media_overlay'] == 'icon') {
                $overlay = '<div class="uk-overlay-panel uk-overlay-background uk-overlay-icon uk-overlay-' . $settings['overlay_animation'] . '"></div>' . $overlay;
            }

        }

        if ($socials && $settings['media_overlay'] == 'social-buttons') {

            $overlay  = '<div class="uk-overlay-panel uk-overlay-background uk-overlay-' . $settings['overlay_animation'] . ' uk-flex uk-flex-center uk-flex-middle uk-text-center"><div>';
            $overlay .= '<div class="uk-grid uk-grid-small" data-uk-grid-margin>' . $socials . '</div>';
            $overlay .= '</div></div>';

            $overlay_hover = !$settings['panel_link'] ? ' uk-overlay-hover' : '';
        }

        if ($overlay || ($settings['panel_link'] && $settings['media_animation'] != 'none')) {
            $media  = '<div class="uk-overlay' . $overlay_hover . ' ' . $border . '">' . $media . $overlay . '</div>';
        }

        // Filter
        $filter = '';
        if ($item['tags'] && $settings['filter'] != 'none') {
            $filter = ' data-uk-filter="' . implode(',', $item['tags']) . '"';
        }

    ?>

    <div<?php echo $filter; ?>>
        <div class="<?php echo $panel; ?><?php if ($settings['animation'] != 'none') echo ' uk-invisible'; ?>">

            <?php if ($item['badge'] && $settings['badge'] && $settings['badge_position'] == 'panel') : ?>
            <div class="uk-panel-badge <?php echo $badge_style; ?>"><?php echo $item['badge']; ?></div>
            <?php endif; ?>

            <?php if ($item['media'] && $settings['media'] && in_array($settings['media_align'], array('teaser', 'top'))) : ?>
            <div class="uk-text-center <?php echo (($settings['media_align'] == 'teaser') ? 'uk-panel-teaser' : 'uk-margin-bottom'); ?>"><?php echo $media; ?></div>
            <?php endif; ?>

            <?php if ($item['media'] && $settings['media'] && in_array($settings['media_align'], array('left', 'right'))) : ?>
            <div class="uk-grid <?php echo $content_align; ?>" data-uk-grid-margin>
                <div class="<?php echo $media_width ?><?php if ($settings['media_align'] == 'right') echo ' uk-float-right uk-flex-order-last-' . $settings['media_breakpoint'] ?>">
                    <?php echo $media; ?>
                </div>
                <div class="<?php echo $content_width ?>">
                    <div class="uk-panel">
            <?php endif; ?>

            <?php if ($item['link'] && $settings['panel_link']) : ?>
            <a class="uk-position-cover" href="<?php echo $item['link']; ?>"></a>
            <?php endif; ?>

            <?php if ($item['title'] && $settings['title']) : ?>
            <h3 class="<?php echo $title_size; ?>">

                <?php if ($item['link']) : ?>
                    <a class="uk-link-reset" href="<?php echo $item['link']; ?>"><?php echo $item['title']; ?></a>
                <?php else : ?>
                    <?php echo $item['title']; ?>
                <?php endif; ?>

                <?php if ($item['badge'] && $settings['badge'] && $settings['badge_position'] == 'title') : ?>
                <span class="uk-margin-small-left <?php echo $badge_style; ?>"><?php echo $item['badge']; ?></span>
                <?php endif; ?>
                    
            </h3>
            <?php endif; ?>

            <?php if ($item['media'] && $settings['media'] && $settings['media_align'] == 'bottom') : ?>
            <div class="uk-margin uk-text-center"><?php echo $media; ?></div>
            <?php endif; ?>

            <?php if ($item['content'] && $settings['content']) : ?>
            <div class="uk-margin"><?php echo $item['content']; ?></div>
            <?php endif; ?>

            <?php if ($socials && ($settings['media_overlay'] != 'social-buttons')) : ?>
            <div class="uk-grid uk-grid-small uk-flex-<?php echo $settings['text_align']; ?>" data-uk-grid-margin><?php echo $socials; ?></div>
            <?php endif; ?>

            <?php if ($item['link'] && $settings['link']) : ?>
            <p class="uk-margin"><a<?php if($link_style) echo ' class="' . $link_style . '"'; ?> href="<?php echo $item['link']; ?>"><?php echo $app['translator']->trans($settings['link_text']); ?></a></p>
            <?php endif; ?>

            <?php if ($item['media'] && $settings['media'] && in_array($settings['media_align'], array('left', 'right'))) : ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>

<?php endforeach; ?>

</div>
