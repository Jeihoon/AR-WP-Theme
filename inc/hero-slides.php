<?php
/**
 * Repeatable Hero-Slider fields for the static front page.
 * Data is stored as a single JSON string in “hero_slides”.
 */

namespace ARTheme\HeroSlides;

/* ───────────────── 1. Register meta key ───────────────── */
add_action( 'init', function () {
	register_post_meta( 'page', 'hero_slides', [
		'single'       => true,
		'type'         => 'string',
		'show_in_rest' => true,
		'auth_callback'=> '__return_true',
	] );
} );

/* ───────────────── 2. Meta-box on static front page only ───────────────── */
add_action( 'add_meta_boxes', function () {

	$front_id = (int) get_option( 'page_on_front' );
	if ( ! $front_id ) return;

	add_meta_box(
		'hero_slides_mb',
		__( 'Front-Page Slides', 'ar-theme' ),
		__NAMESPACE__ . '\\metabox_cb',
		'page',
		'normal',
		'default',
		[ 'front_id' => $front_id ]
	);
} );

function metabox_cb( $post, $box ) {

	if ( (int) $post->ID !== (int) $box['args']['front_id'] ) {
		echo '<p>' . esc_html__( 'This meta-box appears only on the static front page.', 'ar-theme' ) . '</p>';
		return;
	}

	wp_nonce_field( 'hero_slides_save', 'hero_slides_nonce' );
	$slides = json_decode( get_post_meta( $post->ID, 'hero_slides', true ), true ) ?: [];
	?>
	<style>
		#hero-slides-table th,#hero-slides-table td{padding:6px 4px;text-align:left}
		#hero-slides-table input{width:100%}
	</style>

	<table class="widefat" id="hero-slides-table">
		<thead>
			<tr>
				<th><?php _e( 'Image',       'ar-theme' ); ?></th>
				<th><?php _e( 'Heading',     'ar-theme' ); ?></th>
				<th><?php _e( 'Sub-heading', 'ar-theme' ); ?></th>
				<th><?php _e( 'Button Text', 'ar-theme' ); ?></th>
				<th><?php _e( 'Button URL',  'ar-theme' ); ?></th>
				<th><?php _e( 'Overlay', 'ar-theme' ); ?></th>     
                <th><?php _e( 'Opacity (%)', 'ar-theme' ); ?></th>
				
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $slides as $i => $s ) echo row_html( $i, $s ); ?>
		</tbody>
	</table>

	<p><button type="button" class="button" id="add-slide"><?php _e( 'Add Slide', 'ar-theme' ); ?></button></p>

	<script>
	(function($){
		const tbody = $('#hero-slides-table tbody');
		let idx     = <?php echo count( $slides ); ?>;

		/* add new blank row */
		$('#add-slide').on('click', () => {
			tbody.append(
				<?php echo json_encode( row_html( '__i__' ) ); ?>.replace(/__i__/g, idx)
			);
			idx++;
		});

		/* select image via Media Library */
		$(document).on('click', '.select-img', function(){
			const $row    = $(this).closest('tr');
			const $input  = $row.find('input[type=hidden]');
			const $thumb  = $row.find('img');
			const $remove = $row.find('.remove-img');

			const frame = wp.media({
				title:  '<?php echo esc_js( __( 'Choose slide image', 'ar-theme' ) ); ?>',
				button: { text:'<?php echo esc_js( __( 'Use this image', 'ar-theme' ) ); ?>' },
				multiple:false
			});

			frame.on('select', () => {
				const att = frame.state().get('selection').first().toJSON();
				$input.val(att.id);
				$thumb.attr('src', att.sizes.thumbnail.url).show();
				$remove.show();
			});

			frame.open();
		});

		/* remove selected image */
		$(document).on('click', '.remove-img', function(){
			const $row = $(this).closest('tr');
			$row.find('input[type=hidden]').val('');
			$row.find('img').hide();
			$(this).hide();
		});

		/* delete entire slide row */
		window.removeSlideRow = btn =>
			confirm('<?php echo esc_js( __( 'Remove this slide?', 'ar-theme' ) ); ?>') &&
			$(btn).closest('tr').remove();

	})(jQuery);
	</script>
	<?php
}

