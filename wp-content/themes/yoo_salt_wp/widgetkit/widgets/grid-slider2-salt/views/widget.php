<?php
/**
* @package   Salt
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// Id
$settings['id'] = substr(uniqid(), -3);

// Grid
$grid  = '';
if ($settings['grid'] == 'dynamic') {
    $options   = array();
    $options[] = ($settings['gutter_dynamic']) ? 'gutter: ' . $settings['gutter_dynamic'] : '';
    $options[] = ($settings['filter'] != 'none') ? 'controls: \'#wk-' . $settings['id'] . '\'' : '';
    $options   = implode(',', array_filter($options));
    $grid_js   = $options ? 'data-uk-grid="{' . $options . '}"' : 'data-uk-grid';
} else {
    $grid .= 'uk-grid uk-grid-match';
    $grid .= ($settings['gutter'] == 'collapse') ? ' uk-grid-collapse' : '' ;
    $grid .= ($settings['gutter'] == 'small') ? ' uk-grid-small' : '' ;
    // $grid_js = 'data-uk-grid-match="{target:\'> div > .uk-panel\', row:true}" data-uk-grid-margin';
    $grid_js = '';
}

// Panel
foreach (array(0,1,2,3) as $i) {
    $panel[$i] = 'uk-panel';

    switch ($settings['panel'.$i]) {
        case 'box' :
            $panel[$i] .= ' uk-panel-box';
            break;
        case 'primary' :
            $panel[$i] .= ' uk-panel-box uk-panel-box-primary';
            break;
        case 'secondary' :
            $panel[$i] .= ' uk-panel-box uk-panel-box-secondary';
            break;
        case 'space' :
            $panel[$i] .= ' uk-panel-space';
            break;
    }
}

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
        break;
    case 'text-primary':
        $badge_style  = 'uk-text-primary';
        break;
}

// Media Alignment
$media_align = $settings['media_align'] == 'left' ? '' : 'uk-flex-row-reverse';

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

<div class="<?php echo $grid; ?> <?php echo $settings['text_align'] == "default" ? "uk-text-left" : "uk-text-".$settings['text_align'].""; ?> <?php echo $settings['class']; ?>" <?php echo $grid_js ?> <?php echo $animation; ?>>

<?php $e = 0; foreach ($items as $i => $item) :

    // Filter
    $filter = '';
    if ($item['tags'] && $settings['filter'] != 'none') {
        $filter = ' data-uk-filter="' . implode(',', $item['tags']) . '"';
    }

    // Alternate Widths
    if ($i % 2) {
        $left = 0;
        if ($settings['first_double']) {
            $special = ($e % 2) ? 1 : 0;
        } else {
            $special = ($e % 2) ? 0 : 1;
        }
        $e++;
    } else {
        $left = 1;
        if ($settings['first_double']) {
            $special = ($e % 2) ? 0 : 1;
        } else {
            $special = ($e % 2) ? 1 : 0;
        }
    }

    $grid_width = ($special) ? 'uk-width-medium-2-3' : 'uk-width-medium-1-3';
?>

    <div class="<?php echo $grid_width; ?>"<?php echo $filter; ?>>
        <div class="<?php echo $panel[$i % count($panel)]; echo $special ? ' uk-flex uk-flex-bottom' : ''; ?><?php if ($settings['animation'] != 'none') echo ' uk-invisible'; ?>">

        <?php if ($special) : ?>

            <?php if ($item['media']) : ?>
            <div class="uk-grid uk-flex-middle <?php echo $media_align ?>" data-uk-grid-margin>
                <div class="uk-width-medium-1-2">
                    <?php echo $this->render('plugins/widgets/' . $widget->getConfig('name')  . '/views/_media.php', compact('item', 'settings', 'widget', 'special')); ?>
                </div>
                <div class="uk-width-medium-1-2">
                    <div class="uk-panel">
            <?php endif; ?>

            <?php if ($item['title'] && $settings['title']) : ?>
            <h3 class="<?php echo $title_size; ?>">
                <?php if ($item['link'] && $settings['link']) : ?>
                <a class="uk-link-reset" href="<?php echo $item['link']; ?>" title="<?php echo $item['title']; ?>">
                <?php endif; ?>

                <?php echo $item['title']; echo isset($item['badge']) ? ' <span class="' . $badge_style . ' uk-margin-small-left">'.' '.$item['badge'].'</span>' : ''; ?>

                <?php if ($item['link'] && $settings['link']): ?>
                </a>
                <?php endif; ?></h3>
            <?php endif; ?>

            <?php if ($item['content'] && $settings['content']) : ?>
            <div class="uk-margin"><?php echo $item['content']; ?></div>
            <?php endif; ?>

            <?php if ($item['link'] && $settings['link']) : ?>
            <p class="uk-margin"><a<?php if($link_style) echo ' class="' . $link_style . '"'; ?> href="<?php echo $item['link']; ?>"><?php echo $app['translator']->trans($settings['link_text']); ?></a></p>
            <?php endif; ?>

            <?php if ($item['media']) : ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        <?php else : ?>

            <?php if ($item['media']) : ?>
            <div class="uk-margin uk-text-center uk-panel-teaser">
                <?php echo $this->render('plugins/widgets/' . $widget->getConfig('name')  . '/views/_media.php', compact('item', 'settings', 'widget')); ?>
            </div>
            <?php endif; ?>

            <?php if ($item['title'] && $settings['title']) : ?>
            <h3 class="<?php echo $title_size; ?> <?php echo $settings['text_align'] == "default" ? "uk-text-center" : ""?>">
                <?php if ($item['link'] && $settings['link']) : ?>
                <a class="uk-link-reset" href="<?php echo $item['link']; ?>" title="<?php echo $item['title']; ?>">
                <?php endif; ?>

                <?php echo $item['title']; echo isset($item['badge']) ? ' <span class="' . $badge_style . ' uk-margin-small-left">'.' '.$item['badge'].'</span>' : ''; ?>

                <?php if ($item['link'] && $settings['link']): ?>
                </a>
                <?php endif; ?>
            </h3>
            <?php endif; ?>

            <?php if ($item['content'] && $settings['content']) : ?>
            <div class="uk-margin <?php echo $settings['text_align'] == "default" ? "uk-text-center" : ""?>"><?php echo $item['content']; ?></div>
            <?php endif; ?>

        <?php endif; ?>

        </div>
    </div>

<?php endforeach; ?>

</div>