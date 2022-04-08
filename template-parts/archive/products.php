<?php 
  $blockcount = 0;
  wp_enqueue_script("accordion-js", get_template_directory_uri()."/dist/assets/js/accordion.js", [], false, true );
  wp_enqueue_script("table-of-contents", get_template_directory_uri()."/dist/assets/js/table-of-contents.js", [], false, true );

  $post_type = get_post_type();
  if ( have_rows( 'title_design_options', 'product-options' ) ) :
    while ( have_rows( 'title_design_options', 'product-options' ) ) : the_row();
      $intro_bg_color = get_sub_field( 'color_options' );
      $toc_text_color = get_sub_field( 'text_color' );
    endwhile;
  endif; 

  if ( have_rows( 'quick_links', 'product-options' ) ) :
    while ( have_rows( 'quick_links', 'product-options' ) ) : the_row();
      $toc_bg = get_sub_field( 'color_options' );
      $toc_text_color = get_sub_field( 'text_color' );
    endwhile;
  endif;
?>
<div class="products">
  <?php
    if ( get_field( 'custom_title_banner_products', 'product-options' ) == 1 ) {
      get_template_part( 'template-parts/components/interior-banner--products' );
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
    
    if (have_rows( 'layout_options', 'product-options' )) {
      $blockcount = 0;
      
      while (have_rows( 'layout_options', 'product-options' )) {
        the_row();
        $blockcount++;
          
        switch (get_row_layout()) {
          case 'hearing_technology':
            get_template_part('template-parts/archive/sections/products-hearing-technology');
            break;
            
          case 'guide_to_hearing_aids':
            get_template_part('template-parts/archive/sections/products-guide-to-hearing-aids');
            break;
            
          case 'manufacturers':
            get_template_part('template-parts/archive/sections/products-brands');
            break;
            
          case 'hearing_protection':
            get_template_part('template-parts/archive/sections/products-protection');
            break;
            
          case 'assistive_listening_devices':
            get_template_part('template-parts/archive/sections/products-assistive-devices');
            break;
        }
      }
    }
    
  ?>
</div>