<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uh18
 */

	$field_group_json = get_acf_json_by_name('partner');
	$field_group_file = get_stylesheet_directory() . "/acf-json/{$field_group_json}";
	if (file_exists($field_group_file)) {
	    $field_group_array = json_decode( file_get_contents( $field_group_file ), true );
	    $config = $field_group_array;
	}

	$acf_option_values = get_all_custom_field_meta( 'option', $config ); 
?>

	</main>

	<footer id="colophon" class="footer">
		<div class="footer__content">

		</div>

		<div class="sponsors">
			<?php foreach ($acf_option_values as $key => $options) : ?>
				<?php foreach ($options as $key => $option) : ?>
					<?php 
						$imageId = $option['logo'] ?? '';
						$image = $imageId ? wp_get_attachment_image( $imageId, 'original', false, ["class" => ""] ) : '';
						$url = $option['link']['url'] ?? '';
						$target = $option['link']['target'] ?? '';
						$title = $option['link']['title'] ?? '';
					?>

					<?php if (!empty($url)) : ?>
						<a href="<?php echo $url; ?>" target="<?php echo $target; ?>">
					<?php endif; ?>

						<?php echo $image; ?>

					<?php if (!empty($url)) : ?>
					</a>
					<?php endif; ?>

				<?php endforeach; ?>
			<?php endforeach; ?>
		</div>

		<div class="text-center">
			<ul class="nav">
				<li class="nav__item">
					<a target="_blank" href="http://www.digitaleinitiativen.at/impressum/">Impressum</a>
				</li>
			</ul>
		</div>

		<div class="ocean">
		    <div class="wave" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/wave_blue.svg');"></div>
		    <div class="wave" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/wave_blue.svg');"></div>
		</div>
	</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>
