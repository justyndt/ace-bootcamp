<?php
	defined('ABSPATH') || exit;

	$link_styles = !empty( $args['link_styles'] ) ? $args['link_styles'] : 'size-12 rounded-full bg-white border border-off-white flex items-center justify-center ease-in-out transition-all duration-300 hover:bg-off-white text-foreground';

?>

<ul class="flex items-center justify-start gap-2">
	<?php
		while( have_rows('social_media_links', 'options') ) :
			the_row();

			// vars
			$social_media_name = get_sub_field('social_media_name');
			$social_link       = get_sub_field('social_link');
			$social_icon       = get_sub_field('social_icon');
	?>
	<li>
		<a
			class="<?php echo $link_styles; ?>"
			href="<?php echo $social_link; ?>"
			target="_blank"
		>
			<iconify-icon class="text-xl" icon="<?php echo $social_icon; ?>"></iconify-icon>
			<span class="sr-only"><?php echo $social_media_name; ?></span>
		</a>
	</li>
	<?php endwhile; ?>
</ul>
