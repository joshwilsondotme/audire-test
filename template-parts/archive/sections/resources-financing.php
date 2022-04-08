<?php 
  $financing_bg = get_sub_field( 'color_options' );
?>
<section id="financing" class="resources__section resources__financing padding-y-xxl bg-<?= $financing_bg; ?>">
  <div class="container max-width-md text-component text-center">
    <?php the_sub_field( 'content' ); ?>
  </div>
  <div class="container max-width-lg">
    <?php
        
      $financing_query = new WP_Query( array(
        'post_type' => 'resources',
        'order' => 'ASC',
        'orderby' => 'menu_order title',
        'tax_query' => array(
          array (
              'taxonomy' => 'resources_type',
              'field' => 'slug',
              'terms' => 'financing',
          )
        ),
      ) );
        
      if ( $financing_query->have_posts() ) {
        echo '<ul class="flex-grid">';
        
        while ( $financing_query->have_posts() ) {
          $financing_query->the_post();
          
          echo '<li><a href="' . get_permalink() . '" class="hover-card">
            <h4>' . get_the_title() . '</h4>
            <p>' . get_the_excerpt() . '</p>
          </a></li>';
        }
        
        echo '</ul>';
      }
      
      wp_reset_postdata();
      
    ?>
  </div>
</section