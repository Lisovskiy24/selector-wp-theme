<?php
/**
 * Общий шаблон: список записей, архивы, поиск.
 * WordPress использует его, когда не нашёл более подходящего шаблона.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="section">
	<div class="container container--narrow">
		<?php if ( have_posts() ) : ?>
			<div class="article">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class(); ?>>
						<h2 class="article__h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php the_excerpt(); ?>
					</article>
				<?php endwhile; ?>
				<?php the_posts_pagination(); ?>
			</div>
		<?php else : ?>
			<div class="article">
				<h1 class="article__title">Ничего не найдено</h1>
				<p><a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">На главную</a></p>
			</div>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
