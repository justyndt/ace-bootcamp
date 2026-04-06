<?php
defined('ABSPATH') || exit; // Exit if accessed directly

// block variables
$profiles_title    = get_field('profiles_title');
$profiles_subtitle = get_field('profiles_subtitle');
$profiles          = get_field('profiles');
$title_overlay     = get_field( 'title_overlay' );
$fallback_image    = get_field('fallback_image', 'options');
$image_classes     = ['class' => 'h-96 object-cover w-full'];

// bail if there are no profiles
if ( !$profiles ) return;

// lazy php shuffle needs to be done via ajax
shuffle($profiles);

// Create container classes
$classes         = ['profiles not-prose alignfull my-10 lg:my-14 px-3'];
$classes[]       = is_admin() ? 'profiles-admin block-admin not-prose' : '';
$classes[]       = !empty($block['align']) ? sprintf('align%s', $block['align']) : '';
$classes[]       = !empty($block['className']) ? $block['className'] : '';
$classes         = array_filter($classes);

// styles profile based on ttext overlay
$profile_parent_styles = $title_overlay ? 'overflow-clip rounded-lg h-full relative bg-zinc-950/80' : 'overflow-clip rounded-lg h-full relative';
$profile_column_styles = $title_overlay ? 'grid gap-3 md:gap-4 xl:gap-6 grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5' : 'grid grid-cols-1 gap-6 md:grid-cols-2 w-full max-w-screen-xl mx-auto';
$profile_content_wrapper = $title_overlay ? 'absolute text-white z-20 bottom-4 inset-x-4 flex flex-col gap-1.5' : 'bg-off-white/20 h-full p-8';
$profile_name_styles = $title_overlay ? 'font-bold leading-none font-condensed uppercase text-lg xl:text-xl' : 'font-bold leading-none font-condensed uppercase text-3xl mb-3';
$profile_title_styles = $title_overlay ? 'text-sm leading-none font-extended' : 'text-base mb-1 leading-none font-extended';
$profile_location_styles = $title_overlay ? 'text-xs leading-none text-white/80' : 'text-sm leading-none font-extended text-foreground';
?>

<div class="<?php echo implode(' ', $classes); ?>">
	<div class="col-span-7">

		<div class="mx-auto max-w-screen-2xl w-full">

			<?php
				$args = [
					'title'    => $profiles_title,
					'subtitle' => $profiles_subtitle,
				];

				get_template_part( 'template-parts/layout/block', 'title', $args );
			?>

			<div class="<?php echo $profile_column_styles; ?>">
				<?php
					foreach( $profiles as $profile ) :

						// vars
						$avatar          = has_post_thumbnail( $profile ) ? get_the_post_thumbnail( $profile, 'large', $image_classes ) : wp_get_attachment_image( $fallback_image, 'large', false, $image_classes );
						$name            = get_the_title( $profile );
						$graduation_year = get_field( 'graduation_year', $profile );
						$title           = get_field( 'title', $profile );
						$title_location  = get_field( 'title_location', $profile );
						$major           = get_the_terms( $profile, 'major' );
						$linkedin        = get_field( 'linkedin', $profile );
						$website_link    = get_field( 'website_link', $profile );
						$profile_content = get_field( 'profile_content', $profile );
				?>

				<div class="<?php echo $profile_parent_styles; ?>">
					<div class="absolute top-3 flex items-start justify-between inset-x-3">
						<?php if ( $major ) : ?>
						<div class="inline-flex">
							<?php foreach ( $major as $item ) : ?>
							<span class="text-xs bg-foreground text-white px-2 py-1 rounded-md">
								<?php echo $item->name; ?>
							</span>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>

						<?php if ( $linkedin || $website_link ) : ?>
						<div class="flex gap-1.5 flex-col ml-auto">
							<?php if ( $linkedin ) : ?>
							<a
								href="<?php echo $linkedin; ?>"
								class="text-white bg-foreground flex items-center justify-center size-7 rounded-full text-md"
								target="_blank"
							>
								<iconify-icon icon="ri:linkedin-fill"></iconify-icon>
								<span class="sr-only"><?php printf('View %s - LinkedIn Profile', $name ); ?></span>
							</a>
							<?php endif; ?>

							<?php if ( $website_link  ) : ?>
							<a
								href="<?php echo $website_link; ?>"
								class="text-white bg-foreground flex items-center justify-center size-7 rounded-full text-md"
								target="_blank"
							>
								<iconify-icon icon="ph:link"></iconify-icon>
								<span class="sr-only"><?php printf('View %s - Personal Website', $name ); ?></span>
							</a>
							<?php endif; ?>

						</div>
						<?php endif; ?>
					</div>

					<div>
						<?php echo $avatar; ?>

						<?php if ( $title_overlay ) : ?>
						<div class="bg-gradient-to-t from-zinc-950 inset-x-0 bottom-0 absolute z-10 h-36"></div>
						<?php endif; ?>
					</div>
					<div class="<?php echo $profile_content_wrapper; ?>">

						<?php if ( !$title_overlay && $graduation_year ) : ?>
						<?php printf( '<h3 class="%s">%s <span class="text-lg block">%s</span></h3>', $profile_name_styles, $name, $graduation_year ); ?>
						<?php else : ?>
						<h3 class="<?php echo $profile_name_styles; ?>">
							<?php echo $name; ?>
						</h3>
						<?php endif; ?>

						<?php if ($title) : ?>
						<p class="<?php echo $profile_title_styles; ?>">
							<?php echo $title; ?>
						</p>
						<?php endif; ?>

						<?php if ($title_location) : ?>
						<p class="<?php echo $profile_location_styles; ?>"><?php echo $title_location; ?></p>
						<?php endif; ?>

						<?php if ( $profile_content && !$title_overlay ) : ?>
						<div class="mt-4 pt-4 border-t border-off-white profile-content">
						<?php echo $profile_content; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>

				<?php endforeach; ?>
			</div>

		</div>
	</div>
</div>
