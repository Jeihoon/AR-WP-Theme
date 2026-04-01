<?php
/*
Template Name: Front Page
*/
get_header( 'transparent' );
?>

<?php
/* ===== fetch repeatable hero slides (stored as JSON) ===== */
$slides = json_decode( get_post_meta( get_the_ID(), 'hero_slides', true ), true ) ?: [];
?>

<?php if ( $slides ) : ?>
<section class="hero-slider"><!-- half-screen slider behind transparent header -->
	<div class="swiper">
		<div class="swiper-wrapper">

			<?php
foreach ( $slides as $s ) :

	$img_id = (int) ( $s['img'] ?? 0 );
	if ( ! $img_id ) continue;

	$src  = wp_get_attachment_image_url( $img_id, 'full' );
	if ( ! $src ) continue;

	$hex  = $s['ovc'] ?? '#000000';
	$opa  = isset( $s['ova'] ) ? (int) $s['ova'] : 40;   // 0-100
	$rgb  = sscanf( $hex, "#%02x%02x%02x" );
	$rgba = sprintf( 'rgba(%d,%d,%d,%.2f)', $rgb[0], $rgb[1], $rgb[2], $opa / 100 );

?>
	<div class="swiper-slide" style="background-image:
		linear-gradient(<?php echo esc_attr( $rgba ); ?>,<?php echo esc_attr( $rgba ); ?>),
		url('<?php echo esc_url( $src ); ?>')">

		<div class="slide-caption container text-center">
			<?php if ( $s['head'] ) : ?><h1><?php echo esc_html( $s['head'] ); ?></h1><?php endif; ?>
			<?php if ( $s['sub']  ) : ?><p class="lead"><?php echo esc_html( $s['sub']  ); ?></p><?php endif; ?>
			<?php if ( $s['btxt'] && $s['burl'] ) : ?>
				<a href="<?php echo esc_url( $s['burl'] ); ?>" class="btn btn-primary mt-3">
					<?php echo esc_html( $s['btxt'] ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
<?php endforeach; ?>

		</div>

		<div class="swiper-pagination"></div>
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>
	</div>
</section>

<?php endif; ?>

<main class="container py-5" >
	<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
</main>

<?php get_footer(); ?>
