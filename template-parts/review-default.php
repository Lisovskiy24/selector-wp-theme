<?php
/**
 * Обзор по умолчанию: текст, шаги, таблицы, скриншоты, плюсы/минусы.
 * Выводится, пока у главной страницы нет своего содержимого в редакторе.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

$sel_brand = sel_opt( 'brand' );
$sel_code  = sel_opt( 'promo_code' );

$sel_steps = array(
	array( 'green', 'check', 'Регистрация', 'Создайте аккаунт и подтвердите e-mail или телефон.' ),
	array( 'accent', 'ticket', 'Промокод', 'В кассе введите <strong>' . esc_html( $sel_code ) . '</strong> в поле «Промокод».' ),
	array( 'blue', 'wallet', 'Депозит', 'Пополните счёт от ' . esc_html( sel_opt( 'min_deposit' ) ) . ' — бонус начислится автоматически.' ),
	array( 'gold', 'zap', 'Отыгрыш', 'Сделайте ставки на сумму ' . esc_html( sel_opt( 'wager' ) ) . ' от депозита в слотах и выводите выигрыш.' ),
);

// Две таблицы «ключ — значение»: заголовок группы (caption) и строки.
$sel_info = array(
	array(
		'title' => 'Бонус',
		'rows'  => array(
			'Размер'       => 'до ' . sel_opt( 'bonus' ) . ' на первый депозит',
			'Вейджер'      => sel_opt( 'wager' ) . ' от суммы депозита',
			'Мин. депозит' => sel_opt( 'min_deposit' ),
			'Промокод'     => $sel_code,
		),
	),
	array(
		'title' => 'О казино',
		'rows'  => array(
			'Работает с' => '2019 года',
			'Лицензия'   => 'Anjouan, ALSI-202503005-FI1',
			'Валюты'     => 'RUB, KZT и другие национальные; BTC, USDT и другие криптовалюты',
			'Вывод'      => 'в среднем 1 час, до 24 часов',
			'Игры'       => 'слоты, live-казино, crash-игры, ставки на спорт и киберспорт',
			'Провайдеры' => '60, в том числе Pragmatic Play, NetEnt, Playtech, Evolution',
			'Смартфоны'  => 'адаптивный сайт, без приложения',
			'Поддержка'  => '24/7 на родном языке, онлайн-чат и e-mail',
		),
	),
);

$sel_payments = array(
	array( 'Банковские карты', '500 ₽', 'neutral', 'до 24 ч' ),
	array( 'СБП', '500 ₽', 'success', 'до 1 ч' ),
	array( 'USDT (TRC-20)', '10 USDT', 'success', 'до 1 ч' ),
	array( 'Bitcoin', '0.0002 BTC', 'success', 'до 1 ч' ),
);

// Файл => подпись, alt. Для каждого есть уменьшенная копия {файл}-sm.webp (600×375) для миниатюры.
$sel_shots = array(
	'shot-lobby'     => array( 'Лобби и акции', 'Лобби Selector: акции, поиск игр и новинки' ),
	'shot-vip'       => array( 'VIP-клуб', 'VIP-клуб Selector: уровни Бронза, Серебро, Золото и их привилегии' ),
	'shot-providers' => array( 'Провайдеры игр', 'Провайдеры игр в Selector: Pragmatic Play, NetEnt, Playtech и другие' ),
);

// Оценка редакции по критериям; итог — среднее.
$sel_scores = array(
	'Бонусы'     => 4.5,
	'Игры'       => 4.8,
	'Платежи'    => 4.3,
	'Поддержка'  => 4.5,
	'Надёжность' => 3.9,
);
$sel_total = round( array_sum( $sel_scores ) / count( $sel_scores ), 1 );

// Автор и дата обновления — из «Настроить → Оффер».
$sel_author  = sel_opt( 'review_author' );
$sel_date_ts = strtotime( sel_opt( 'review_date' ) );
if ( ! $sel_date_ts ) {
	$sel_date_ts = strtotime( sel_defaults()['review_date'] );
}

$sel_review_schema = array(
	'@context'     => 'https://schema.org',
	'@type'        => 'Review',
	'name'         => 'Обзор ' . $sel_brand . ' Casino',
	'itemReviewed' => array(
		'@type' => 'Organization',
		'name'  => $sel_brand,
	),
	'reviewRating' => array(
		'@type'       => 'Rating',
		'ratingValue' => (string) $sel_total,
		'bestRating'  => '5',
		'worstRating' => '1',
	),
	'author'       => array(
		'@type' => 'Organization',
		'name'  => $sel_author,
	),
	'dateModified' => gmdate( 'Y-m-d', $sel_date_ts ),
);

$sel_allowed = array( 'strong' => array() );
?>
<script type="application/ld+json"><?php echo wp_json_encode( $sel_review_schema, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG ); ?></script>
<article class="article" id="review" aria-labelledby="review-title">
	<h2 class="article__title" id="review-title">Обзор <?php echo esc_html( $sel_brand ); ?> Casino</h2>
	<p class="article__meta">
		<?php echo esc_html( $sel_author ); ?> · обновлено
		<time datetime="<?php echo esc_attr( gmdate( 'Y-m-d', $sel_date_ts ) ); ?>"><?php echo esc_html( date_i18n( 'j F Y', $sel_date_ts ) ); ?></time>
	</p>
	<p>
		<?php echo esc_html( $sel_brand ); ?> — онлайн-казино и букмекер, который работает с 2019 года по лицензии Anjouan.
		В каталоге — слоты, live-казино, ставки на спорт и киберспорт от 60 провайдеров,
		включая Pragmatic Play, NetEnt, Playtech и Evolution. Сайт работает на русском языке,
		принимает национальные валюты и криптовалюту, а новые игроки получают бонус до <?php echo esc_html( sel_opt( 'bonus' ) ); ?> на первый депозит.
	</p>

	<section class="verdict" aria-labelledby="verdict-title">
		<div class="verdict__score">
			<h3 class="overline" id="verdict-title">Оценка редакции</h3>
			<p class="verdict__total">
				<span class="verdict__value"><?php echo esc_html( number_format( $sel_total, 1 ) ); ?></span>
				<span class="verdict__max">из 5</span>
			</p>
		</div>
		<dl class="verdict__list">
			<?php foreach ( $sel_scores as $sel_label => $sel_score ) : ?>
				<div class="verdict__row">
					<dt><?php echo esc_html( $sel_label ); ?></dt>
					<dd>
						<meter class="verdict__bar" min="0" max="5" value="<?php echo esc_attr( $sel_score ); ?>" aria-hidden="true"></meter>
						<span class="verdict__num"><?php echo esc_html( number_format( $sel_score, 1 ) ); ?></span>
					</dd>
				</div>
			<?php endforeach; ?>
		</dl>
	</section>

	<h3 class="article__h3" id="bonus-terms">Как получить бонус</h3>
	<ol class="steps">
		<?php foreach ( $sel_steps as $sel_i => $sel_step ) : ?>
			<li class="step">
				<span class="step__icon step__icon--<?php echo esc_attr( $sel_step[0] ); ?>"><?php sel_icon( $sel_step[1], 22 ); ?></span>
				<div class="step__body">
					<p class="step__head">
						<span class="overline"><?php echo esc_html( sprintf( '%02d', $sel_i + 1 ) ); ?></span>
						<span class="step__title"><?php echo esc_html( $sel_step[2] ); ?></span>
					</p>
					<p class="step__text"><?php echo wp_kses( $sel_step[3], $sel_allowed ); ?></p>
				</div>
			</li>
		<?php endforeach; ?>
	</ol>

	<h3 class="article__h3" id="info">Основная информация</h3>
	<div class="tables">
		<?php foreach ( $sel_info as $sel_group ) : ?>
			<section class="table-wrap" tabindex="0" aria-label="<?php echo esc_attr( $sel_group['title'] ); ?>">
				<table class="table table--kv">
					<caption class="table__caption"><?php echo esc_html( $sel_group['title'] ); ?></caption>
					<tbody>
						<?php foreach ( $sel_group['rows'] as $sel_label => $sel_value ) : ?>
							<tr>
								<th scope="row"><?php echo esc_html( $sel_label ); ?></th>
								<td<?php echo 'Промокод' === $sel_label ? ' class="text-accent"' : ''; ?>><?php echo esc_html( $sel_value ); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</section>
		<?php endforeach; ?>
	</div>

	<h3 class="article__h3" id="payments">Платёжные методы</h3>
	<section class="table-wrap" tabindex="0" aria-label="Платёжные методы">
		<table class="table">
			<caption class="visually-hidden">Способы пополнения и вывода</caption>
			<thead>
				<tr><th scope="col">Метод</th><th scope="col">Депозит от</th><th scope="col">Вывод</th></tr>
			</thead>
			<tbody>
				<?php foreach ( $sel_payments as $sel_pay ) : ?>
					<tr>
						<td><?php echo esc_html( $sel_pay[0] ); ?></td>
						<td><?php echo esc_html( $sel_pay[1] ); ?></td>
						<td><span class="badge badge--<?php echo esc_attr( $sel_pay[2] ); ?>"><?php echo esc_html( $sel_pay[3] ); ?></span></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>

	<h3 class="article__h3" id="screens">Как выглядит сайт</h3>
	<p>Интерфейс тёмный, с синими акцентами: слева — меню разделов, в лобби — акции, новинки и подборки по провайдерам.</p>
	<ul class="shots">
		<?php foreach ( $sel_shots as $sel_file => $sel_shot ) : ?>
			<?php
			$sel_full  = sel_img( $sel_file . '.webp' );
			$sel_thumb = sel_img( $sel_file . '-sm.webp' );
			?>
			<li class="shots__item">
				<button class="shots__btn" type="button" data-lightbox="<?php echo esc_url( $sel_full ); ?>" aria-label="<?php echo esc_attr( 'Увеличить: ' . $sel_shot[0] ); ?>">
					<img src="<?php echo esc_url( $sel_thumb ); ?>" srcset="<?php echo esc_url( $sel_thumb ); ?> 600w, <?php echo esc_url( $sel_full ); ?> 1200w" sizes="(min-width: 768px) 250px, calc(100vw - 32px)" width="600" height="375" alt="<?php echo esc_attr( $sel_shot[1] ); ?>" loading="lazy" decoding="async">
				</button>
				<span class="caption"><?php echo esc_html( $sel_shot[0] ); ?></span>
			</li>
		<?php endforeach; ?>
	</ul>

	<h3 class="article__h3" id="pros-cons">Плюсы и минусы</h3>
	<div class="pros-cons">
		<ul class="pros-cons__list pros-cons__list--pros" aria-label="Плюсы">
			<li>Крупный бонус с низким вейджером <?php echo esc_html( sel_opt( 'wager' ) ); ?></li>
			<li>Быстрый вывод, в среднем за час</li>
			<li>Рубли, СБП и криптовалюта</li>
			<li>60 провайдеров, включая Pragmatic Play и NetEnt</li>
		</ul>
		<ul class="pros-cons__list pros-cons__list--cons" aria-label="Минусы">
			<li>Бездепозитные бонусы только через Telegram</li>
			<li>Офшорная лицензия Anjouan</li>
			<li>Личный менеджер — только на старших VIP-уровнях</li>
		</ul>
	</div>
</article>
