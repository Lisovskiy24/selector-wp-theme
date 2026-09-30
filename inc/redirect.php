<?php
/**
 * Партнёрские ссылки вида /go/selector/.
 * На сайте все кнопки ведут на внутренний адрес, а реальная ссылка хранится в настройках —
 * её можно поменять в одном месте, и она не светится в коде страниц.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

/**
 * Правило адреса /go/{slug}/.
 */
function selector_go_rewrite() {
	add_rewrite_rule( '^go/([^/]+)/?$', 'index.php?sel_go=$matches[1]', 'top' );
}
add_action( 'init', 'selector_go_rewrite' );

/**
 * Регистрирует переменную запроса.
 *
 * @param array $vars Публичные переменные запроса.
 * @return array
 */
function selector_go_query_var( $vars ) {
	$vars[] = 'sel_go';
	return $vars;
}
add_filter( 'query_vars', 'selector_go_query_var' );

/**
 * Редирект на партнёрскую ссылку. Если она не задана — страница-заглушка.
 */
function selector_go_redirect() {
	$slug = get_query_var( 'sel_go' );
	if ( ! $slug ) {
		return;
	}

	$url = sel_opt( 'aff_url' );
	header( 'X-Robots-Tag: noindex, nofollow', true );

	if ( $url ) {
		wp_redirect( esc_url_raw( $url ), 302 ); // phpcs:ignore WordPress.Security.SafeRedirect -- внешняя партнёрская ссылка.
		exit;
	}

	status_header( 200 );
	get_template_part( 'template-parts/go-stub' );
	exit;
}
add_action( 'template_redirect', 'selector_go_redirect' );

/**
 * После активации темы пересобираем правила ссылок, чтобы /go/ сразу заработал.
 */
function selector_flush_rewrites() {
	selector_go_rewrite();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'selector_flush_rewrites' );
