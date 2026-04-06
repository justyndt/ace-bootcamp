<?php
defined('ABSPATH') || exit; // Exit if accessed directly

// block variables
$pricing_charts_title = get_field('pricing_charts_title');
$charts               = get_field('charts');

// bail if there are no profiles
if ( !$charts ) return;

// Create container classes
$classes         = ['pricing-charts not-prose alignfull my-14 px-3'];
$classes[]       = is_admin() ? 'pricing-charts-admin block-admin' : '';
$classes[]       = !empty($block['align']) ? sprintf('align%s', $block['align']) : '';
$classes[]       = !empty($block['className']) ? $block['className'] : '';
$classes         = array_filter($classes);
?>

<div class="<?php echo implode(' ', $classes); ?>">
	<div class="alignfull">
		<div class="mx-auto max-w-screen-2xl w-full">

		<?php if ( $pricing_charts_title ) : ?>
		<h2 class="text-2xl font-bold font-condensed uppercase lg:text-3xl text-sjgc-green mb-10 text-center">
			<?php echo $pricing_charts_title; ?>
		</h2>
		<?php endif; ?>

		<div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
			<?php
				while( have_rows('charts') ) :
					the_row();

					// vars
					$chart_title       = get_sub_field('chart_title');
					$chart_items_price = get_sub_field('chart_items_price');
					$chart_items       = get_sub_field('chart_items');
			?>
			<div class="bg-white border-zinc-200 border p-9 rounded-lg flex flex-col justify-between gap-12">

				<div>
					<div class="flex flex-col gap-2 mb-8">
					<?php if ( $chart_title ) : ?>
						<h3 class="text-xl font-bold font-extended leading-none text-foreground text-center">
							<?php echo $chart_title; ?>
						</h3>
						<?php endif; ?>
						<strong class="font-condensed text-center text-sjgc-green uppercase text-3xl xl:text-5xl">
							$<?php echo number_format( $chart_items_price ); ?>
						</strong>
					</div>

					<ul class="flex flex-col gap-6">
						<?php foreach ( $chart_items as $item ) : ?>
						<li class="flex items-start justify-start gap-2.5">
							<div class="size-5 shrink-0 flex items-center justify-center relative top-[1px]">
								<iconify-icon class="text-sjgc-green text-sm" icon="fluent:checkmark-32-filled"></iconify-icon>
							</div>
							<span class="text-sm leading-4"><?php echo $item['item']; ?></span>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<a
					class="btn-sjgc-green"
					href="https://my.famu.edu/page.aspx?pid=604"
					target="_blank"
				>
					<?php _e( 'Become a Sponsor', 'grads-are-back' ); ?>
				</a>
			</div>
			<?php endwhile; ?>
		</div>

		</div>
	</div>
</div>
