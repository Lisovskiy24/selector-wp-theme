<?php
/**
 * Вспомогательные функции для шаблонов.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

/**
 * Значения по умолчанию для настроек оффера.
 * Используются, пока редактор ничего не поменял в «Настроить».
 *
 * @return array
 */
function sel_defaults() {
	return array(
		'brand'         => 'Selector',
		'promo_code'    => 'SELECTOR300',
		'bonus'         => '300%',
		'wager'         => 'x3',
		'min_deposit'   => '500 ₽',
		'offer_text'    => 'Введите промокод при первом пополнении — бонус начислится сразу.',
		'cashback'      => 'до 15%',
		'games_count'   => '3000+',
		'aff_url'       => '',
		'review_author' => 'Редакция',
		'review_date'   => '2026-09-30',
	);
}

/**
 * Настройка оффера из Customizer.
 *
 * @param string $key Ключ без префикса, например 'promo_code'.
 * @return string
 */
function sel_opt( $key ) {
	$defaults = sel_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return (string) get_theme_mod( 'sel_' . $key, $default );
}

/**
 * URL картинки из папки темы.
 *
 * @param string $file Имя файла в assets/img.
 * @return string
 */
function sel_img( $file ) {
	return SELECTOR_URI . '/assets/img/' . $file;
}

/**
 * Внутренняя партнёрская ссылка вида /go/selector/.
 *
 * @param string $slug Ярлык оффера.
 * @return string
 */
function sel_go_url( $slug = 'selector' ) {
	return home_url( '/go/' . sanitize_title( $slug ) . '/' );
}

/**
 * Атрибуты для всех партнёрских ссылок.
 */
function sel_go_attrs() {
	echo 'href="' . esc_url( sel_go_url() ) . '" rel="nofollow sponsored noopener" target="_blank"';
}

/**
 * Иконка из SVG-спрайта.
 *
 * @param string $name Имя иконки: gift, dice, crown, star, ...
 * @param int    $size Размер в px.
 */
function sel_icon( $name, $size = 16 ) {
	printf(
		'<svg class="icon" width="%1$d" height="%1$d" aria-hidden="true"><use href="#i-%2$s"/></svg>',
		absint( $size ),
		esc_attr( $name )
	);
}
