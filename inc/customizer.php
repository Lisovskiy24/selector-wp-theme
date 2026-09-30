<?php
/**
 * Настройки оффера: «Внешний вид → Настроить → Оффер».
 * Редактор меняет промокод и бонусы без правки кода, изменения видны в превью сразу.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

/**
 * Регистрирует секцию и поля.
 *
 * @param WP_Customize_Manager $wp_customize Менеджер Customizer.
 */
function selector_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'sel_offer',
		array(
			'title'       => 'Оффер',
			'description' => 'Промокод, бонусы, партнёрская ссылка, автор и дата обзора. Используются в оффере, карточках бонусов, сайдбаре, таблице и обзоре.',
			'priority'    => 30,
		)
	);

	$fields = array(
		'brand'         => array( 'Название казино', 'text' ),
		'promo_code'    => array( 'Промокод', 'text' ),
		'bonus'         => array( 'Размер бонуса (например, 300%)', 'text' ),
		'wager'         => array( 'Вейджер', 'text' ),
		'min_deposit'   => array( 'Минимальный депозит', 'text' ),
		'offer_text'    => array( 'Подзаголовок оффера', 'textarea' ),
		'cashback'      => array( 'Кэшбэк', 'text' ),
		'games_count'   => array( 'Количество игр (плитка «Все игры», если в разделе «Игры» есть записи)', 'text' ),
		'aff_url'       => array( 'Партнёрская ссылка (куда ведёт /go/selector/)', 'url' ),
		'review_author' => array( 'Автор обзора', 'text' ),
		'review_date'   => array( 'Дата обновления обзора', 'date' ),
	);

	$defaults = sel_defaults();

	$sanitizers = array(
		'text'     => 'sanitize_text_field',
		'textarea' => 'sanitize_textarea_field',
		'url'      => 'esc_url_raw',
		'date'     => 'sanitize_text_field',
	);

	foreach ( $fields as $key => $field ) {
		$wp_customize->add_setting(
			'sel_' . $key,
			array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => $sanitizers[ $field[1] ],
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'sel_' . $key,
			array(
				'label'   => $field[0],
				'section' => 'sel_offer',
				'type'    => $field[1],
			)
		);
	}
}
add_action( 'customize_register', 'selector_customize_register' );
