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
	<header class="header">
		<div class="header__content">
		    <div class="header__item  header__logo">
    			<?php the_custom_logo(); ?>
		    </div>

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
