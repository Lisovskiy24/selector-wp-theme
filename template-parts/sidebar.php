<?php
/**
 * Сайдбар обзора: карточка бонуса и содержание.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;
?>
<aside class="sidebar" aria-label="Бонус">
	<div class="promo-card promo-card--gold side-card">
		<img class="promo-card__medal" src="<?php echo esc_url( sel_img( 'medal-gold.webp' ) ); ?>" width="80" height="80" alt="" loading="lazy" decoding="async">
		<div class="promo-card__tags"><span class="tag">Промокод</span></div>
		<p class="promo-card__title">Бонус на первый депозит</p>
		<div class="promo-card__prize">
			<p class="promo-card__value">до <?php echo esc_html( sel_opt( 'bonus' ) ); ?></p>
			<code class="side-card__code"><?php echo esc_html( sel_opt( 'promo_code' ) ); ?></code>
		</div>
		<a class="btn btn--primary btn--block" <?php sel_go_attrs(); ?>>Получить бонус</a>
	</div>
	<nav class="toc" aria-label="Содержание">
		<p class="overline">Содержание</p>
		<ol class="toc__list">
			<li><a href="#bonus-terms">Как получить бонус</a></li>
			<li><a href="#info">Основная информация</a></li>
			<li><a href="#payments">Платёжные методы</a></li>
			<li><a href="#screens">Как выглядит сайт</a></li>
			<li><a href="#pros-cons">Плюсы и минусы</a></li>
			<li><a href="#faq">Вопросы и ответы</a></li>
		</ol>
	</nav>
</aside>
