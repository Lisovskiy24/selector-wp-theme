<?php
/**
 * Любая одиночная страница или запись. По иерархии шаблонов WordPress берёт singular.php,
 * если нет более точных page.php / single.php.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="section">
	<div class="container container--narrow">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'article entry-content' ); ?>>
				<h1 class="article__title"><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
		<?php endwhile; ?>
	</div>
</main>
<?php
get_footer();
