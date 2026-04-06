<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly
?>

<div
	id="nav-drawer"
  class="fixed right-0 top-0 z-50 flex h-screen w-full translate-x-full flex-col gap-4 overflow-x-hidden bg-foreground p-8 lg:p-10 transition-all duration-700 ease-[cubic-bezier(0.64,0.045,0.35,1)] sm:w-3/4"
  role="menu"
	aria-label="Drawer"
	aria-hidden="true"
>

  <div class="flex items-center justify-between">
    <?php if ( function_exists( 'the_custom_logo' ) ) : ?>
    <div class="w-24">
      <?php the_custom_logo(); ?>
    </div>
    <?php endif; ?>

    <label
			id="nav-drawer-close"
			for="drawer-toggle"
			class="flex size-14 cursor-pointer items-center justify-center bg-gradient-to-t border border-zinc-200/50 from-sjgc-green/75 to-green-800/75 rounded-md"
		>
      <span class="sr-only"><?php _e( 'Close navigation drawer', 'isave-fl' ); ?></span>
      <iconify-icon class="text-white text-3xl" icon="ei:close"></iconify-icon>
    </label>
  </div>

	<nav id="site-navigation" aria-label="<?php esc_attr_e('Main Navigation', 'grads-are-back'); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu'
			)
		);
		?>
	</nav>

</div>
