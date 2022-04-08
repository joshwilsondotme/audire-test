<?php 
  $image = '';
  if ( have_rows( 'hearing_technology_background' ) ) :
    while ( have_rows( 'hearing_technology_background' ) ) : the_row();
      $hearing_tech_bg = get_sub_field( 'color_options' );
    endwhile;
  endif; 

  $hearing_tech_query = new WP_Query( array(
    'post_type' => 'products',
    'tax_query' => array(
        array (
            'taxonomy' => 'product_type',
            'field' => 'slug',
            'terms' => 'hearing-technology',
        )
    ),
  ) );
  
  $columns  = get_sub_field( 'accordion_style' );
?>
<section id="hearing-technology" class="products__section products__section--<? $blockcount; ?> bg-<?= $hearing_tech_bg; ?> padding-y-xxl">

  <div class="container max-width-lg">
    <div class="grid grid-gap-xxxl">
      <div class="col-6@md col-12 text-component">
        <?php the_sub_field( 'content' ); ?>
        
        <?php
          if ( $columns == "one"):
            $count = 0;
            $i = 0;
            
            if ( $hearing_tech_query->have_posts() ) :  ?>
    
              <div id="accordionGroup-left" class="accordion" data-allow-toggle data-allow-multiple>
    
              <?php
                while ( $hearing_tech_query->have_posts() ) : $hearing_tech_query->the_post(); 
                $count++; $i++;
              ?>
    
                <div class="accordion__item">
                  <h3>
                    <button aria-expanded="<?= ($i == 1) ? "true" : "false" ?>"
                            class="accordion__trigger"
                            aria-controls="hearing-tests-sec<?= $count; ?>"
                            id="hearing-tests-accordion<?= $count; ?>id">
                      <span class="accordion__title">
                        <?php the_title(); ?>
                        <span class="accordion__icon"></span>
                      </span>
                    </button>
                  </h3>
    
                  <div id="hearing-tests-sec<?= $count; ?>"
                      role="region"
                      aria-labelledby="hearing-tests-accordion<?= $count; ?>id"
                      class="accordion__panel"
                      <?= ($i == 1) ? "" : "hidden" ?>>
                    <div class="accordion__panel-inner">
                      <?php the_excerpt(  ); ?>
                      <a href="<?php the_permalink(); ?>" class="btn--link btn--icon-arrow">More on <?php the_title(); ?></a>
                    </div>
                  </div>
                </div>
                
              <?php
                endwhile;
              endif;
              wp_reset_postdata();
              ?>
            </div>
          <?php endif; ?>
      </div>
      <div class="col-6@lg col-12 text-component">
      <?php if ( $image ) : ?>
        <img loading="lazy" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
      <?php else: ?>
        <img loading="lazy" src="<?php echo get_template_directory_uri() . '/images/image_hearing-technology@2x.jpg' ;?>" alt="Hearing Aids" class="lazyload radius-md shadow-sm">
      <?php endif; ?>
      </div>
      <?php if ( $columns == "two"): ?>
      <div class="col-6@lg col-12 text-component">
      <?php
        
        $count = 0;
        $i = 0;
        
        if ( $hearing_tech_query->have_posts() ) :  ?>

          <div id="accordionGroup-left" class="accordion" data-allow-toggle data-allow-multiple>

          <?php while ( $hearing_tech_query->have_posts() ) : $hearing_tech_query->the_post(); 
          $count++; $i++;
          ?>

            <div class="accordion__item">
              <h3>
                <button aria-expanded="<?= ($i == 1) ? "true" : "false" ?>"
                        class="accordion__trigger"
                        aria-controls="hearing-tests-sec<?= $count; ?>"
                        id="hearing-tests-accordion<?= $count; ?>id">
                  <span class="accordion__title">
                    <?php the_title(); ?>
                    <span class="accordion__icon"></span>
                  </span>
                </button>
              </h3>

              <div id="hearing-tests-sec<?= $count; ?>"
                  role="region"
                  aria-labelledby="hearing-tests-accordion<?= $count; ?>id"
                  class="accordion__panel"
                  <?= ($i == 1) ? "" : "hidden" ?>>
                <div class="accordion__panel-inner">
                  <?php the_excerpt(  ); ?>
                  <a href="<?php the_permalink(); ?>" class="btn--link btn--icon-arrow">More on <?php the_title(); ?></a>
                </div>
              </div>
            </div>
            
        <?php
            
          if ( $i == ceil($hearing_tech_query->post_count / 2) ):
            echo '</div></div><div class="col-6@lg col-12 text-component"><div id="accordionGroup-right" class="accordion" data-allow-toggle data-allow-multiple>';
            $i = 0;
          endif;
            
          endwhile;
          
          echo '</div></div>';
        endif;
        wp_reset_postdata();
        
        ?>
        
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
