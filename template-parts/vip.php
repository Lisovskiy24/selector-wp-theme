<?php
/**
 * VIP-баннер (Hero Banner, пресет VIP из UI-кита).
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section" id="vip" aria-labelledby="vip-title">
	<div class="container">
		<div class="banner banner--vip">
			<picture class="banner__art">
				<source srcset="<?php echo esc_url( sel_img( 'hero-vip.webp' ) ); ?>" media="(min-width: 768px)" width="1600" height="678">
				<img src="<?php echo esc_url( sel_img( 'hero-vip-m.webp' ) ); ?>" width="720" height="678" alt="" loading="lazy" decoding="async">
			</picture>
			<div class="banner__content">
				<p class="chip"><?php sel_icon( 'crown', 15 ); ?>VIP-клуб</p>
				<h2 class="banner__title banner__title--l" id="vip-title">Релоады, рейкбэк и&nbsp;личный менеджер</h2>
				<p class="banner__text">Уровни от Бронзы и выше: бонус за каждый переход, ежемесячные и еженедельные релоады, а&nbsp;на&nbsp;старших уровнях — персональный менеджер.</p>
				<div class="banner__cta">
					<a class="btn btn--primary btn--lg" <?php sel_go_attrs(); ?>>Вступить в VIP</a>
				</div>
			</div>
		</div>
	</div>
</section>
