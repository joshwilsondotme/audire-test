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

  echo '<div class="blog">';

  get_template_part('template-parts/archive/sections/blog-header');

  get_template_part('template-parts/archive/sections/blog-list');

  echo '</div>';

get_footer();
?>
