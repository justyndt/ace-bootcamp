<?php
defined('ABSPATH') || exit; // Exit if accessed directly

// block variables
$gallery_title    = get_field('gallery_title');
$gallery_subtitle = get_field('gallery_subtitle');
$gab_gallery      = get_field('gab_gallery');

// bail if there are no profiles
if ( !$gab_gallery ) return;

// Create container classes
$classes         = ['gab-gallery not-prose alignfull my-14 lg:my-28 px-3'];
$classes[]       = is_admin() ? 'gab-gallery-admin block-admin not-prose' : '';
$classes[]       = !empty($block['align']) ? sprintf('align%s', $block['align']) : '';
$classes[]       = !empty($block['className']) ? $block['className'] : '';
$classes         = array_filter($classes);
?>

<div class="<?php echo implode(' ', $classes); ?>">
	<div class="col-span-7">
		<div class="mx-auto max-w-screen-2xl w-full">

		<?php
			$args = [
				'title'    => $gallery_title,
				'subtitle' => $gallery_subtitle,
			];

			get_template_part( 'template-parts/layout/block', 'title', $args );
		?>

		<div class="columns-2 md:columns-3 lg:columns-4 xl:columns-4 !gap-3">
			<?php
				foreach( $gab_gallery as $item ) :
					// vars
					$img = wp_get_attachment_image( $item, 'large', false, ['class' => 'size-full mb-3 rounded-lg'] );
			?>
			<div class="rounded-md overflow-clip">
				<?php echo $img; ?>
			</div>
			<?php endforeach; ?>
		</div>

		</div>
	</div>
</div>
