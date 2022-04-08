<?php 
  $blockcount = 0;
  wp_enqueue_script("accordion-js", get_template_directory_uri()."/dist/assets/js/accordion.js", [], false, true );
  wp_enqueue_script("table-of-contents", get_template_directory_uri()."/dist/assets/js/table-of-contents.js", [], false, true );

  $post_type = get_post_type();
  if ( have_rows( 'title_design_options', 'resource-options' ) ) :
    while ( have_rows( 'title_design_options', 'resource-options' ) ) : the_row();
      $title_bg         = get_sub_field( 'color_options' );
      $title_text_color = get_sub_field( 'text_color' );
    endwhile;
  endif;

  if ( have_rows( 'quick_links', 'resource-options' ) ) :
    while ( have_rows( 'quick_links', 'resource-options' ) ) : the_row();
      $toc_bg = get_sub_field( 'color_options' );
      $toc_text_color = get_sub_field( 'text_color' );
    endwhile;
  endif;

?>

<div class="resources">
  <?php
    if ( get_field( 'custom_title_banner_resources', 'resource-options' ) == 1 ) {
      get_template_part( 'template-parts/components/interior-banner--resources' );
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
    
    if (have_rows( 'layout_options', 'resource-options' )) {
      $blockcount = 0;
      
      while (have_rows( 'layout_options', 'resource-options' )) {
        the_row();
        $blockcount++;
          
        switch (get_row_layout()) {
          case 'patient_links':
            get_template_part('template-parts/archive/sections/resources-patient-links');
            break;
            
          case 'hearing_survey':
            get_template_part('template-parts/archive/sections/resources-hearing-survey');
            break;
            
          case 'hearing_loss':
            get_template_part('template-parts/archive/sections/resources-hearing-loss');
            break;
            
          case 'tinnitus':
            get_template_part('template-parts/archive/sections/resources-tinnitus');
            break;
            
          case 'financing':
            get_template_part('template-parts/archive/sections/resources-financing');
            break;
        }
      }
    }
    
  ?>

</div>