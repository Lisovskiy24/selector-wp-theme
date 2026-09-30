<?php
/**
 * Игры (компонент Game Card из UI-кита).
 * Если в разделе «Игры» в админке есть записи — выводятся они с кнопками «Играть» / «Демо»
 * и плиткой «Все игры». Пока записей нет — категории игр и плитка «Спорт».
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

$sel_games = selector_get_games( 3 );
?>
<section class="section" id="games" aria-labelledby="games-title">
	<div class="container">
		<div class="section-head">
			<h2 class="section-head__title" id="games-title"><?php echo $sel_games ? 'Популярные игры' : 'Игры и ставки'; ?></h2>
			<a class="section-head__link" <?php sel_go_attrs(); ?>>Все игры <?php sel_icon( 'arrow-right' ); ?></a>
		</div>

		<ul class="games">
			<?php if ( $sel_games ) : ?>
				<?php foreach ( $sel_games as $sel_game ) : ?>
					<li class="game">
						<?php
						echo wp_get_attachment_image(
							$sel_game['image_id'],
							'selector-game',
							false,
							array(
								'class'    => 'game__art',
								'alt'      => '',
								'loading'  => 'lazy',
								'decoding' => 'async',
							)
						);
						?>

						<?php if ( $sel_game['exclusive'] ) : ?>
							<span class="game__tag"><?php sel_icon( 'shield', 12 ); ?>Эксклюзив</span>
						<?php endif; ?>

						<?php if ( '' !== $sel_game['rating'] ) : ?>
							<span class="game__rating"><?php sel_icon( 'star', 12 ); ?><?php echo esc_html( $sel_game['rating'] ); ?></span>
						<?php endif; ?>

						<h3 class="game__title"><?php echo esc_html( $sel_game['title'] ); ?></h3>
						<p class="game__provider"><?php echo esc_html( $sel_game['provider'] ); ?></p>

						<div class="game__hover">
							<a class="btn btn--primary btn--sm" <?php sel_go_attrs(); ?> aria-label="<?php echo esc_attr( 'Играть в ' . $sel_game['title'] ); ?>">Играть</a>
							<a class="btn btn--secondary btn--sm" <?php sel_go_attrs(); ?> aria-label="<?php echo esc_attr( 'Демо ' . $sel_game['title'] ); ?>">Демо</a>
						</div>
					</li>
				<?php endforeach; ?>

				<li class="game game--more">
					<a class="game__more" <?php sel_go_attrs(); ?>>
						<span class="game__more-icon"><?php sel_icon( 'dice', 26 ); ?></span>
						<span class="game__more-value"><?php echo esc_html( sel_opt( 'games_count' ) ); ?></span>
						<span class="game__more-text">слотов, live-казино и&nbsp;crash-игр</span>
						<span class="btn btn--secondary btn--sm">Смотреть все</span>
					</a>
				</li>
			<?php else : ?>
				<?php foreach ( selector_game_categories() as $sel_cat ) : ?>
					<li class="game">
						<img class="game__art" src="<?php echo esc_url( sel_img( $sel_cat['image'] ) ); ?>" width="480" height="643" alt="" loading="lazy" decoding="async">
						<h3 class="game__title"><?php echo esc_html( $sel_cat['title'] ); ?></h3>
						<p class="game__provider"><?php echo esc_html( $sel_cat['text'] ); ?></p>
						<div class="game__hover">
							<a class="btn btn--primary btn--sm" <?php sel_go_attrs(); ?> aria-label="<?php echo esc_attr( 'Перейти в раздел «' . $sel_cat['title'] . '»' ); ?>">Перейти</a>
						</div>
					</li>
				<?php endforeach; ?>

				<li class="game game--more">
					<a class="game__more" <?php sel_go_attrs(); ?>>
						<span class="game__more-icon"><?php sel_icon( 'zap', 26 ); ?></span>
						<span class="game__more-value">Спорт</span>
						<span class="game__more-text">футбол, баскетбол, Dota&nbsp;2 и&nbsp;CS: ставки до&nbsp;матча и&nbsp;по&nbsp;ходу игры</span>
						<span class="btn btn--secondary btn--sm">Смотреть</span>
					</a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</section>
