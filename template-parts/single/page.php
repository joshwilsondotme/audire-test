<?php
/**
 * Single Product
 *
 * @package \Template_Parts\Product
 */

/*
if ( have_rows( 'interior_page_title_options', 'themes-options' ) ) :
	while ( have_rows( 'interior_page_title_options', 'themes-options' ) ) : the_row();
		$title_bg = get_sub_field( 'color_options' );
		$title_txt = get_sub_field( 'text_color' );
	endwhile;
endif;
*/

$custom_title_banner = get_field( 'custom_title_banner' );

/**
 * TODO:
 * Background Image
 * Color Overlay
 * Gradient Overlay
 * Image Blur
 * Image Style Options (Grayscale, Opacity)
 */

?>
<div class="interior-page">
  <?php if ( $custom_title_banner == 'on' ) : ?>
    <?php get_template_part( 'template-parts/components/interior-banner' ); ?>
  <?php else : ?>
    <?php get_template_part( 'template-parts/components/interior-banner--global' ); ?>
  <?php endif; ?>
  
  <section class="padding-top-xl padding-bottom-xxxl">
    <div class="container max-width-md">
      <main class="single-post__content text-component">
        <?php the_content(); ?>
      </main>
    </div>
  </section>
</div>
