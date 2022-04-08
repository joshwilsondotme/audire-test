<?php 
        
  $the_query = new WP_Query( array(
    'post_type' => 'services',
    'order' => 'ASC',
    'orderby' => 'menu_order title',
    'tax_query' => array(
      array (
          'taxonomy' => 'services_type',
          'field' => 'slug',
          'terms' => 'hearing-aid-service',
      )
    ),
  ) );
      
  $bg_color = get_sub_field( 'color_options' );
  $stepRows = ( !empty(get_sub_field('steps')) ) ? count(get_sub_field('steps')) : 0;
  
?>
<section id="hearing-aid-services" class="services__section services__hearing-aid-services toc-item padding-y-xxl bg-<?= $bg_color; ?>">
  <?php if( !empty(get_sub_field('journey_content')) ): ?>
  <div class="container max-width-md text-component text-center">
    <?php the_sub_field( 'journey_content' ); ?>
  </div>
  <?php endif; ?>
  <?php if( $stepRows > 0): ?>
  <div class="container max-width-lg">
    <?php
        /*
        if ( have_rows('links') ) {
        echo '<ul class="flex-grid">';
        
        while ( have_rows('links') ) {
          the_row();
          $icon = get_sub_field('icon');
          $link = get_sub_field('link');
        */
        
      if ( have_rows('steps') ) {
        echo '<ul class="flex-grid">';
        
        while ( have_rows('steps') ) {
          the_row();
          
          $link = get_sub_field('link') ? get_sub_field('link')['url'] : '#';
          
          echo '<li style="flex-basis: ' . ( ($stepRows == 4) ? '25%' : '33.3%' ) . '">
            <a href="' . $link . '" class="hover-card hvr-grow-shadow text-component margin-bottom-xs">' . get_sub_field('step') . '</a>
          </li>';
        }
        
        echo '</ul>';
      }
      
    ?>
  </div>
  <?php endif; ?>
  <?php $serviceContentPadding = ( !empty(get_sub_field('journey_content')) || $stepRows > 0 ) ? 'padding-y-xxl' : 'padding-bottom-xxl'; ?>
  <?= '<div class="container max-width-md text-component text-center ' . $serviceContentPadding . '">' ?>
    <?php the_sub_field( 'services_content' ); ?>
  </div>
  <div class="container max-width-lg">
  <div class="grid grid-gap-xxxl">
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
                        aria-controls="hearing-aid-services-sec<?= $count; ?>"
                        id="hearing-aid-services-accordion<?= $count; ?>id">
                  <span class="accordion__title">
                    <?php the_title(); ?>
                    <span class="accordion__icon"></span>
                  </span>
                </button>
              </h3>

              <div id="hearing-aid-services-sec<?= $count; ?>"
                  role="region"
                  aria-labelledby="hearing-aid-services-accordion<?= $count; ?>id"
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
            echo '</div></div><div class="col-6@lg col-12 text-component"><div id="accordionGroup-right" class="accordion" data-allow-toggle>';
            $i = 0;
          endif;
            
          endwhile;
          
          echo '</div></div>';
        endif;
        wp_reset_postdata();
        
        ?>
        
      </div>
    </div>
  </div>
  </div>
</section>