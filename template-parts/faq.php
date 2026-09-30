<?php
/**
 * FAQ на нативных <details> — работает без JavaScript.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

$sel_faq = array(
	'Куда вводить промокод?'        => 'Промокод вводится в кассе при первом пополнении — в поле «Промокод» под суммой депозита.',
	'Можно ли вывести бонус сразу?' => 'Нет, сначала бонус нужно отыграть: сделать ставки на сумму ' . sel_opt( 'wager' ) . ' от депозита в слотах.',
	'Есть ли мобильное приложение?' => 'Сайт полностью адаптирован под смартфоны, играть можно прямо в браузере без установки.',
	'Сколько идёт вывод?'           => 'В среднем заявка обрабатывается за час, максимальный срок — 24 часа.',
	'Есть ли у ' . sel_opt( 'brand' ) . ' лицензия?' => 'Да. Сайт работает с 2019 года по лицензии игорного регулятора Anjouan № ALSI-202503005-FI1, оператор — Elsikora Group Limitada.',
	'В какой валюте можно играть?'  => 'В национальной валюте (рубли, тенге и другие) или в криптовалюте — Bitcoin, USDT и других.',
	'Как связаться с поддержкой?'   => 'Поддержка работает круглосуточно: онлайн-чат на сайте или e-mail support@selector.gg. Отвечают на русском языке.',
);

// Разметка вопросов-ответов для поисковиков (Schema.org FAQPage) из того же массива.
$sel_faq_schema = array(
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'mainEntity' => array(),
);
foreach ( $sel_faq as $sel_q => $sel_a ) {
	$sel_faq_schema['mainEntity'][] = array(
		'@type'          => 'Question',
		'name'           => $sel_q,
		'acceptedAnswer' => array(
			'@type' => 'Answer',
			'text'  => $sel_a,
		),
	);
}
?>
<script type="application/ld+json"><?php echo wp_json_encode( $sel_faq_schema, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG ); ?></script>
<section class="section" id="faq" aria-labelledby="faq-title">
	<div class="container">
		<div class="faq-block">
			<div class="section-head">
				<h2 class="section-head__title" id="faq-title">Вопросы и ответы</h2>
			</div>
			<div class="faq">
				<?php $sel_first = true; ?>
				<?php foreach ( $sel_faq as $sel_q => $sel_a ) : ?>
					<details class="faq__item" name="faq"<?php echo $sel_first ? ' open' : ''; ?>>
						<summary class="faq__q"><?php echo esc_html( $sel_q ); ?></summary>
						<p class="faq__a"><?php echo esc_html( $sel_a ); ?></p>
					</details>
					<?php $sel_first = false; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
