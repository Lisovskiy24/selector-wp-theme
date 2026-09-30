<?php
/**
 * Selector Landing — функции темы.
 *
 * Здесь только подключение модулей и базовая настройка.
 * Логика разложена по файлам в /inc.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

define( 'SELECTOR_VERSION', '1.0.0' );
define( 'SELECTOR_DIR', get_template_directory() );
define( 'SELECTOR_URI', get_template_directory_uri() );

require SELECTOR_DIR . '/inc/helpers.php';     // sel_opt(), sel_icon(), sel_go_url(), sel_img()
require SELECTOR_DIR . '/inc/customizer.php';  // настройки оффера в «Настроить»
require SELECTOR_DIR . '/inc/games.php';       // тип записей «Игры» + поля
require SELECTOR_DIR . '/inc/redirect.php';    // партнёрские ссылки /go/{slug}/
require SELECTOR_DIR . '/inc/performance.php'; // чистка <head>, preload
require SELECTOR_DIR . '/inc/seo.php';         // meta description без SEO-плагина

/**
 * Поддержка возможностей WordPress и меню.
 */
function selector_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	add_image_size( 'selector-game', 480, 643, true );

	register_nav_menus(
		array(
			'primary' => 'Меню в шапке',
			'footer'  => 'Меню в подвале',
		)
	);
}
add_action( 'after_setup_theme', 'selector_setup' );

/**
 * Стили и скрипты. Версия = время изменения файла, чтобы сбрасывать кэш браузера.
 */
function selector_assets() {
	$css = '/assets/css/main.css';
	$js  = '/assets/js/main.js';

	wp_enqueue_style( 'selector-main', SELECTOR_URI . $css, array(), filemtime( SELECTOR_DIR . $css ) );

	wp_enqueue_script(
		'selector-main',
		SELECTOR_URI . $js,
		array(),
		filemtime( SELECTOR_DIR . $js ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'selector_assets' );

/**
 * Классы для ссылок меню, чтобы пункты из админки выглядели как в макете.
 *
 * @param array    $atts Атрибуты ссылки.
 * @param WP_Post  $item Пункт меню.
 * @param stdClass $args Аргументы wp_nav_menu().
 * @return array
 */
function selector_menu_link_class( $atts, $item, $args ) {
	if ( isset( $args->theme_location ) && 'primary' === $args->theme_location ) {
		$atts['class'] = 'nav__link';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'selector_menu_link_class', 10, 3 );
