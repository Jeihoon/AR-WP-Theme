<?php
get_header();

// Escape search term
$search_term = get_search_query( false );
?>

<div class="container py-5">
  <div class="row justify-content-center">

    <!-- Centered Search Results Column -->
    <main class="col-12 col-md-8 col-lg-8">

      <!-- Header with centered text -->
      <header class="ar-search-header text-center mb-4">
        <h1 class="ar-search-title h3">
          <?php
            /* translators: %s: search term */
            printf(
              esc_html__( 'Search Results for: %s', 'ar-theme' ),
              '<span class="ar-search-term">' . esc_html( $search_term ) . '</span>'
            );
          ?>
        </h1>
      </header>

      <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class( 'ar-post-item mb-5' ); ?>>

            <?php if ( has_post_thumbnail() ) : ?>
              <div class="ar-post-thumb mb-3">
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail( 'ar-thumb-large', [ 'class' => 'ar-thumb-img rounded' ] ); ?>
                </a>
              </div>
            <?php endif; ?>

            <h2 class="ar-post-title h4 mb-2 text-center">
              <a class="ar-post-title-link" href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
              </a>
            </h2>

            <p class="ar-excerpt mb-4 text-center">
              <?php echo wp_trim_words( get_the_excerpt() ?: get_the_content(), 30, '…' ); ?>
            </p>

          </article>
        <?php endwhile; ?>

        <?php
        global $wp_query;

        if ( $wp_query->max_num_pages > 1 ) :

          $big = 999999999; // need an unlikely integer

          $pagination = paginate_links( [
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => max( 1, get_query_var( 'paged' ) ),
            'total'     => $wp_query->max_num_pages,
            'prev_text' => __( '← Prev', 'ar-theme' ),
            'next_text' => __( 'Next →', 'ar-theme' ),
            'add_args'  => [ 's' => $search_term ],
            'type'      => 'list',
          ] );
        ?>
 <!-- Pagination -->
      <nav class="ar-pagination mt-4">
        <?php
          if ( function_exists( 'ar_theme_pagination' ) ) {
            ar_theme_pagination();
          } else {
            the_posts_pagination([
              'mid_size'  => 2,
              'prev_text' => __( '← Prev', 'ar-theme' ),
              'next_text' => __( 'Next →', 'ar-theme' ),
            ]);
          }
        ?>
      </nav>
        <?php endif; ?>

      <?php else : ?>

        <?php get_template_part( 'template-parts/content', 'none' ); ?>

      <?php endif; ?>

    </main>

  </div>
</div>

<?php get_footer(); ?>
