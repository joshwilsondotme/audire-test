<?php 
  $hearing_loss_bg = get_sub_field( 'color_options' );
?>
<section id="hearing-loss" class="resources__section resources__hearing-loss bg-<?= $hearing_loss_bg; ?> padding-y-xxl">

<div class="container max-width-lg">
  <div class="grid grid-gap-xxxl">
    <div class="col-12 text-component text-center">
      <?php the_sub_field( 'content' ); ?>
    </div>
    <div class="col-5@lg col-12">
    <?php
        
      if ( have_rows('images') ) {
        while ( have_rows('images') ) {
          the_row();
          
          $image = get_sub_field('image');
          echo '<img loading="lazy" src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image['alt'] ) . '" class="lazyload radius-md shadow-md margin-y-lg" />';
        }
      } else {
        echo '<img loading="lazy" src="' . get_template_directory_uri() . '/images/resources_hearing-loss.jpg' . '" alt="Hearing Aids" class="lazyload radius-md shadow-md margin-y-lg">';
        echo '<img loading="lazy" src="' . get_template_directory_uri() . '/images/resources_hearing-loss-2.jpg' . '" alt="Hearing Aids" class="lazyload radius-md shadow-md margin-y-lg">';
      }
      
    ?>
    </div>
    <div class="col-7@lg col-12 text-component">
      <?php 
        $hearing_loss_query = new WP_Query( array(
          'post_type' => 'resources',
          'order' => 'ASC',
          'orderby' => 'menu_order title',
          'tax_query' => array(
              array (
                  'taxonomy' => 'resources_type',
                  'field' => 'slug',
                  'terms' => 'hearing-loss',
              )
          ),
        ) );
        
        $count = 0;
        if ( $hearing_loss_query->have_posts() ) :  ?>

          <div id="accordionGroup" class="accordion" data-allow-toggle>

          <?php while ( $hearing_loss_query->have_posts() ) : $hearing_loss_query->the_post(); 
          $count++; 
          ?>

            <div class="accordion__item">
              <h3>
                <button aria-expanded="<?= ($count == 1) ? "true" : "false" ?>"
                        class="accordion__trigger"
                        aria-controls="hearing-loss-sec<?= $count; ?>"
                        id="hearing-loss-accordion<?= $count; ?>id">
                  <span class="accordion__title">
                    <?php the_title(); ?>
                    <span class="accordion__icon"></span>
                  </span>
                </button>
              </h3>

              <div id="hearing-loss-sec<?= $count; ?>"
                  role="region"
                  aria-labelledby="hearing-loss-accordion<?= $count; ?>id"
                  class="accordion__panel"
                  <?= ($count == 1) ? "" : "hidden" ?>>
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
    </div>
  </div>
</div>
</section>