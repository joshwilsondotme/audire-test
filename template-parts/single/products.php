<?php
/**
 * Single Product
 *
 * @package \Template_Parts\Product
 */

if ( have_rows( 'title_design_options', 'product-options' ) ) :
  while ( have_rows( 'title_design_options', 'product-options' ) ) : the_row();
    $title_bg = get_sub_field( 'color_options' );
    $title_text_color = get_sub_field( 'text_color' );
  endwhile;
endif; 

$custom_title_banner = get_field( 'custom_title_banner' );

?>
<div class="interior-page">
  <?php 
    if ( $custom_title_banner == 'on' ) {
      get_template_part( 'template-parts/components/interior-banner' );
    } else {
      if ( get_field( 'custom_title_banner_products', 'product-options' ) == 1 ) {
        get_template_part( 'template-parts/components/interior-banner--products' );
      } else {
        get_template_part( 'template-parts/components/interior-banner--global' );
      }
    }
  ?>
  <section class="padding-top-xl padding-bottom-xxxl">
    <div class="container max-width-md">
      <main class="single-post__content text-component">
        <?php the_content(); ?>
      </main>
    </div>
  </section>
</div>
