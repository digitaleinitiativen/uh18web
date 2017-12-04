<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package crate
 */

	// $post_id = get_the_ID();
 //    $posts = get_post_meta( $post_id );
 //    echo '<pre>';
 //    print_r($posts);
 //    echo '</pre>';

?>

	<?php include(locate_template('partials/hero.php')); ?>

	<!-- SECTIONS -->
	<?php 
		if (file_exists(get_template_directory() . '/acf-local-file.php')) {
			require_once(get_template_directory() . '/acf-local-file.php');
		}

		if ( !empty($config) ) {
			$acf_post_meta = get_all_custom_field_meta( get_the_ID(), $config );
		}

		if ( !empty($acf_post_meta) ) {
			foreach ($acf_post_meta as $key => $meta) {
				// IF ARRAY
				if ( is_array($meta) ) {
					foreach ($meta as $layout) {
						if ((!empty($layout['acf_fc_layout'])) && (file_exists(get_template_directory() . '/partials/'.$layout['acf_fc_layout'].'.php'))) {

							include(locate_template('partials/'.$layout['acf_fc_layout'].'.php'));
						}
					}
				}
			}
		}
	?>