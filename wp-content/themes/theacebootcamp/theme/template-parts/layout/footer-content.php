<?php

/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Grads_are_Back
 */

// vars
$footer_logo_id = get_field('footer_logo', 'options');
$footer_logo    = wp_get_attachment_image($footer_logo_id, 'medium', false, ['class' => 'w-72 object-cover']);
?>

<footer id="register" class="py-14 lg:py-24 bg-gradient-to-t from-foreground to-zinc-800">
	<div class="mx-auto text-white w-full max-w-screen-2xl px-5 flex items-center justify-center text-center sm:w-8/12 lg:w-7/12 xl:w-6/12">
		<div class="flex flex-col gap-5 lg:gap-8">

			<?php if ($footer_logo_id) : ?>
				<div class="flex items-center justify-center mb-3">
					<a href="https://sjgc.famu.edu">
						<?php echo $footer_logo; ?>
					</a>
				</div>
			<?php endif; ?>

			<div>
				<h4 class="font-condensed uppercase text-2xl lg:text-3xl font-semibold">
					<?php _e('Would you like to donate to support SJGC programs? If so, please use one of the following methods below.', 'grads-are-back'); ?>
				</h4>
			</div>

			<div>
				<h5 class="font-condensed uppercase font-bold text-2xl">
					<?php _e('Give by Text', 'grads-are-back'); ?>
				</h5>
				<p><?php _e('Text FAMUSJGC to 41444', 'grads-are-back'); ?></p>
			</div>

			<div class="flex items-center justify-center">
				<a
					class="underline font-bold font- text-xl flex items-center gap-2"
					href="https://fundraise.givesmart.com/form/Z89O7g?utm_medium=qr&utm_source=qr&vid=183n9a"
					target="_blank">
					<span><?php _e('Give Online Here', 'grads-are-back'); ?></span>
					<iconify-icon class="text-2xl" icon="heroicons-outline:external-link"></iconify-icon>
				</a>
			</div>

			<div>
				<h6 class="font-condensed font-semibold mb-2 uppercase text-xl w-full mx-auto md:w-8/12 lg:w-6/12">
					<?php _e('We thank you for your generosity and helping the next generation of SJGC Rattlers.', 'grads-are-back'); ?>
				</h6>

				<p class="text-base">
					<?php printf('510 Orr Drive, Suite 4003<br>Tallahassee, FL 32307<br>Phone: <a class="underline" href="%s">(850) 599-3379</a>', 'tel:8505993379'); ?>
				</p>

				<a
					href="https://sjgc.famu.edu/about/"
					class="font-condensed text-off-white mt-5 block text-2xl uppercase font-semibold"
					target="_blank">
					<?php _e('Learn more about SJGC.', 'ace-bootcamp'); ?>
				</a>
			</div>

			<?php if (have_rows('social_media_links', 'options')) : ?>
				<div>
					<h6 class="font-condensed font-semibold mb-2 uppercase text-xl">
						<?php _e('Stay Connected!', 'grads-are-back'); ?>
					</h6>

					<div class="flex items-center justify-center mb-10">
						<?php get_template_part('template-parts/layout/social', 'nav'); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<div class="lg:col-span-8 order-1 lg:order-2 hidden">
			<?php echo do_shortcode('[gravityform id="1" title="true" description="false" ajax="true" tabindex="49"]'); ?>
		</div>
	</div>

	<div class="mx-auto max-w-screen-2xl w-full text-white text-center px-5">
		<p class="text-base font-extended">
			<?php printf('&copy; Copyright %s %s, FAMU School of Journalism &amp; Graphic Communication. All Rights Reserved.', date('Y'), get_bloginfo('name')); ?>
		</p>
	</div>
</footer>