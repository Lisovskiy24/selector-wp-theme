<?php
/**
 * Скорость: убираем лишнее из <head>, заранее грузим шрифт и первую картинку.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

// Эмодзи-скрипты и стили WordPress — лишний запрос на каждой странице.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Служебные ссылки в <head>, которые не нужны лендингу.
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/**
 * Стили глобальных настроек блочных тем не используются — тема классическая.
 */
function selector_dequeue_unused() {
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'selector_dequeue_unused', 100 );

/**
 * Preload шрифта и картинки первого экрана (LCP) на главной.
 */
function selector_preload() {
	printf(
		'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( SELECTOR_URI . '/assets/fonts/manrope-cyrillic.woff2' )
	);

	if ( is_front_page() ) {
		printf( '<link rel="preload" href="%s" as="image" media="(max-width: 767px)">' . "\n", esc_url( sel_img( 'hero-casino-m.webp' ) ) );
		printf( '<link rel="preload" href="%s" as="image" media="(min-width: 768px)">' . "\n", esc_url( sel_img( 'hero-casino.webp' ) ) );
	}
}
add_action( 'wp_head', 'selector_preload', 1 );

/**
 * Иконка сайта из темы, если в «Настроить → Свойства сайта» не задана своя.
 */
function selector_favicon() {
	if ( ! has_site_icon() ) {
		printf( '<link rel="icon" href="%s" type="image/svg+xml">' . "\n", esc_url( sel_img( 'favicon.svg' ) ) );
	}
}
add_action( 'wp_head', 'selector_favicon', 2 );
