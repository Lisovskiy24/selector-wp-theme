<?php
/**
 * Меню по умолчанию — якоря по секциям главной.
 * Показывается, пока в «Внешний вид → Меню» не назначено меню «В шапке».
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

$sel_base  = is_front_page() ? '' : home_url( '/' );
$sel_items = array(
	'bonuses' => array( 'Бонусы', 'gift' ),
	'games'   => array( 'Игры', 'dice' ),
	'vip'     => array( 'VIP', 'crown' ),
	'review'  => array( 'Обзор', 'star' ),
	'faq'     => array( 'FAQ', 'headset' ),
);
?>
<ul class="nav__list">
	<?php foreach ( $sel_items as $sel_anchor => $sel_item ) : ?>
		<li>
			<a class="nav__link" href="<?php echo esc_url( $sel_base . '#' . $sel_anchor ); ?>">
				<?php sel_icon( $sel_item[1] ); ?><?php echo esc_html( $sel_item[0] ); ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
