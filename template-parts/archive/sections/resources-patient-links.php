<?php 
  $patient_links_bg = get_sub_field( 'color_options' );
?>
<section id="patient-links" class="resources__section resources__patient-links padding-y-xxl bg-<?= $patient_links_bg; ?>">
  <div class="container max-width-md text-component text-center">
    <?php the_sub_field( 'content' ); ?>
  </div>
  <div class="container max-width-md">
    <?php
        
      if ( have_rows('links') ) {
        echo '<ul class="flex-grid">';
        
        while ( have_rows('links') ) {
          the_row();
          $icon = get_sub_field('icon');
          $link = get_sub_field('link');
          
          echo '<li class="text-center"><a href="' . $link['url'] . '">
            <div class="img-outer-wrap">
              <div class="img-inner-wrap">
                <img src="' . get_template_directory_uri() . '/images/svgs/' . $icon . '.svg" alt="' . ucfirst($icon) . '" />
              </div>
            </div>
            <h4>' . $link['title'] . '</h4>
          </a></li>';
        }
        
        echo '</ul>';
      }
      
    ?>
  </div>
</section>