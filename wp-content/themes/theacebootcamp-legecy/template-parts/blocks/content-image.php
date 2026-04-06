<?php
defined('ABSPATH') || exit; // Exit if accessed directly

// block variables
$content_image_title = get_field('content_image_title');
$content_image_sub_title = get_field('content_image_sub_title');
$content_image = get_field('content_image');
$content_order = get_field('content_order');
$content = get_field('content');
$profile = get_field('profile');
$profile_content = get_field( 'profile_content', $profile );

// bail if there are no profiles
if ( !$profile ) return;

// Create container classes
$classes         = ['content-image not-prose alignfull my-8 md:my-14 xl:my-28 px-3'];
$classes[]       = is_admin() ? 'blurb-admin block-admin' : '';
$classes[]       = !empty($block['align']) ? sprintf('align%s', $block['align']) : '';
$classes[]       = !empty($block['className']) ? $block['className'] : '';
$classes         = array_filter($classes);

// create vars from post object
$profile_image = get_the_post_thumbnail( $profile, 'large', ['class' => 'size-full object-cover']);
?>

<?php if ( $profile_content ) : ?>
<div class="<?php echo implode(' ', $classes); ?>">
	<div class="col-span-7">

		<?php if ( $content_image_title ) : ?>
		<h2 class="text-center text-4xl lg:text-6xl font-bold font-condensed uppercase mb-6 px-5">
			<?php echo $content_image_title; ?>
		</h2>
		<?php endif; ?>

		<div class="mx-auto max-w-screen-2xl w-full grid lg:grid-cols-2 bg-off-white/20 rounded-xl overflow-clip xl:w-10/12">

		<?php if ( $profile_image ) : ?>
		<div class="h-auto overflow-clip">
			<?php echo $profile_image; ?>
		</div>
		<?php endif; ?>

		<?php if ( $profile_content ) : ?>
		<div class="p-7 lg:p-14 flex items-start justify-center flex-col gap-5">
			<?php echo $profile_content; ?>
		</div>
		<?php endif; ?>

		</div>
	</div>
</div>
<?php endif;
