<?php
get_header();

// Customizer toggles
$ar_show_meta       = get_theme_mod( 'blog_meta',           true );
$ar_show_date       = get_theme_mod( 'blog_date',           true );
$ar_show_author     = get_theme_mod( 'blog_author',         true );
$ar_show_avatar     = get_theme_mod( 'blog_avatar',         true );
$ar_show_category   = get_theme_mod( 'blog_category',       true );
$ar_show_comments   = get_theme_mod( 'blog_comments_count', true );
$ar_show_share      = get_theme_mod( 'blog_archive_share',  true );
$ar_excerpt_length  = get_theme_mod( 'except',             80 );

// ── LIMIT TO 3 POSTS PER PAGE ──
$paged = max(
  1,
  get_query_var( 'paged' ),
  get_query_var( 'page' )
);

query_posts( array_merge(
    $wp_query->query_vars,
    [
      'posts_per_page' => 3,
      'paged'          => $paged,
    ]
) );
?>

<div class="container py-5">
  <div class="row gx-0">

    <!-- Posts Column -->
    <main class="col-12 col-lg-8 pe-lg-4">

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <!-- Thumbnail -->
          <div>
            <div class="ar-thumb-inner">
              <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail(); ?>
                </a>
              <?php endif; ?>
            </div>
          </div>

          <div class="post-area">
            <!-- Title -->
            <h3 class="ar-post-title">
              <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
              </a>
            </h3>

            <!-- Excerpt -->
            <div>
              <p class="ar-excerpt mb-0">
                <?php
                  $content = get_the_content();
                  echo wp_kses_post( wp_trim_words( $content, absint( $ar_excerpt_length ) ) );
                ?>
              </p>
            </div>

            <!-- Meta Info (inline with Continue Reading) -->
            <?php if ( $ar_show_meta ) : ?>
              <ul class="ar-meta list-inline mt-2 d-flex flex-wrap align-items-center gap-3">
                <?php if ( $ar_show_author ) : ?>
                  <li class="ar-meta-item list-inline-item ar-meta-author">
                    <?php if ( $ar_show_avatar ) {
                      echo get_avatar( get_the_author_meta( 'ID' ), 32, '', '', [ 'class' => 'ar-avatar' ] );
                    } ?>
                    <?php the_author_posts_link(); ?>
                  </li>
                <?php endif; ?>

                <?php if ( $ar_show_date ) : ?>
                  <li class="ar-meta-item list-inline-item ar-meta-date">
                    <?php echo get_the_date(); ?>
                  </li>
                <?php endif; ?>

                <?php if ( $ar_show_category ) : ?>
                  <li class="ar-meta-item list-inline-item ar-meta-category">
                    <?php echo get_the_category_list( ', ' ); ?>
                  </li>
                <?php endif; ?>

                <!-- Inline Continue Reading -->
                <li class="ar-meta-item list-inline-item ar-meta-readmore ms-auto">
                  <a href="<?php the_permalink(); ?>" class="ar-btn-readmore">
                    <?php esc_html_e( 'Continue reading', 'ar-theme' ); ?>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                  </a>
                </li>
              </ul>
            <?php endif; ?>

          </div>

        </article>

      <?php endwhile; else : ?>

        <?php get_template_part( 'template-parts/content', 'none' ); ?>

      <?php endif; ?>

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

    </main>

    <!-- Sidebar -->
    <aside id="sidebar-blog" class="col-12 col-lg-4 ar-sidebar">
      <?php if ( is_active_sidebar( 'blog-sidebar' ) ) {
        dynamic_sidebar( 'blog-sidebar' );
      } ?>
    </aside>

  </div>
</div>

<?php
get_footer();
