<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

  if ( have_rows( 'footer_options', 'themes-options' ) ) :
    while ( have_rows( 'footer_options', 'themes-options' ) ) : the_row();
      $footer_style = get_sub_field( 'footer_style' );
      $footer_cta = get_sub_field( 'footer_call_to_actions' );
    endwhile;
  endif;
  $disable_footer_ctas = get_field( 'disable_footer_ctas' );
  $custom_scripts_footer = get_field( 'custom_scripts_footer',  'themes-options' );
?>

    </main> <!-- site-content -->
    <?php if ( !is_front_page() && $disable_footer_ctas == false ) :
      if( !empty($footer_cta) && have_rows('layouts', $footer_cta) ) :

        $block_count = 0;

        while(have_rows('layouts' , $footer_cta)) : the_row();

          ACF_Layout::render(get_row_layout(), $block_count);
          $block_count++;

        endwhile;

      endif; 
    endif; ?>
    
    <div class="backtotop-btn">
      <div class="backtotop-inner">
        <i class="fa fa-angle-up"></i>
      </div>
    </div>
    
    <?php get_template_part('template-parts/footer/footer-'.$footer_style); ?>
    
  </div> <!-- site-wrapper -->

  <?php wp_footer(); ?>
  <?= $custom_scripts_footer; ?>
</body>
</html>
