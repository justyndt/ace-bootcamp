<?php
defined('ABSPATH') || exit; // Exit if accessed directly

// block variables
$logo_grid_title    = get_field('logo_grid_title');
$logo_grid_subtitle = get_field('logo_grid_subtitle');
$logo_grid          = get_field('logo_grid');

// bail if there are no profiles
if ( !$logo_grid ) return;

// Create container classes
$classes         = ['logo-grid not-prose alignfull my-14 px-3'];
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

		<div class="grid grid-cols-1 w-8/12 lg:w-10/12 xl:w-8/12 mx-auto">
			<?php
				foreach( $logo_grid as $item ) :
					// vars
					$img = wp_get_attachment_image( $item, 'large', false, ['class' => 'size-full mb-3 rounded-lg aspect-video mix-blend-multiply'] );
			?>
			<div class="rounded-md flex items-center justify-center h-48">
				<?php echo $img; ?>
			</div>
			<?php endforeach; ?>
		</div>

		</div>
	</div>
</div>
