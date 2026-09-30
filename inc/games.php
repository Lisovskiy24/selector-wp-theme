<?php
/**
 * Тип записей «Игры»: название, обложка (миниатюра записи), провайдер, рейтинг, метка «Эксклюзив».
 * В админке появляется раздел «Игры» с иконкой кубика.
 *
 * @package Selector
 */

defined( 'ABSPATH' ) || exit;

/**
 * Регистрирует тип записей.
 */
function selector_register_games() {
	register_post_type(
		'sel_game',
		array(
			'labels'       => array(
				'name'          => 'Игры',
				'singular_name' => 'Игра',
				'add_new_item'  => 'Добавить игру',
				'edit_item'     => 'Редактировать игру',
				'all_items'     => 'Все игры',
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-games',
			'supports'     => array( 'title', 'thumbnail', 'page-attributes' ),
		)
	);
}
add_action( 'init', 'selector_register_games' );

/**
 * Поля игры в боковой колонке редактора.
 */
function selector_game_meta_box() {
	add_meta_box( 'sel_game_meta', 'Параметры игры', 'selector_game_meta_render', 'sel_game', 'side' );
}
add_action( 'add_meta_boxes', 'selector_game_meta_box' );

/**
 * Вывод полей.
 *
 * @param WP_Post $post Текущая игра.
 */
function selector_game_meta_render( $post ) {
	wp_nonce_field( 'sel_game_meta', 'sel_game_nonce' );
	$provider  = get_post_meta( $post->ID, '_sel_provider', true );
	$rating    = get_post_meta( $post->ID, '_sel_rating', true );
	$exclusive = get_post_meta( $post->ID, '_sel_exclusive', true );
	?>
	<p>
		<label for="sel_provider">Провайдер</label><br>
		<input type="text" id="sel_provider" name="sel_provider" value="<?php echo esc_attr( $provider ); ?>" class="widefat">
	</p>
	<p>
		<label for="sel_rating">Рейтинг (0–5)</label><br>
		<input type="number" id="sel_rating" name="sel_rating" value="<?php echo esc_attr( $rating ); ?>" min="0" max="5" step="0.1" class="widefat">
	</p>
	<p>
		<label><input type="checkbox" name="sel_exclusive" value="1" <?php checked( $exclusive, '1' ); ?>> Эксклюзив</label>
	</p>
	<p class="description">Обложку задайте в блоке «Изображение записи» (3:4, от 480×640).</p>
	<?php
}

/**
 * Сохранение полей.
 *
 * @param int $post_id ID игры.
 */
function selector_game_meta_save( $post_id ) {
	if ( ! isset( $_POST['sel_game_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['sel_game_nonce'] ), 'sel_game_meta' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$provider = isset( $_POST['sel_provider'] ) ? sanitize_text_field( wp_unslash( $_POST['sel_provider'] ) ) : '';
	$rating   = isset( $_POST['sel_rating'] ) ? min( 5, max( 0, (float) $_POST['sel_rating'] ) ) : '';

	update_post_meta( $post_id, '_sel_provider', $provider );
	update_post_meta( $post_id, '_sel_rating', $rating );
	update_post_meta( $post_id, '_sel_exclusive', isset( $_POST['sel_exclusive'] ) ? '1' : '' );
}
add_action( 'save_post_sel_game', 'selector_game_meta_save' );

/**
 * Игры для главной из раздела «Игры» в админке. Пустой массив, если игр ещё нет.
 *
 * @param int $limit Сколько игр вывести.
 * @return array Список массивов: title, provider, rating, exclusive, image_id.
 */
function selector_get_games( $limit = 3 ) {
	$query = new WP_Query(
		array(
			'post_type'      => 'sel_game',
			'posts_per_page' => $limit,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'DESC',
			),
			'no_found_rows'  => true,
		)
	);

	$games = array();
	foreach ( $query->posts as $post ) {
		$games[] = array(
			'title'     => get_the_title( $post ),
			'provider'  => get_post_meta( $post->ID, '_sel_provider', true ),
			'rating'    => get_post_meta( $post->ID, '_sel_rating', true ),
			'exclusive' => '1' === get_post_meta( $post->ID, '_sel_exclusive', true ),
			'image_id'  => get_post_thumbnail_id( $post ),
		);
	}

	return $games;
}

/**
 * Категории игр — показываются на главной, пока в разделе «Игры» нет записей.
 * Обложки — иллюстрации темы: реальные обложки слотов принадлежат провайдерам.
 *
 * @return array Список массивов: title, text, image.
 */
function selector_game_categories() {
	return array(
		array(
			'title' => 'Слоты',
			'text'  => 'Pragmatic Play, NetEnt, Playtech',
			'image' => 'game-mallard.webp',
		),
		array(
			'title' => 'Live-казино',
			'text'  => 'Рулетка, блэкджек, баккара',
			'image' => 'game-tide.webp',
		),
		array(
			'title' => 'Быстрые игры',
			'text'  => 'Crash и мгновенные раунды',
			'image' => 'game-dawn.webp',
		),
	);
}
