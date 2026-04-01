<?php
/**
 * Template Name: Blank (Full Width)
 * Description: Edge-to-edge layout that prints the page’s content only.
 */
get_header();
?>

<main class="container py-3 mt-3">
    <h1 class="mb-4 text-left"><?php the_title(); ?></h1>
  <?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			the_content();            // prints Gutenberg blocks
		endwhile;
	endif;
	?>

</main>

<?php get_footer(); ?>
