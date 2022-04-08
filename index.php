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

// if ( post_password_required() ) {
//   echo get_the_password_form();
// }

if ( get_post_type() == 'news' ) {
    
  if ( have_posts() ) : while ( have_posts() ) : the_post();
    $post_type = get_post_type();
    get_template_part('template-parts/single/news');
  endwhile; endif;
  
} elseif (  is_home() ) {
  echo '<div class="blog">';

  get_template_part('template-parts/archive/sections/blog-header');
  
  // check to see if blog index is paged an
  $paged = $wp_query->get( 'paged' );

  if ( ! $paged || $paged < 2 ) {
    get_template_part('template-parts/archive/sections/blog-featured');
  }

  get_template_part('template-parts/archive/sections/blog-list');

  echo '</div>';
  
} elseif( is_front_page() || is_page_template('page-builder.php') ) {
    
  echo '<div id="home-page">';
  if(have_rows('layouts')) :

    $block_count = 0;
  
    while(have_rows('layouts')) : the_row();
    
      ACF_Layout::render(get_row_layout(), $block_count);
      $block_count++;
  
    endwhile;
  
  endif;
  echo '</div>';
  // echo do_shortcode( '[content_block slug=footer-cta]' ); 
} else {
    
  if ( have_posts() ) : while ( have_posts() ) : the_post();
    $post_type = get_post_type();
    get_template_part('template-parts/single/page');
  endwhile; endif;
  
}

get_footer();
?>
