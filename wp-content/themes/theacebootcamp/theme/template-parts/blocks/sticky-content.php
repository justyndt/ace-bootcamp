<?php
defined('ABSPATH') || exit; // Exit if accessed directly

// block variables
$sticky_content_title     = get_field('sticky_content_title');
$sticky_content_sub_title = get_field('sticky_content_sub_title');
$sticky_content_image_id  = get_field('sticky_content_image');
$sticky_content_image     = wp_get_attachment_image($sticky_content_image_id, 'large', false, ['class' => 'size-fill object-cover']);
$sticky_content           = get_field('sticky_content');

// bail if there are no content
if ( !$sticky_content ) return;

// Create container classes
$classes         = ['sticky-content not-prose alignfull my-8 md:my-14 xl:my-28 px-3'];
$classes[]       = is_admin() ? 'sticky-content-admin block-admin' : '';
$classes[]       = !empty($block['align']) ? sprintf('align%s', $block['align']) : '';
$classes[]       = !empty($block['className']) ? $block['className'] : '';
$classes         = array_filter($classes);
?>

<div class="<?php echo implode(' ', $classes); ?>">
	<div class="col-span-7">
		<div class="mx-auto max-w-screen-2xl w-full gap-8 lg:gap-11 xl:w-10/12 grid lg:grid-cols-2 items-start">

			<div class="overflow-clip 2xl:sticky 2xl:top-6 rounded-md">
				<?php echo $sticky_content_image; ?>
			</div>

			<div class="flex flex-col gap-2">
				<?php if ( $sticky_content_sub_title ) : ?>
				<h3 class="text-xl xl:text-2xl text-foreground/80 font-bold font-condensed uppercase">
					<?php echo $sticky_content_sub_title; ?>
				</h3>
				<?php endif; ?>

				<?php if ( $sticky_content_title ) : ?>
				<h2 class="text-2xl md:text-3xl xl:text-4xl font-bold font-condensed uppercase">
					<?php echo $sticky_content_title; ?>
				</h2>
				<?php endif; ?>

				<?php if ( $sticky_content ) : ?>
				<div class="mt-4 text-lg">
					<?php echo $sticky_content; ?>
				</div>
				<?php endif; ?>
			</div>

		</div>
	</div>
</div>
