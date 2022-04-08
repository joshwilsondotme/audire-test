<?php 
  // Blog Data
  $postType = get_post_type();
  $author   = get_the_author();
  
  // Layout Variables
  $blogSettings = get_fields('blog-options', false);

  //Page Title Settings
  if ( have_rows( 'title_design_options', 'staff-options' ) ) :
    while ( have_rows( 'title_design_options', 'staff-options' ) ) : the_row();
      $title_bg_color = get_sub_field( 'color_options' );
    endwhile;
  endif;

  
?>
<section class="blog__header bg-<?= $title_bg_color; ?> padding-y-xxl">
  <div class="container max-width-md text-component text-center">
    <?php
    
    // Blog Overview Page    
    if ( is_home() ) {
      echo $blogSettings['blog_introduction'];
    } elseif ( is_category(  ) ) {
      echo '<h1>' . single_cat_title( __( 'Currently browsing: ', 'textdomain' ) ) . '</h1>
      <a href="' . get_post_type_archive_link($postType) . '"><i class="fal fa-long-arrow-left"></i> Back to Blog</a>';
    } elseif ( is_author(  ) ) {
      echo '<h1>Posts by: ' . $author . '</h1>
      <a href="' . get_post_type_archive_link($postType) . '"><i class="fal fa-long-arrow-left"></i> Back to Blog</a>';
    }
    
    ?>
  </div>
</section>