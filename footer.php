<?php
/**
 * Подвал сайта.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;
?>
<footer class="footer">
	<div class="container">
		<div class="footer__top">
			<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="logo__mark" aria-hidden="true"><?php echo esc_html( mb_substr( sel_opt( 'brand' ), 0, 1 ) ); ?></span>
				<span class="logo__text"><?php echo esc_html( mb_strtolower( sel_opt( 'brand' ) ) ); ?></span>
			</a>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'footer__nav',
						'depth'          => 1,
					)
				);
			} else {
				$sel_base = is_front_page() ? '' : home_url( '/' );
				?>
				<ul class="footer__nav">
					<li><a href="<?php echo esc_url( $sel_base . '#bonuses' ); ?>">Бонусы</a></li>
					<li><a href="<?php echo esc_url( $sel_base . '#games' ); ?>">Игры</a></li>
					<li><a href="<?php echo esc_url( $sel_base . '#vip' ); ?>">VIP</a></li>
					<li><a href="<?php echo esc_url( $sel_base . '#review' ); ?>">Обзор</a></li>
					<li><a href="<?php echo esc_url( $sel_base . '#faq' ); ?>">FAQ</a></li>
				</ul>
			<?php } ?>
		</div>

		<ul class="footer__pay" aria-label="Платёжные методы">
			<?php foreach ( array( 'Visa', 'Mastercard', 'СБП', 'USDT', 'Bitcoin' ) as $sel_method ) : ?>
				<li class="tag tag--muted"><?php echo esc_html( $sel_method ); ?></li>
			<?php endforeach; ?>
		</ul>

		<div class="footer__bottom">
			<span class="age">18+<span class="visually-hidden"> — только для лиц старше 18 лет</span></span>
			<p class="footer__text">
				Материал носит информационный характер. Азартные игры могут вызывать зависимость — играйте ответственно.
				Перед регистрацией убедитесь, что онлайн-казино разрешены в вашей стране.
			</p>
		</div>
		<p class="footer__copy">© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
	</div>
</footer>

<?php if ( is_front_page() ) : ?>
	<div class="sticky-cta" data-sticky-cta>
		<p class="sticky-cta__text"><span class="text-accent"><?php echo esc_html( sel_opt( 'bonus' ) ); ?></span> на первый депозит</p>
		<a class="btn btn--primary btn--sm" <?php sel_go_attrs(); ?>>Получить</a>
	</div>
<?php endif; ?>

<dialog class="lightbox" data-lightbox-dialog aria-label="Просмотр изображения">
	<button class="lightbox__close" type="button" data-lightbox-close aria-label="Закрыть">×</button>
	<img class="lightbox__img" src="data:," alt="" data-lightbox-img>
</dialog>

<?php wp_footer(); ?>
</body>
</html>
