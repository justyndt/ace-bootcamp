<?php
defined('ABSPATH') || exit; // Exit if accessed directly

// block variables
$hero_title                = get_field('hero_title');
$hero_sub_title            = get_field('hero_sub_title');
$hero_background_image_id  = get_field('hero_background_image');
$hero_background_image_url = wp_get_attachment_image_url($hero_background_image_id, 'full');
$hero_background_image     = wp_get_attachment_image($hero_background_image_id, 'full', false, ['class' => 'object-cover size-full']);
$hero_background_video     = get_field('hero_background_video');

// bail if no events on schedule
if (!$hero_title) :

	get_template_part('template-parts/content/content', 'error-message', ['error_message' => __('Please add hero content', 'grad-are-back')]);

else :

	// Create container classes
	$classes         = ['hero not-prose alignfull'];
	$classes[]       = is_admin() ? 'hero-admin block-admin' : '';
	$classes[]       = !empty($block['align']) ? sprintf('align%s', $block['align']) : '';
	$classes[]       = !empty($block['className']) ? $block['className'] : '';
	$classes         = array_filter($classes);
?>

	<div class="<?php echo implode(' ', $classes); ?>">
		<div class="relative bg-white min-h-[700px] h-[700px] md:min-h-[65vh] lg:min-h-[75vh] xl:min-h-[85vh] flex flex-col justify-center items-center">

			<div class="w-full max-w-screen-2xl sm:w-11/12 md:w-10/12 lg:w-11/12 xl:w-10/12 relative z-10 h-full">
				<div class="flex flex-col gap-2 h-full justify-center items-center text-center px-5 lg:px-0">

					<?php if ($hero_title) : ?>
						<h1 class="text-4xl md:text-6xl xl:text-7xl 2xl:text-9xl font-condensed uppercase font-bold">
							<?php echo $hero_title; ?>
						</h1>
					<?php endif; ?>

					<?php if ($hero_sub_title) : ?>
						<p class="text-lg md:text-xl lg:text-2xl w-full lg:w-8/12 xl:w-8/12">
							<?php echo $hero_sub_title; ?>
						</p>
					<?php endif; ?>

					<strong class="text-4xl lg:text-5xl font-condensed uppercase mt-5 mb-2 block">
						<?php _e('April 9-11, 2026', 'ace-bootcamp'); ?>
					</strong>

					<div class="hidden">
						<a href="#register" class="btn-primary font-extended text-lg">
							<?php _e('Register Now', 'ace-bootcamp'); ?>
						</a>
					</div>

					<div id="countdown-parent" class="hidden flex-col xl:flex-row py-3 xl:py-4 px-4 xl:px-5 rounded-lg border border-zinc-200/50 w-full lg:w-5/12">
						<div class="w-full md:w-10/12 xl:w-5/12 shrink-0 text-off-white text-center xl:text-left">
							<h2 class="text-base md:text-xl xl:text-2xl font-condensed uppercase leading-none font-semibold">
								<?php _e('The second annual FAMU SJGC Accelerating Career Excellence (ACE) Broadcast Bootcamp is an immersive, three-day journalism program designed to enhance students’ skills.', 'ace-bootcamp'); ?>
							</h2>
						</div>

						<div id="countdown">
							<div id="days" class="item"></div>
							<div id="hours" class="item"></div>
							<div id="minutes" class="item"></div>
							<div id="seconds" class="item"></div>
						</div>
					</div>

				</div>
			</div>


			<?php if ($hero_background_image_id && !$hero_background_video) : ?>
				<div
					class="bg-white relative w-full h-[50vh] overflow-hidden bg-[auto_570px] bg-center"
					style="background-image: url('<?php echo $hero_background_image_url; ?>');">
				</div>
			<?php endif; ?>

			<?php if ($hero_background_video) : ?>
				<video
					poster="<?php echo $hero_background_image_url; ?>"
					class="absolute inset-0 size-full object-cover"
					preload="auto"
					loop=""
					muted=""
					autoplay=""
					playsinline="">
					<source src="<?php echo $hero_background_video; ?>" type="video/mp4">
				</video>
			<?php endif; ?>

			<div class="hidden bg-gradient-to-tr from-sjgc-green/75 to-[#000000]/95 inset-0 absolute z-5"></div>
		</div>
	</div>

<?php endif;
