<?php

$the_query = new WP_Query( array(
  'post_type' => 'services',
  'order' => 'ASC',
  'orderby' => 'menu_order title',
  'tax_query' => array(
      array (
          'taxonomy' => 'services_type',
          'field' => 'slug',
          'terms' => 'diagnostic-testing',
      )
  ),
) );

?>

<section id="diagnostic-testing" class="services__section toc-item bg-<?= get_sub_field( 'color_options' ); ?> padding-y-xxl">

<div class="container max-width-lg">
  <div class="grid grid-gap-xxxl">
    <div class="col-6@lg col-12 text-component text-center">
      <?php the_sub_field( 'content' ); ?>
    </div>
    <div class="col-6@lg col-12">
    <?php
        
      if ( $image = get_sub_field('image') ) {
        echo '<img loading="lazy" src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image['alt'] ) . '" class="lazyload" />';
      } else {
        echo '<img loading="lazy" src="' . get_template_directory_uri() . '/images/services_otoscope.jpg' . '" alt="Otoscope" class="lazyload">';
      }
      
    ?>
    </div>
    <div class="col-6@lg col-12 text-component">
      <?php
        
        $count = 0;
        $i = 0;
        
        if ( $the_query->have_posts() ) :  ?>

          <div id="accordionGroup-left" class="accordion" data-allow-toggle>

          <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
          $count++; $i++;
          ?>

            <div class="accordion__item">
              <h3>
                <button aria-expanded="<?= ($i == 1) ? "true" : "false" ?>"
                        class="accordion__trigger"
                        aria-controls="diagnostic-testing-sec<?= $count; ?>"
                        id="diagnostic-testing-accordion<?= $count; ?>id">
                  <span class="accordion__title">
                    <?php the_title(); ?>
                    <span class="accordion__icon"></span>
                  </span>
                </button>
              </h3>

              <div id="diagnostic-testing-sec<?= $count; ?>"
                  role="region"
                  aria-labelledby="diagnostic-testing-accordion<?= $count; ?>id"
                  class="accordion__panel"
                  <?= ($i == 1) ? "" : "hidden" ?>>
                <div class="accordion__panel-inner">
                  <?php the_excerpt(  ); ?>
                  <a href="<?php the_permalink(); ?>" class="btn--link btn--icon-arrow">More on <?php the_title(); ?></a>
                </div>
              </div>
            </div>
            
        <?php
            
          if ($i >= ($the_query->post_count / 2) ):
            echo '</div></div><div class="col-6@lg col-12 text-component"><div id="accordionGroup-right" class="accordion" data-allow-toggle>';
            $i = 0;
          endif;
            
          endwhile;
        endif;
        wp_reset_postdata();
        
        ?>
        
      </div>
    </div>
  </div>
</div>
</section>