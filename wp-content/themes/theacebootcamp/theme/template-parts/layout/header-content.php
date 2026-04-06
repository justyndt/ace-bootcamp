<?php
	defined('ABSPATH') || exit;

	$header_styles = ( is_front_page() === true ) ? '' : 'relative z-50 bg-foreground lg:shadow-[0px_47px_38px_-50px_rgba(0,0,0,0.65)] not-home';
?>

<header id="masthead" class="<?php echo $header_styles; ?>">
	<div class="min-h-38 w-full px-3 max-w-screen-2xl mx-auto flex items-center justify-between">
		<?php if ( function_exists( 'the_custom_logo' ) ) : ?>
		<div>
			<?php the_custom_logo(); ?>
		</div>
		<?php endif; ?>

		<div class="flex items-center justify-center gap-5">
			<?php
				$args = [
					'link_styles' => 'size-12 rounded-full border border-foreground flex items-center justify-center ease-in-out transition-all duration-300 hover:bg-off-white',
				];

				get_template_part( 'template-parts/layout/social', 'nav', $args );
			?>

			<nav id="site-navigation" class="hidden relative" aria-label="<?php esc_attr_e('Main Navigation', 'grads-are-back'); ?>">
				<?php
				wp_nav_menu(
					[
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu'
					]
				);
				?>
			</nav>

			<label class="order-6 size-14 shrink-0 cursor-pointer flex-col items-center justify-center gap-1.5 border border-zinc-200/50 transition-all duration-300 hover:border-primary-yellow hover:bg-primary-yellow hidden rounded-md" for="drawer-toggle">
			<span class="sr-only"><?php _e( 'Open navigation drawer', 'tprt' ); ?></span>
			<?php echo str_repeat( '<span class="bg-white block h-[1px] w-7"></span>', 3 ); ?>
			</label>
		</div>
	</div>
</header>
