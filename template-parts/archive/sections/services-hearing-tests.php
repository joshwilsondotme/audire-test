<?php
    
$the_query = new WP_Query( array(
  'post_type' => 'services',
  'order' => 'ASC',
  'orderby' => 'menu_order title',
  'tax_query' => array(
      array (
          'taxonomy' => 'services_type',
          'field' => 'slug',
          'terms' => 'hearing-test',
      )
  ),
) );

$bg_color = get_sub_field( 'color_options' );
$valign   = get_sub_field( 'vertical_align' );
$columns  = get_sub_field( 'accordion_style' );

?>

<section id="hearing-tests" class="services__section toc-item bg-<?= $bg_color; ?> padding-y-xxl">

<div class="container max-width-lg">
  <div class="grid grid-gap-xxxl <?= "items-" . $valign ?>">
    <div class="col-6@lg col-12 text-component">
      <?php the_sub_field( 'content' ); ?>
      
      <?php
      if ( $columns == "one"):
        $count = 0;
        $i = 0;
        
        if ( $the_query->have_posts() ) :  ?>

          <div id="accordionGroup-left" class="accordion" data-allow-toggle data-allow-multiple>

          <?php
            while ( $the_query->have_posts() ) : $the_query->the_post(); 
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
    <div class="col-6@lg col-12">
    <?php
        
      if ( have_rows('images') ) {
        while ( have_rows('images') ) {
          the_row();
          
          $image = get_sub_field('image');
          echo '<img loading="lazy" src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image['alt'] ) . '" class="lazyload radius-md shadow-md margin-y-lg" />';
        }
      } else {
        echo '<img loading="lazy" src="' . get_template_directory_uri() . '/images/services_hand-to-ear.jpg' . '" alt="Hand to Ear" class="lazyload radius-md shadow-md margin-y-lg">';
      }
      
    ?>
    </div>
    <?php if ( $columns == "two"): ?>
    <div class="col-6@lg col-12 text-component">
      <?php
        
        $count = 0;
        $i = 0;
        
        if ( $the_query->have_posts() ) :  ?>

          <div id="accordionGroup-left" class="accordion" data-allow-toggle data-allow-multiple>

          <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
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
            
          if ( $i == ceil($the_query->post_count / 2) ):
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
</div>
</section>