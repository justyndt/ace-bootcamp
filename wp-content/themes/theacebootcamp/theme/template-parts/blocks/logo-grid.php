<?php
defined('ABSPATH') || exit; // Exit if accessed directly

// block variables
$logo_grid_title    = get_field('logo_grid_title');
$logo_grid_subtitle = get_field('logo_grid_subtitle');
$logo_grid          = get_field('logo_grid');
$column_count       = (int) get_field('column_count');
$image_attributes   = ['class' => '!size-full !aspect-video !mix-blend-multiply !object-contain'];
$column_classes     = ['rounded-md p-8 flex items-center justify-center max-h-36 lg:max-h-40 bg-white border border-zinc-200'];

match ($column_count) {
	1       => $column_classes[] = 'basis-1/1 shrink-0',
	2       => $column_classes[] = 'basis-1/2 shrink-0',
	3       => $column_classes[] = 'basis-1/1 sm:basis-1/2 md:basis-1/3 grow-0',
	4       => $column_classes[] = 'basis-1/2 md:basis-1/3 xl:basis-1/4 grow-0',
	5       => $column_classes[] = 'basis-1/2 sm:basis-1/3 md:basis-1/4 lg:basis-1/5 grow-0',
	default => $column_classes[] = 'basis-1/2 md:basis-1/3 grow-0',
};

// bail if there are no logos
if ( !$logo_grid ) return;

// Create container classes
$classes         = ['logo-grid not-prose alignfull my-14 lg:my-28 px-3'];
$classes[]       = is_admin() ? 'logo-grid-admin block-admin' : '';
$classes[]       = !empty($block['align']) ? sprintf('align%s', $block['align']) : '';
$classes[]       = !empty($block['className']) ? $block['className'] : '';
$classes         = array_filter($classes);
?>

<div class="<?php echo implode(' ', $classes); ?>">
	<div class="col-span-7">
		<div class="mx-auto max-w-screen-2xl w-full">

			<?php
			$args = [
				'title'    => $logo_grid_title,
				'subtitle' => $logo_grid_subtitle,
			];

			get_template_part( 'template-parts/layout/block', 'title', $args );
			?>

			<div class="flex flex-wrap justify-center gap-4">
				<?php
				foreach ( $logo_grid as $item ) :
					$img = wp_get_attachment_image( $item, 'large', false, $image_attributes );
				?>
					<div class="<?php echo implode( ' ', $column_classes ); ?>">
						<?php echo $img; ?>
					</div>
				<?php endforeach; ?>
			</div>

		</div>
	</div>
</div>