/* helper to print a table row */
function row_html( $i, $s = [] ) : string {
	$id   = (int) ( $s['img'] ?? 0 );
	$url  = $id ? wp_get_attachment_image_url( $id, 'thumbnail' ) : '';

	$col  = $s['ovc'] ?? '#000000';          // overlay-color
	$opa  = $s['ova'] ?? '40';               // opacity 0-100

	ob_start(); ?>
	<tr>
		<!-- image / picker -->
		<td>
			<div style="display:flex;align-items:center;gap:6px;">
				<img src="<?php echo esc_url( $url ); ?>" style="width:60px;height:60px;object-fit:cover;<?php echo $url?'':'display:none'; ?>">
				<input type="hidden" name="hero_slides[<?php echo $i; ?>][img]" value="<?php echo esc_attr( $id ); ?>">
				<button type="button" class="button select-img"><?php _e( 'Select Image', 'ar-theme' ); ?></button>
				<button type="button" class="button-link-delete remove-img" style="<?php echo $url?'':'display:none'; ?>">✕</button>
			</div>
		</td>

		<td><input type="text" name="hero_slides[<?php echo $i; ?>][head]" value="<?php echo esc_attr( $s['head'] ?? '' ); ?>"></td>
		<td><input type="text" name="hero_slides[<?php echo $i; ?>][sub]"  value="<?php echo esc_attr( $s['sub']  ?? '' ); ?>"></td>
		<td><input type="text" name="hero_slides[<?php echo $i; ?>][btxt]" value="<?php echo esc_attr( $s['btxt'] ?? '' ); ?>"></td>
		<td><input type="url"  name="hero_slides[<?php echo $i; ?>][burl]" value="<?php echo esc_attr( $s['burl'] ?? '' ); ?>"></td>

		<!-- new: color & opacity -->
		<td><input type="color" name="hero_slides[<?php echo $i; ?>][ovc]" value="<?php echo esc_attr( $col ); ?>"></td>
		<td><input type="number" min="0" max="100" step="1"
		           name="hero_slides[<?php echo $i; ?>][ova]" value="<?php echo esc_attr( $opa ); ?>" style="width:70px;"></td>

		<td><button type="button" class="button-link-delete" onclick="removeSlideRow(this)">✕</button></td>
	</tr>
	<?php
	return ob_get_clean();
}


/* ───────────────── 3. Save handler ───────────────── */
add_action( 'save_post_page', function ( $post_id ) {

	if ( ! isset( $_POST['hero_slides_nonce'] )
	     || ! wp_verify_nonce( $_POST['hero_slides_nonce'], 'hero_slides_save' ) ) {
		return;
	}

	if ( ! isset( $_POST['hero_slides'] ) || ! is_array( $_POST['hero_slides'] ) ) {
		delete_post_meta( $post_id, 'hero_slides' );
		return;
	}

	$clean = [];

	foreach ( $_POST['hero_slides'] as $row ) {
		if ( empty( $row['img'] ) ) continue;          // skip empty rows
		$clean[] = [
	'img'  => (int) $row['img'],
	'head' => sanitize_text_field( $row['head'] ?? '' ),
	'sub'  => sanitize_text_field( $row['sub']  ?? '' ),
	'btxt' => sanitize_text_field( $row['btxt'] ?? '' ),
	'burl' => esc_url_raw(         $row['burl'] ?? '' ),
	'ovc'  => preg_match( '/^#[0-9a-f]{6}$/i', $row['ovc'] ?? '' ) ? $row['ovc'] : '#000000',
	'ova'  => min( 100, max( 0, (int) ( $row['ova'] ?? 40 ) ) ),
];
	}

	update_post_meta( $post_id, 'hero_slides', wp_json_encode( $clean ) );
} );
