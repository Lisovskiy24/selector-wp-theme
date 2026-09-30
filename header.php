<?php
/**
 * Шапка сайта.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#111827">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php get_template_part( 'template-parts/sprite' ); ?>

<header class="header" id="top">
	<div class="container header__inner">
		<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<span class="logo__mark" aria-hidden="true"><?php echo esc_html( mb_substr( sel_opt( 'brand' ), 0, 1 ) ); ?></span>
			<span class="logo__text"><?php echo esc_html( mb_strtolower( sel_opt( 'brand' ) ) ); ?></span>
		</a>

		<nav class="nav" id="nav" aria-label="Основная навигация">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'nav__list',
						'depth'          => 1,
					)
				);
			} else {
				get_template_part( 'template-parts/nav-default' );
			}
			?>
		</nav>

		<div class="header__actions">
			<a class="btn btn--ghost header__login" <?php sel_go_attrs(); ?>>Вход</a>
			<a class="btn btn--primary" <?php sel_go_attrs(); ?>>Регистрация</a>
			<button class="burger" type="button" aria-label="Открыть меню" aria-expanded="false" aria-controls="nav">
				<span class="burger__line"></span>
			</button>
		</div>
	</div>
</header>
