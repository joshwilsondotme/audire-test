<?php 
  $blockcount = 0;
  wp_enqueue_script("accordion-js", get_template_directory_uri()."/dist/assets/js/accordion.js", [], false, true );
  wp_enqueue_script("table-of-contents", get_template_directory_uri()."/dist/assets/js/table-of-contents.js", [], false, true );

  $post_type = get_post_type();
  if ( have_rows( 'title_design_options', 'service-options' ) ) :
    while ( have_rows( 'title_design_options', 'service-options' ) ) : the_row();
      $title_bg         = get_sub_field( 'color_options' );
      $title_text_color = get_sub_field( 'text_color' );
    endwhile;
  endif;

  if ( have_rows( 'quick_links', 'service-options' ) ) :
    while ( have_rows( 'quick_links', 'service-options' ) ) : the_row();
      $toc_bg = get_sub_field( 'color_options' );
      $toc_text_color = get_sub_field( 'text_color' );
    endwhile;
  endif;

?>

<div class="services">
  <?php 
    if ( get_field( 'custom_title_banner_services', 'service-options' ) == 1 ) {
      get_template_part( 'template-parts/components/interior-banner--services' );
    } else {
      get_template_part( 'template-parts/components/interior-banner--global' );
    }
  ?>
  
  <section class="padding-y-lg bg-<?= $toc_bg; ?>">
    <div class="container max-width-lg text-center">
        <div class="table-contents <?= ($toc_text_color == 'white') ? 'text-white' : ''; ?>">
          <span class="padding-right-lg"><strong>On This Page:</strong></span>
          <ul id="toc" class="table-contents__list list-reset flex flex-center"></ul>
        </div>
    </div>
  </section>

  <?php
    
    if (have_rows( 'layout_options', 'service-options' )) {
      $blockcount = 0;
      
      while (have_rows( 'layout_options', 'service-options' )) {
        the_row();
        $blockcount++;
          
        switch (get_row_layout()) {
            
          case 'hearing_tests':
            get_template_part('template-parts/archive/sections/services-hearing-tests');
            break;
            
          case 'hearing_survey':
            get_template_part('template-parts/archive/sections/services-hearing-survey');
            break;
            
          case 'hearing_aid_services':
            get_template_part('template-parts/archive/sections/services-hearing-aid-services');
            break;
            
          case 'schedule':
            get_template_part('template-parts/archive/sections/services-schedule');
            break;
            
          case 'general_services':
            get_template_part('template-parts/archive/sections/services-general-services');
            break;
            
          case 'specialties':
            get_template_part('template-parts/archive/sections/services-specialties');
            break;
        }
      }
    }
    
  ?>

</div>