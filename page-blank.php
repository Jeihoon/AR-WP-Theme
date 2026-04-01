<?php
/**
 * Template Name: Blank (Normal Width)
 * Description: Normal-width wrapper that prints only the page’s content.
 */
get_header();
?>

<main class="container py-3 mt-3">
    <h1 class="mb-4 text-left" style="margin-top: 20px"><?php the_title(); ?></h1>

    <div class="ar-page-content-wrapper">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
          the_content();
        endwhile;
      endif;
      ?>
    </div>
</main>

<?php get_footer(); ?>
