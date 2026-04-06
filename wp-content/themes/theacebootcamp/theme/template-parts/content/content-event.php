<?php
defined('ABSPATH') || exit;

//vars
$title            = $args['title'];
$subtitle         = $args['subtitle'];
$event_date       = $args['event_date'];
$event_start_time = $args['event_start_time'];
$event_end_time   = $args['event_end_time'];
$moderator_title  = empty( $args['moderator_title'] ) ? __( 'Moderator', 'grads-are-back' ) : $args['moderator_title'];
$moderator        = $args['moderator'];
$panelists_title  = empty( $args['panelists_title'] ) ? __( 'Featuring', 'grads-are-back' ) : $args['panelists_title'];
$panelists        = $args['panelists'];
$location         = $args['location'];
$description      = $args['description'];
$event_type       = $args['event_type'];
$virtual_link     = $args['virtual_link'];


// check for $moderator and $panelists
$event_parent_classes   = ['grid relative z-30'];
$event_parent_classes[] = ( $moderator ) ? 'lg:grid-cols-2 items-start gap-3 md:gap-10 xl:gap-20' : 'bg-gradient-to-t from-foreground to-zinc-800 w-full lg:w-7/12 mx-auto gap-6 text-white rounded-2xl border border-foreground overflow-hidden';

$event_title_parent_classes   = ['inline-flex flex-col gap-6 flex-1'];
$event_title_parent_classes[] = $moderator ? 'lg:sticky lg:top-4 justify-start lg:items-end text-center lg:text-right p-5 lg:p-0 bg-off-white lg:bg-transparent border lg:border-none border-zinc-200 rounded-2xl' : 'text-center items-center justify-center';
$event_title_classes          = ['text-4xl lg:text-5xl font-bold w-full uppercase font-condensed'];
$event_title_classes[]        = $moderator ? 'xl:text-6xl' : '';

$subtitle_classes   = $moderator ? 'uppercase font-condensed text-xl font-bold text-sjgc-green' : 'uppercase font-condensed text-xl font-bold text-off-white';

$event_description_parent_classes   = ['inline-flex flex-col gap-6 flex-1'];
$event_description_parent_classes[] = $moderator ? 'bg-white p-10 border border-zinc-200 rounded-2xl' : 'text-left text-white';
$event_description_classes          = ['flex flex-col'];
$event_description_classes[]        = $moderator ? '' : 'text-center';

$panelists_parent_classes   = ['inline-flex gap-4'];
$panelists_parent_classes[] = $moderator ? 'flex-col' : 'items-center justify-center flex-wrap';

$panelists_classes   = ['flex items-center gap-3'];
$panelists_classes[] = $moderator ? '' : 'p-2 border-off-white rounded-full border text-foreground bg-white';

$panelist_image_classes   = $moderator ? 'rounded-md size-16 object-cover shrink-0' : 'rounded-full size-16 object-cover shrink-0';
$panelist_details_classes = $moderator ? 'flex flex-col' : 'text-left pr-5 flex flex-col gap-0 justify-center items-start';
?>

<div class="<?php echo implode( ' ', $event_parent_classes ); ?>">
	<?php if ($moderator) : ?>
	<div class="size-8 rounded-full border-4 border-off-white bg-sjgc-green shrink-0 absolute z-20 left-1/2 -translate-x-1/2 flex -top-10 lg:top-0"></div>
	<?php endif; ?>

	<div class="<?php echo implode( ' ', $event_title_parent_classes ); ?> relative">
		<div class="inline-flex flex-col gap-0 w-full items-center justify-center text-center px-10 min-h-32 bg-gradient-to-t from-foreground to-zinc-800 border-b border-b-zinc-700 py-6">

			<?php if ( $event_date ) : ?>
			<em class="font-condensed text-off-white uppercase text-2xl mb-2 not-italic">
				<?php echo $event_date; ?>
			</em>
			<?php endif; ?>

			<h2 class="<?php echo implode(' ', $event_title_classes); ?>">
				<?php echo $title; ?>
			</h2>
		</div>
	</div>

	<div class="<?php echo implode(' ', $event_description_parent_classes); ?>">
		<div class="day-details">
			<?php echo apply_filters('the_content', $description); ?>
		</div>
		<?php if ( $panelists ) :  ?>

			<?php if ( $moderator ) : ?>
			<strong class="font-condensed uppercase text-lg -mb-4 text-foreground">
				<?php echo $panelists_title; ?>
			</strong>
			<?php else: ?>
			<strong class="font-extended uppercase text-lg -mb-3 text-off-white hidden">
				<?php // echo $moderator_title; ?>
			</strong>
			<?php endif; ?>

			<div class="<?php echo implode( ' ', $panelists_parent_classes ); ?>">
				<?php
				foreach ( $panelists as $panelist ) :

					// vars
					$panelist_img   = get_the_post_thumbnail($panelist, 'medium', ['class' => $panelist_image_classes]);
					$title          = get_field( 'title', $panelist );
					$title_location = get_field( 'title_location', $panelist );
				?>

					<div class="<?php echo implode( ' ', $panelists_classes ); ?> hidden">
						<?php echo $panelist_img; ?>
						<div class="<?php echo $panelist_details_classes; ?>">
							<div class="flex flex-col gap-0">
								<strong class="text-lg font-extended leading-none">
									<?php echo get_the_title($panelist); ?>
								</strong>

								<?php if ( $title ) : ?>
								<p class="text-sm"><?php echo $title; ?></p>
								<?php endif; ?>
							</div>

							<?php if ( $title_location ) : ?>
							<p class="text-xs text-foreground/70">
								<?php echo $title_location; ?>
							</p>
							<?php endif; ?>
						</div>
					</div>

				<?php endforeach; ?>

				<?php if ( $virtual_link && $moderator ) : ?>
				<a
					class="btn-sjgc-green mt-5 gap-2"
					href="<?php echo $virtual_link; ?>"
					target="_blank"
				>
					<iconify-icon class="text-2xl" icon="ph:video-light"></iconify-icon>
					<?php _e( 'Join Event', 'grads-are-back' ); ?>
				</a>
				<?php endif; ?>

			</div>
		<?php endif; ?>
	</div>
</div>
