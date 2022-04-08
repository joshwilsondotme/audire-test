<?php
    
$the_query = new WP_Query( array(
  'post_type' => 'services',
  'order' => 'ASC',
  'orderby' => 'menu_order title',
  'tax_query' => array(
      array (
          'taxonomy' => 'services_type',
          'field' => 'slug',
          'terms' => 'general-service',
      )
  ),
) );

$bg_color = get_sub_field( 'color_options' );

?>

<section id="general-services" class="services__section services__general-services toc-item padding-y-xxl bg-<?= $bg_color; ?>">
  <div class="container max-width-md text-component text-center">
    <?php the_sub_field( 'content' ); ?>
  </div>
  <div class="container max-width-lg">
    <?php
      $count = 0;
      if ( $the_query->have_posts() ):

        echo '<ul class="flex-grid">';

        while ( $the_query->have_posts() ) : $the_query->the_post(); 
        
          $count++;
          
          echo '<li>
            <div class="img-outer-wrap">
              <div class="img-inner-wrap">
                <img src="' . get_template_directory_uri() . '/images/svgs/ear-soundwave.svg" alt="Ear Soundwave" />
              </div>
            </div>
            <h4>' . get_the_title() . '</h4>
            <p>' . get_the_excerpt() . '</p>
            <a href="' . get_the_permalink() . '" class="btn--link btn--icon-arrow" title="Learn More about ' . get_the_title() . '">Learn More</a>
          </li>';
          
        endwhile;
        
        echo '</ul>';
        
      endif;
      
    ?>
  </div>
</section>