<?php
defined('ABSPATH') || exit; // Exit if accessed directly

// block variables
$schedule_title       = get_field('schedule_title');
$schedule_list        = get_field('schedule_list');
$schedule_description = get_field('schedule_description');
$schedule_link_one    = get_field('schedule_link_one');
$schedule_link_two    = get_field('schedule_link_two');
$events_title         = get_field('events_title');
$events_subtitle      = get_field('events_subtitle');

// bail if no events on schedule
if (!$schedule_list)  :

	get_template_part('template-parts/content/content', 'error-message', ['error_message' => __('No events on schedule.', 'grad-are-back')]);

else :

// Create container classes
$classes         = ['schedule not-prose alignfull my-10 lg:my-14'];
$classes[]       = is_admin() ? 'schedule-admin block-admin' : '';
$classes[]       = !empty($block['align']) ? sprintf('align%s', $block['align']) : '';
$classes[]       = !empty($block['className']) ? $block['className'] : '';
$classes         = array_filter($classes);
?>

<div id="schedule" class="<?php echo implode(' ', $classes); ?>">
	<div>
		<div class="mx-auto max-w-screen-2xl xl:max-w-screen-xl w-full grid gap-7 md:gap-14 xl:gap-24 px-3 relative">
			<div class="absolute top-0 bottom-0 left-1/2 w-[1px] h-full -translate-x-1/2 bg-gradient-to-t from-off-white via-sjgc-orange to-off-white z-10 mx-auto flex"></div>

			<?php if ( $schedule_title || $schedule_description ) : ?>
			<div class="bg-white border border-zinc-200 p-8 rounded-2xl w-full xl:w-7/12 md:w-10/12 mx-auto flex items-center justify-center relative z-30">
				<div class="flex flex-col gap-3 justify-center items-center text-center">
					<?php if ( $schedule_title ) : ?>
					<h2 class="font-condensed text-sjgc-foreground font-bold text-2xl md:text-4xl xl:text-5xl uppercase">
						<?php echo $schedule_title; ?>
					</h2>
					<?php endif; ?>

					<?php if ( $schedule_description ) : ?>
					<p class="text-sm"><?php echo $schedule_description; ?></p>
					<?php endif; ?>

					<?php if ( $schedule_link_one || $schedule_link_two ) : ?>
					<div class="flex items-center justify-center gap-4 mt-6 flex-wrap">
						<?php if ( $schedule_link_one ) : ?>
						<a
							class="min-h-14 bg-foreground uppercase text-white rounded-md flex items-center justify-center font-condensed font-semibold text-2xl leading-none px-6 transition-all duration-300 hover:bg-off-white hover:text-foreground ease-in-out"
							href="<?php echo $schedule_link_one['url']; ?>"
							target="<?php echo $schedule_link_one['target']; ?>"
						>
							<span class="relative top-[2px]"><?php echo $schedule_link_one['title']; ?></span>
						</a>
						<?php endif; ?>

						<?php if ( $schedule_link_two ) : ?>
						<a
							class="btn-sjgc-green px-6"
							href="<?php echo $schedule_link_two['url']; ?>"
							target="<?php echo $schedule_link_two['target']; ?>"
						>
							<?php echo $schedule_link_two['title']; ?>
						</a>
						<?php endif; ?>
					</div>
					<?php endif; ?>

				</div>
			</div>
			<?php endif; ?>

			<?php if ( $events_title || $events_subtitle ) : ?>
			<div
				class="border border-sjgc-orange py-5 px-7 rounded-xl w-auto mx-auto flex flex-col items-center justify-center relative z-30 bg-white text-center"
			>
				<?php if ( $events_title ) : ?>
				<strong class="font-extended text-3xl lg:text-4xl xl:text-5xl uppercase text-foreground font-bold">
					<?php echo $events_title; ?>
				</strong>
				<?php endif; ?>

				<?php if ( $events_subtitle ) : ?>
				<p class="text-lg text-foreground">
					<?php echo $events_subtitle; ?>
				</p>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php
				// Create an array to store the posts and their timestamps
				$sorted_posts = [];

				// get cuttent timestamp
				$wp_timezone = wp_timezone();
				$current_timestamp = current_time('timestamp');
				$current_time = new DateTime('now', $wp_timezone);

				foreach ( $schedule_list as $post ) :
					$event_date = get_field('event_date', $post);
					$event_start_time = get_field('event_start_time', $post);

					// Combine date and time into a timestamp for sorting
					$datetime = DateTime::createFromFormat('F j, Y g:i a', $event_date . ' ' . $event_start_time);

					$sorted_posts[] = array(
						'post'      => $post,
						'timestamp' => $datetime ? $datetime->getTimestamp() : 0
					);
				endforeach;

				// Sort the array by timestamp
				usort( $sorted_posts, function($a, $b) {
					return $a['timestamp'] - $b['timestamp'];
				} );

				// Now loop through the sorted posts
				foreach ( $sorted_posts as $sorted_post ) :
					$post = $sorted_post['post'];
					setup_postdata($post);

					$args = [
						'title'            => get_the_title($post),
						'subtitle'         => get_field('subtitle', $post),
						'event_date'       => get_field('event_date', $post),
						'event_start_time' => get_field('event_start_time', $post),
						'event_end_time'   => get_field('event_end_time', $post),
						'moderator_title'  => get_field('moderator_title', $post),
						'moderator'        => get_field('moderator', $post),
						'panelists'        => get_field('panelists', $post),
						'panelists_title'  => get_field('panelists_title', $post),
						'location'         => get_field('location', $post),
						'description'      => get_field('description', $post),
						'event_type'       => get_the_terms($post, 'event-type'),
						'virtual_link'     => get_field('virtual_link', $post),
					];


					get_template_part('template-parts/content/content', 'event', $args);
				endforeach;
			?>

		</div>
	</div>
</div>

<?php endif;
