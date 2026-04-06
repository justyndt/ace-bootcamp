<?php
	defined('ABSPATH') || exit;

	// vars
	$title 	= $args['title'];
	$subtitle = $args['subtitle'];
?>

<?php if ( $title || $subtitle ) : ?>
<div class="flex flex-col items-center justify-center text-center gap-1 lg:mb-8">
	<?php if ( $title ) : ?>
	<h2 class="text-center text-3xl lg:text-5xl font-bold font-condensed uppercase mb-6 px-5">
		<?php echo $title; ?>
	</h2>
	<?php endif; ?>

	<?php if ( $subtitle ) : ?>
	<p class="text-base md:text-md xl:text-xl font-sans text-center mx-auto w-11/12 lg:w-full">
		<?php echo $subtitle; ?>
	</p>
	<?php endif; ?>
</div>
<?php endif;
