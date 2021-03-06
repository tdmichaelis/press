<?php

// Buttons
$button_link = ($button_link) ? 'class="' . $button_link . '"' : '';
$button_lightbox = ($button_lightbox) ? 'class="' . $button_lightbox . '"' : '';

$buttons = array();
if ($item['link'] && $settings['link']) {
    $buttons['link'] = '<a ' . $button_link . ' href="' . $item['link'] . '">' . $app['translator']->trans($settings['link_text']) . '</a>';
}
if ($settings['lightbox'] && $settings['lightbox_link']) {
    $buttons['lightbox'] = '<a ' . $button_lightbox . ' ' . $lightbox . ' data-uk-lightbox="{group:\'.wk-2' . $settings['id'] . '\'}" ' . $lightbox_caption . '>' . $app['translator']->trans($settings['lightbox_text']) . '</a>';
}

// Overlays
$hover_overlay    = ($settings['hover_overlay']) ? 'uk-overlay-' . $settings['overlay_animation'] : 'uk-ignore';
$background = ($settings['overlay_background'] == 'hover') ? 'uk-overlay-' . $settings['overlay_animation'] : 'uk-ignore';

?>

<div class="uk-panel<?php if ($settings['animation'] != 'none') echo ' uk-invisible'; ?>">

    <figure class="uk-overlay uk-overlay-hover <?php echo $border; ?>">

        <?php echo $thumbnail; ?>

        <?php if ($settings['overlay_background'] != 'none') : ?>
        <div class="uk-overlay-panel uk-overlay-background <?php echo $background; ?>"></div>
        <?php endif; ?>

        <div class="uk-overlay-panel <?php echo $hover_overlay; ?> uk-flex uk-flex-center uk-flex-middle uk-text-center">
            <div>

                <?php if ($item['title'] && $settings['title']) : ?>
                <h3 class="<?php echo $title_size; ?> uk-margin-bottom-remove"><?php echo $item['title']; ?></h3>
                <?php endif; ?>

                <?php if ($item['content'] && $settings['content']) : ?>
                <div class="uk-margin"><?php echo $item['content']; ?></div>
                <?php endif; ?>

                <?php if ($buttons) : ?>
                <div class="uk-grid uk-grid-small uk-flex-center" data-uk-grid-margin>

                    <?php if ($buttons['link']) : ?>
                    <div><?php echo $buttons['link']; ?></div>
                    <?php endif; ?>

                    <?php if ($buttons['lightbox']) : ?>
                    <div><?php echo $buttons['lightbox']; ?></div>
                    <?php endif; ?>

                </div>
                <?php endif; ?>

            </div>
        </div>

        <?php if (!$buttons) : ?>
            <?php if ($settings['lightbox']) : ?>
                <a class="uk-position-cover" <?php echo $lightbox; ?> data-uk-lightbox="{group:'.wk-1<?php echo $settings['id']; ?>'}" <?php echo $lightbox_caption; ?>></a>
            <?php elseif ($item['link']) : ?>
                <a class="uk-position-cover" href="<?php echo $item['link']; ?>"></a>
            <?php endif; ?>
        <?php endif; ?>

    </figure>

</div>