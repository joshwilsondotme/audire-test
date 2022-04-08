<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

get_header();

if ( post_password_required() ) {
  echo get_the_password_form();
} 

else { 

  if ( have_posts() ) : while ( have_posts() ) : the_post();
    $post_type = get_post_type();
    get_template_part('template-parts/single/'.$post_type);
  endwhile; endif;
}

get_footer();
?>
