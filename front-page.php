<?php
/**
 * Главная страница-лендинг.
 * Секции собраны из template-parts; текст обзора берётся из содержимого страницы,
 * назначенной главной («Настройки → Чтение»), а если он пуст — из шаблона по умолчанию.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main>
	<?php
	get_template_part( 'template-parts/offer' );
	get_template_part( 'template-parts/bonuses' );
	get_template_part( 'template-parts/games' );
	get_template_part( 'template-parts/vip' );
	?>

	<div class="section">
		<div class="container layout">
			<?php
			$sel_content = '';
			if ( is_page() ) {
				while ( have_posts() ) {
					the_post();
					$sel_content = trim( get_the_content() );
				}
			}

			if ( $sel_content ) :
				?>
				<article class="article entry-content" id="review">
					<?php the_content(); ?>
				</article>
				<?php
			else :
				get_template_part( 'template-parts/review-default' );
			endif;

			get_template_part( 'template-parts/sidebar' );
			?>
		</div>
	</div>

	<?php get_template_part( 'template-parts/faq' ); ?>
</main>

<?php
get_footer();
