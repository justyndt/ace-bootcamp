<?php
defined('ABSPATH') || exit; // Exit if accessed directly

// block variables
$blurb_sub_title = get_field('blurb_sub_title');
$blurb_title     = get_field('blurb_title');
$blurb           = get_field('blurb');

// bail if there are no profiles
if ( !$blurb ) return;

// Create container classes
$classes         = ['blurb not-prose alignfull my-8 md:my-14 xl:my-28 px-3'];
$classes[]       = is_admin() ? 'blurb-admin block-admin' : '';
$classes[]       = !empty($block['align']) ? sprintf('align%s', $block['align']) : '';
$classes[]       = !empty($block['className']) ? $block['className'] : '';
$classes         = array_filter($classes);
?>

<div class="<?php echo implode(' ', $classes); ?>">
	<div class="col-span-7">
		<div class="mx-auto max-w-screen-2xl w-full flex flex-col gap-2 lg:gap-3 xl:w-7/12">

		<?php if ( $blurb_sub_title ) : ?>
		<h3 class="text-xl text-foreground/80 font-bold font-condensed uppercase text-center leading-none">
			<?php echo $blurb_sub_title; ?>
		</h3>
		<?php endif; ?>

		<?php if ( $blurb_title ) : ?>
		<h2 class="text-2xl md:text-4xl xl:text-6xl mx-auto w-full xl:w-10/12 font-bold font-condensed uppercase text-center">
			<?php echo $blurb_title; ?>
		</h2>
		<?php endif; ?>

		<?php if ( $blurb ) : ?>
		<h2 class="text-base md:text-md xl:text-xl font-sans text-center">
			<?php echo $blurb; ?>
		</h2>
		<?php endif; ?>


		</div>
	</div>
</div>
