<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
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
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class('body  body--topbar'); ?>>

	<?php if( is_front_page() ) : ?>
		<div class="sponsors  sponsors--header">
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
	<?php endif; ?>

	<header class="header">
		<div class="header__content">
		    <div class="header__item  header__logo">
    			<?php the_custom_logo(); ?>
		    </div>

		    <!-- Hamburger -->
		    <input class="menubutton__input" type="checkbox" id="burger">
		    <label class="header__item  menubutton" for="burger">
		        <i class="fa fa-bars  fa-fw"></i>
		    </label>

		    <nav id="site-navigation" class="header__item  header__nav">
				<!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'uh18' ); ?></button> -->
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class' => 'nav  nav--primary',
                        'container' => 'ul',
						'walker' => new Le_Walker_Nav_Menu()
					) );
				?>
			</nav><!-- #site-navigation -->
		</div>

		
	</header><!-- #masthead -->

	<main class="main">
