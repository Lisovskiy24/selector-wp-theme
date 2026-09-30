<?php
/**
 * Карточки бонусов (компонент Promo Card из UI-кита).
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

$sel_cards = array(
	array(
		'mod'    => 'gold',
		'medal'  => 'medal-gold.webp',
		'tags'   => array( 'Новичкам', 'По промокоду' ),
		'title'  => 'Приветственный бонус',
		'value'  => 'до ' . sel_opt( 'bonus' ),
		'note'   => 'вейджер ' . sel_opt( 'wager' ) . ', от ' . sel_opt( 'min_deposit' ),
		'button' => 'Забрать',
	),
	array(
		'mod'    => 'blue',
		'medal'  => 'medal-silver.webp',
		'tags'   => array( 'Без депозита', 'Telegram' ),
		'title'  => 'Бездепозитные бонусы',
		'value'  => 'фриспины',
		'note'   => 'промокоды в официальном канале',
		'button' => 'Подробнее',
	),
	array(
		'mod'    => 'bronze',
		'medal'  => 'medal-bronze.webp',
		'tags'   => array( 'Еженедельно', 'VIP' ),
		'title'  => 'Кэшбэк за неделю',
		'value'  => sel_opt( 'cashback' ),
		'note'   => 'зависит от VIP-уровня',
		'button' => 'Участвовать',
	),
);
?>
<section class="section" id="bonuses" aria-labelledby="bonuses-title">
	<div class="container">
		<div class="section-head">
			<h2 class="section-head__title" id="bonuses-title">Бонусы и акции</h2>
		</div>

		<div class="promos">
			<?php foreach ( $sel_cards as $sel_card ) : ?>
				<article class="promo-card promo-card--<?php echo esc_attr( $sel_card['mod'] ); ?>">
					<img class="promo-card__medal" src="<?php echo esc_url( sel_img( $sel_card['medal'] ) ); ?>" width="80" height="80" alt="" loading="lazy" decoding="async">
					<div class="promo-card__tags">
						<?php foreach ( $sel_card['tags'] as $sel_tag ) : ?>
							<span class="tag"><?php echo esc_html( $sel_tag ); ?></span>
						<?php endforeach; ?>
					</div>
					<h3 class="promo-card__title"><?php echo esc_html( $sel_card['title'] ); ?></h3>
					<div class="promo-card__prize">
						<p class="promo-card__value"><?php echo esc_html( $sel_card['value'] ); ?></p>
						<p class="promo-card__note"><?php echo esc_html( $sel_card['note'] ); ?></p>
					</div>
					<a class="btn btn--primary btn--sm" <?php sel_go_attrs(); ?>><?php echo esc_html( $sel_card['button'] ); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
