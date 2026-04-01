<?php
get_header();

// Customizer toggles
$ar_show_meta      = get_theme_mod( 'blog_meta',           true );
$ar_show_date      = get_theme_mod( 'blog_date',           true );
$ar_show_author    = get_theme_mod( 'blog_author',         true );
$ar_show_avatar    = get_theme_mod( 'blog_avatar',         true );
$ar_show_category  = get_theme_mod( 'blog_category',       true );
$ar_show_comments  = get_theme_mod( 'blog_comments_count', true );
?>

<div class="container py-5">
  <div class="row gx-0">

    <!-- Main Content (Single Post) -->
    <main class="col-12 col-lg-8 pe-lg-4">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'ar-single-post rounded bordered mb-5' ); ?>>

          <!-- Featured Image -->
          <?php if ( has_post_thumbnail() ) : ?>
            <div class="ar-thumb mb-4">
              <div class="ar-thumb-inner">
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail( 'ar-thumb-large' ); ?>
                </a>
              </div>
            </div>
          <?php endif; ?>

          <div class="ar-post-area">

            <!-- Title -->
            <h1 class="ar-single-post-title mb-3">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h1>

            <!-- Meta -->
            <?php if ( $ar_show_meta ) : ?>
              <ul class="ar-meta list-inline mb-4">

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

                <?php if ( $ar_show_comments ) : ?>
                  <li class="ar-meta-item list-inline-item ar-meta-comments">
                    <i class="fas fa-comments"></i>
                    <?php comments_number( '0', '1', '%' ); ?>
                  </li>
                <?php endif; ?>

              </ul>
            <?php endif; ?>

            <!-- Content -->
            <div class="ar-post-content mb-5">
              <?php the_content(); ?>
            </div>

            <!-- Page Links (if paginated) -->
            <?php
              wp_link_pages( [
                'before'      => '<nav class="ar-post-pagination">',
                'after'       => '</nav>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
              ] );
            ?>

          </div>
        </article>

<!-- Post Navigation (Modern Three-Column) -->
<nav class="ar-post-nav-modern mb-5">
  <div class="ar-nav-inner">
    <!-- Previous -->
    <div class="ar-nav-col ar-nav-prev">
      <?php 
      $prev_post = get_previous_post();
      if ( $prev_post ) :
      ?>
        <a class="ar-nav-btn" href="<?php echo get_permalink( $prev_post->ID ); ?>">
          <span class="ar-nav-icon"><i class="fas fa-chevron-left"></i></span>
          <span class="ar-nav-label">Previous</span>
        </a>
      <?php endif; ?>
    </div>
    <!-- Center icon or dots -->
    <div class="ar-nav-col ar-nav-center">
      <span class="ar-nav-center-icon">
        <!-- Use grid dots icon from FontAwesome (fa-th) or custom SVG if you like -->
        <i class="fa-solid fa-grip"></i>
      </span>
    </div>
    <!-- Next -->
    <div class="ar-nav-col ar-nav-next">
      <?php 
      $next_post = get_next_post();
      if ( $next_post ) :
      ?>
        <a class="ar-nav-btn" href="<?php echo get_permalink( $next_post->ID ); ?>">
          <span class="ar-nav-label">Next</span>
          <span class="ar-nav-icon"><i class="fas fa-chevron-right"></i></span>
        </a>
      <?php endif; ?>
    </div>
  </div>
</nav>


        <!-- Comments Section -->
<div class="ar-comments-section">
  <?php
    if ( comments_open() || get_comments_number() ) {
      comments_template();
    }
  ?>
</div>


      <?php endwhile; endif; ?>
    </main>

    <!-- Sidebar -->
    <aside id="sidebar-blog" class="col-12 col-lg-4 ar-sidebar">
      <?php if ( is_active_sidebar( 'blog-sidebar' ) ) {
        dynamic_sidebar( 'blog-sidebar' );
      } ?>
    </aside>

  </div>
</div>

<?php get_footer(); ?>
