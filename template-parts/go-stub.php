<?php
/**
 * Заглушка /go/…/, пока партнёрская ссылка не задана в «Настроить → Оффер».
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="section">
	<div class="container container--narrow">
		<div class="article">
			<h1 class="article__title">Переход на сайт казино</h1>
			<p>Здесь будет редирект по партнёрской ссылке. Укажите её в «Внешний вид → Настроить → Оффер → Партнёрская ссылка».</p>
			<p><a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">← Вернуться на главную</a></p>
		</div>
	</div>
</main>
<?php
get_footer();
