<?php if ($this['config']->get('article')=='tm-article-blog') : ?>
    <article id="item-<?php the_ID(); ?>" class="uk-article" data-permalink="<?php the_permalink(); ?>">

    <?php if (has_post_thumbnail()) : ?>
        <div class="tm-featured-image">
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('full'); ?></a>
        </div>
    <?php endif; ?>

    <div class="uk-grid">
        <div class="tm-article-meta uk-width-1-1 uk-width-large-1-4">

            <div class="tm-article-date">
                <?php printf('<time datetime="'.get_the_date('Y-m-d').'">'.get_the_date('d') . ' / ' . get_the_date('m') . ' / ' . get_the_date('Y') . '</time>'); ?>
            </div>

            <div class="tm-article-author">
                <span>
                    <?php printf('<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>'); ?>
                </span>
            </div>

            <div class="tm-article-category">
                <span>
                    <?php printf(get_the_category_list(', ')); ?>
                </span>
            </div>

        </div>

        <div class="uk-width-1-1 uk-width-large-3-4">

            <h1 class="uk-article-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

            <div class="tm-article-columns">
                <?php the_content(''); ?>
            </div>

            <p class="tm-more">

                <a class="uk-button" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php _e('Continue Reading', 'warp'); ?></a>

                <?php if(comments_open() || get_comments_number()) : ?>
                    <?php comments_popup_link(__('No Comments', 'warp'), __('1 Comment', 'warp'), __('% Comments', 'warp'), "uk-button", ""); ?>
                <?php endif; ?>

            </p>

            <?php edit_post_link(__('Edit this post.', 'warp'), '<p><i class="uk-icon-pencil"></i> ','</p>'); ?>

        </div>
    </div>

    </article>
<?php else : ?>

    <article id="item-<?php the_ID(); ?>" class="uk-article" data-permalink="<?php the_permalink(); ?>">

    <?php if (has_post_thumbnail()) : ?>
        <?php
        $width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
        $height = get_option('thumbnail_size_h'); //get the height of the thumbnail setting
        ?>
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(array($width, $height), array('class' => '')); ?></a>
    <?php endif; ?>

    <h1 class="uk-article-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

    <p class="uk-article-meta">
        <?php
            $date = '<time datetime="'.get_the_date('Y-m-d').'">'.get_the_date().'</time>';
            printf(__('Written by %s on %s. Posted in %s', 'warp'), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date, get_the_category_list(', '));
        ?>
    </p>

    <?php the_content(''); ?>

    <ul class="uk-subnav uk-subnav-line">
        <li><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php _e('Continue Reading', 'warp'); ?></a></li>
        <?php if(comments_open() || get_comments_number()) : ?>
            <li><?php comments_popup_link(__('No Comments', 'warp'), __('1 Comment', 'warp'), __('% Comments', 'warp'), "", ""); ?></li>
        <?php endif; ?>
    </ul>

    <?php edit_post_link(__('Edit this post.', 'warp'), '<p><i class="uk-icon-pencil"></i> ','</p>'); ?>

    </article>

<?php endif; ?>
