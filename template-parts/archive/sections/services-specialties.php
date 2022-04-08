<?php 
  $bg_color = get_sub_field( 'color_options' );
  $valign   = get_sub_field( 'vertical_align' );
?>

<section id="specialties" class="services__section services__specialties toc-item padding-y-xxl bg-<?= $bg_color; ?>">

<div class="container max-width-lg">
  <div class="grid grid-gap-xl <?= "items-" . $valign ?>">
    <div class="col-7@lg col-12">
    <?php
      
      if ( $image = get_sub_field('image') ) {
        echo '<img loading="lazy" src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image['alt'] ) . '" class="lazyload" />';
      } else {
        echo '<img loading="lazy" src="' . get_template_directory_uri() . '/images/services_specialties.jpg' . '" alt="Woman with Headphones" class="lazyload">';
      }
      
    ?>
    </div>
    <div class="col-5@lg col-12 text-component">
      <?php the_sub_field( 'content' ); ?>
    </div>
  </div>
</div>
</section>