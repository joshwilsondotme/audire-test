<?php 
  $tinnitus_bg = get_sub_field( 'color_options' );
?>
<section id="tinnitus" class="resources__section resources__tinnitus padding-y-xl bg-<?= $tinnitus_bg; ?>">

<div class="container max-width-lg">
  <div class="grid grid-gap-xl">
    <div class="col-5@lg col-12 text-component padding-bottom-md">
      <?php the_sub_field( 'content' ); ?>
    </div>
    <div class="col-7@lg col-12 flex items-end margin-bottom-0">
    <?php
      
      if ( $image = get_sub_field('image') ) {
        echo '<img loading="lazy" src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image['alt'] ) . '" class="lazyload" />';
      } else {
        echo '<img loading="lazy" src="' . get_template_directory_uri() . '/images/resources_tinnitus.jpg' . '" alt="Tinnitus" class="lazyload">';
      }
      
    ?>
    </div>
  </div>
</div>
</section>