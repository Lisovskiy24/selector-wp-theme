<?php
/**
 * Первый экран: оффер с промокодом (компонент Hero Banner из UI-кита).
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

$sel_bonus = sel_opt( 'bonus' );
?>
<section class="offer" aria-labelledby="offer-title">
	<div class="container">
		<div class="banner banner--casino">
			<picture class="banner__art">
				<source srcset="<?php echo esc_url( sel_img( 'hero-casino.webp' ) ); ?>" media="(min-width: 768px)" width="1600" height="678">
				<img src="<?php echo esc_url( sel_img( 'hero-casino-m.webp' ) ); ?>" width="720" height="678" alt="" fetchpriority="high" decoding="async">
			</picture>

			<div class="banner__content">
				<p class="chip"><?php sel_icon( 'dice', 15 ); ?>Бонус для новых игроков</p>

				<h1 class="banner__title" id="offer-title">
					Бонус <span class="text-accent">до&nbsp;<?php echo esc_html( $sel_bonus ); ?></span> на&nbsp;первый депозит в&nbsp;<?php echo esc_html( sel_opt( 'brand' ) ); ?>
				</h1>
				<p class="banner__text"><?php echo esc_html( sel_opt( 'offer_text' ) ); ?></p>

				<ul class="stats">
					<li class="stats__item"><span class="stats__value"><?php echo esc_html( $sel_bonus ); ?></span><span class="stats__label">к депозиту</span></li>
					<li class="stats__item"><span class="stats__value"><?php echo esc_html( sel_opt( 'wager' ) ); ?></span><span class="stats__label">вейджер</span></li>
					<li class="stats__item"><span class="stats__value"><?php echo esc_html( sel_opt( 'min_deposit' ) ); ?></span><span class="stats__label">мин. депозит</span></li>
				</ul>

				<div class="promo" data-promo>
					<div class="promo__body">
						<span class="overline">Промокод</span>
						<code class="promo__code" data-promo-code><?php echo esc_html( sel_opt( 'promo_code' ) ); ?></code>
					</div>
					<button class="btn btn--secondary btn--sm promo__copy" type="button" data-promo-copy>
						<?php sel_icon( 'ticket' ); ?><span data-promo-status>Копировать</span>
					</button>
				</div>

				<div class="banner__cta">
					<a class="btn btn--primary btn--lg" <?php sel_go_attrs(); ?>>Получить бонус</a>
					<p class="caption">18+ · Действуют <a href="#bonus-terms">условия акции</a></p>
				</div>
			</div>
		</div>
	</div>
</section>
