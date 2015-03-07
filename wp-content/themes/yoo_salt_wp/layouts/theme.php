<?php
/**
* @package   Salt
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// get theme configuration
include($this['path']->path('layouts:theme.config.php'));

?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>"  data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>

<head>
<?php echo $this['template']->render('head'); ?>
</head>

<body class="<?php echo $this['config']->get('body_classes'); ?>">

	<div class="tm-page">

		<div class="uk-container uk-container-center <?php echo $this['config']->get('container_appearance'); ?>">

			<?php if ($this['widgets']->count('toolbar-l + toolbar-r')) : ?>
				<div class="tm-toolbar uk-visible-large">
					<div class="tm-block<?php echo array_key_exists('toolbar', $block_classes) ? $block_classes['toolbar'] : ''; ?>">
						<div class="<?php echo $this['config']->get('block.toolbar.block_full_width') ? '' : 'uk-container uk-container-center'; ?> uk-clearfix uk-hidden-small">
							<?php if ($this['widgets']->count('toolbar-l')) : ?>
							<div class="uk-float-left"><?php echo $this['widgets']->render('toolbar-l'); ?></div>
							<?php endif; ?>

							<?php if ($this['widgets']->count('toolbar-r')) : ?>
							<div class="uk-float-right"><?php echo $this['widgets']->render('toolbar-r'); ?></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="tm-navbar">

				<?php if ($this['widgets']->count('logo + headerbar + menu + search')) : ?>
				<nav class="uk-navbar <?php if ($this['config']->get('contrast_top_navigation')) echo 'tm-navbar-contrast'; ?> <?php if ($this['config']->get('absolute_top_navigation')) echo 'tm-navbar-absolute'; ?>" <?php if ($this['config']->get('fixed_navigation')) echo 'data-uk-sticky="{top:-500, animation: \'uk-animation-slide-top\'}"'; ?>>

					<div class="uk-visible-large uk-clearfix <?php echo array_key_exists('headerbar', $block_classes) ? $block_classes['headerbar'].' ' : ''; echo $this['config']->get('block.headerbar.block_full_width') ? '' : 'uk-container uk-container-center'; ?> ">

						<?php if ($this['widgets']->count('logo')) : ?>
						<a class="tm-logo uk-navbar-brand uk-float-left" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
						<?php endif; ?>

						<?php if ($this['widgets']->count('menu')) : ?>
							<a href="#overlay-menu" class="tm-overlay-toggle tm-icon uk-float-right" data-uk-modal="{target: '#overlay-menu', center: true}">
								<div class="tm-icon-menu"></div>
							</a>
						<?php endif; ?>

						<?php if ($this['widgets']->count('search')) : ?>
						<div class="uk-navbar-flip uk-visible-large uk-float-right">
							<div class="uk-navbar-content"><?php echo $this['widgets']->render('search'); ?></div>
						</div>
						<?php endif; ?>

						<?php if ($this['widgets']->count('navbar-menu')) : ?>
						<div class="tm-navbar-nav uk-navbar-flip uk-float-right">
							<?php echo $this['widgets']->render('navbar-menu'); ?>
						</div>
						<?php endif; ?>

						<?php echo $this['widgets']->render('headerbar'); ?>

					</div>

					<?php if ($this['config']->get('totop_scroller', true)) : ?>
					<div data-uk-smooth-scroll data-uk-sticky="{top:-200}">
						<a class="tm-totop-scroller uk-animation-slide-top"  href="#"></a>
					</div>
					<?php endif; ?>

					<?php if ($this['widgets']->count('offcanvas')) : ?>
					<div class="uk-hidden-large">
						<a href="#offcanvas" class="uk-navbar-toggle" data-uk-offcanvas></a>
					</div>
					<?php endif; ?>

					<?php if ($this['widgets']->count('logo-small')) : ?>
					<div class="uk-navbar-content uk-navbar-center uk-hidden-large"><a class="tm-logo-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a></div>
					<?php endif; ?>

				</nav>
				<?php endif; ?>

			</div>

			<?php if ($this['widgets']->count('top-a')) : ?>
				<div class="tm-block<?php echo array_key_exists('top-a', $block_classes) ? $block_classes['top-a'] : ''; ?>">
					<?php if (!$this['config']->get('block.top-a.block_full_width')) : ?>
					<div class="uk-container uk-container-center">
					<?php endif; ?>
						<section class="<?php echo $grid_classes['top-a']; echo $display_classes['top-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-a', array('layout'=>$this['config']->get('grid.top-a.layout'))); ?></section>
					<?php if (!$this['config']->get('block.top-a.block_full_width')) : ?>
					</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('top-b')) : ?>
				<div class="tm-block<?php echo array_key_exists('top-b', $block_classes) ? $block_classes['top-b'] : ''; ?>">
					<?php if (!$this['config']->get('block.top-b.block_full_width')) : ?>
					<div class="uk-container uk-container-center">
					<?php endif; ?>
						<section class="<?php echo $grid_classes['top-b']; echo $display_classes['top-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-b', array('layout'=>$this['config']->get('grid.top-b.layout'))); ?></section>
					<?php if (!$this['config']->get('block.top-b.block_full_width')) : ?>
					</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('top-c')) : ?>
				<div class="tm-block<?php echo array_key_exists('top-c', $block_classes) ? $block_classes['top-c'] : ''; ?>">
					<?php if (!$this['config']->get('block.top-c.block_full_width')) : ?>
					<div class="uk-container uk-container-center">
					<?php endif; ?>
						<section class="<?php echo $grid_classes['top-c']; echo $display_classes['top-c']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-c', array('layout'=>$this['config']->get('grid.top-c.layout'))); ?></section>
					<?php if (!$this['config']->get('block.top-c.block_full_width')) : ?>
					</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="tm-block<?php echo array_key_exists('main', $block_classes) ? $block_classes['main'] : ''; ?>">
				<?php if (!$this['config']->get('block.main.block_full_width')) : ?>
				<div class="uk-container uk-container-center">
				<?php endif; ?>

					<?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>
					<div class="tm-middle uk-grid<?php echo array_key_exists('main', $grid_classes) ? $grid_classes['main'] : '' ?>" data-uk-grid-match data-uk-grid-margin>

						<?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
						<div class="<?php echo $columns['main']['class'] ?>">

							<?php if ($this['widgets']->count('main-top')) : ?>
							<section class="<?php echo $grid_classes['main-top']; echo $display_classes['main-top']; echo $this['config']->get("block.main.gutter_collapse") ? ' uk-grid-collapse' : ''; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?></section>
							<?php endif; ?>

							<?php if ($this['config']->get('system_output', true)) : ?>
							<main class="tm-content">

								<?php if ($this['widgets']->count('breadcrumbs')) : ?>
								<?php echo $this['widgets']->render('breadcrumbs'); ?>
								<?php endif; ?>

								<?php echo $this['template']->render('content'); ?>

							</main>
							<?php endif; ?>

							<?php if ($this['widgets']->count('main-bottom')) : ?>
							<section class="<?php echo $grid_classes['main-bottom']; echo $display_classes['main-bottom']; echo $this['config']->get("block.main.gutter_collapse") ? ' uk-grid-collapse' : ''; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?></section>
							<?php endif; ?>

						</div>
						<?php endif; ?>

			            <?php foreach($columns as $name => &$column) : ?>
			            <?php if ($name != 'main' && $this['widgets']->count($name)) : ?>
			            <aside class="<?php echo $column['class'] ?>"><?php echo $this['widgets']->render($name) ?></aside>
			            <?php endif ?>
			            <?php endforeach ?>

					</div>
					<?php endif; ?>

				<?php if (!$this['config']->get('block.main.block_full_width')) : ?>
				</div>
				<?php endif; ?>
			</div>

			<?php if ($this['widgets']->count('bottom-a')) : ?>
				<div class="tm-block<?php echo array_key_exists('bottom-a', $block_classes) ? $block_classes['bottom-a'] : ''; ?>">
					<?php if (!$this['config']->get('block.bottom-a.block_full_width')) : ?>
					<div class="uk-container uk-container-center">
					<?php endif; ?>
						<section class="<?php echo $grid_classes['bottom-a']; echo $display_classes['bottom-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-a', array('layout'=>$this['config']->get('grid.bottom-a.layout'))); ?></section>
					<?php if (!$this['config']->get('block.bottom-a.block_full_width')) : ?>
					</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('bottom-b')) : ?>
				<div class="tm-block<?php echo array_key_exists('bottom-b', $block_classes) ? $block_classes['bottom-b'] : ''; ?>">
					<?php if (!$this['config']->get('block.bottom-b.block_full_width')) : ?>
					<div class="uk-container uk-container-center">
					<?php endif; ?>
						<section class="<?php echo $grid_classes['bottom-b']; echo $display_classes['bottom-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-b', array('layout'=>$this['config']->get('grid.bottom-b.layout'))); ?></section>
					<?php if (!$this['config']->get('block.bottom-b.block_full_width')) : ?>
					</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('bottom-c')) : ?>
				<div class="tm-block<?php echo array_key_exists('bottom-c', $block_classes) ? $block_classes['bottom-c'] : ''; ?>">
					<?php if (!$this['config']->get('block.bottom-c.block_full_width')) : ?>
					<div class="uk-container uk-container-center">
					<?php endif; ?>
						<section class="<?php echo $grid_classes['bottom-c']; echo $display_classes['bottom-c']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-c', array('layout'=>$this['config']->get('grid.bottom-c.layout'))); ?></section>
					<?php if (!$this['config']->get('block.bottom-c.block_full_width')) : ?>
					</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('footer-l + footer-r + debug') || $this['config']->get('warp_branding', true)) : ?>
				<footer class="tm-footer">
					<div class="tm-block<?php echo array_key_exists('footer', $block_classes) ? $block_classes['footer'] : ''; ?>">
						<?php if (!$this['config']->get('block.footer.block_full_width')) : ?>
						<div class="uk-container uk-container-center">
						<?php endif; ?>
							<div class="uk-grid" data-uk-grid-margin="">
                                <?php if ($this['widgets']->count('footer-l')) : ?>
                                <div class="uk-width-medium-1-2">

                                	<?php echo $this['widgets']->render('footer-l'); ?>
                                	<?php
                                		$this->output('warp_branding');
                                		echo $this['widgets']->render('debug');
                                	?>
                                </div>
                                <?php endif; ?>
                                <?php if ($this['widgets']->count('footer-r')) : ?>
                                <div class="uk-width-medium-1-2 uk-clearfix">
                                	<div class="uk-float-right">
                                		<?php echo $this['widgets']->render('footer-r'); ?>
                                	</div>
                                </div>
                                <?php endif; ?>
                            </div>
						<?php if (!$this['config']->get('block.footer.block_full_width')) : ?>
						</div>
						<?php endif; ?>
					</div>
				</footer>
			<?php endif; ?>
			<?php echo $this->render('footer'); ?>
		</div>
	</div>

	<?php if ($this['widgets']->count('offcanvas')) : ?>
	<div id="offcanvas" class="uk-offcanvas uk-text-center">
		<div class="uk-offcanvas-bar"><?php echo $this['widgets']->render('offcanvas'); ?></div>
	</div>
	<?php endif; ?>

	<?php if ($this['widgets']->count('menu')) : ?>
	<div id="overlay-menu" class="tm-overlay-menu uk-modal">

		<a class="uk-modal-close tm-modal-close tm-icon tm-overlay-toggle">
			<div class="tm-icon-close"></div>
		</a>

		<div class="uk-modal-dialog">
			<?php echo $this['widgets']->render('menu'); ?>
		</div>
	</div>
	<?php endif; ?>

</body>
</html>