<?php
/**
 * Мета-описание, если не установлен SEO-плагин (Yoast, Rank Math).
 * С плагином тема ничего не выводит, чтобы не было дублей.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

/**
 * Выводит <meta name="description">.
 */
function selector_meta_description() {
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) {
		return;
	}

	$description = '';
	if ( is_front_page() ) {
		$description = sprintf(
			'Обзор %1$s Casino: бонус до %2$s на первый депозит по промокоду %3$s, условия отыгрыша, платежи и лимиты на вывод.',
			sel_opt( 'brand' ),
			sel_opt( 'bonus' ),
			sel_opt( 'promo_code' )
		);
	} elseif ( is_singular() ) {
		$description = get_the_excerpt();
	}

	if ( ! $description ) {
		$description = get_bloginfo( 'description' );
	}

	if ( $description ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( wp_strip_all_tags( $description ) ) );
	}
}
add_action( 'wp_head', 'selector_meta_description', 1 );
