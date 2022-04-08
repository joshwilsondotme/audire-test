<?php
/**
 * Display footer content
 */


$footer_name = wp_get_nav_menu_name( 'footer_nav' );

if ( have_rows( 'branding', 'themes-options' ) ) : 
	while ( have_rows ( 'branding', 'themes-options' ) ) : the_row();
		$logo = get_sub_field( 'logo' );
		$alt_logo = get_sub_field( 'alt_logo' );
	endwhile;
endif;

if ( have_rows( 'footer_options', 'themes-options' ) ) :
	while ( have_rows( 'footer_options', 'themes-options' ) ) : the_row();
        $logo_width = get_sub_field( 'logo_width' );
		$use_alt_logo = get_sub_field( 'use_alt_logo' );
		$below_logo = get_sub_field( 'below_logo' );
		$right_side = get_sub_field( 'right_side' );
		$footer_bg =  get_sub_field( 'color_options' );
		$footer_text_color = get_sub_field( 'text_color' );
		

    if ( have_rows( 'stacked_options' ) ) :
      while ( have_rows( 'stacked_options' ) ) : the_row();
        
        if ( have_rows( 'navigation' ) ) :
          while ( have_rows( 'navigation' ) ) : the_row();
            $navigation_bg = get_sub_field( 'color_options' );
            $navigation_text = get_sub_field( 'white_text' );
          endwhile;
        endif;

        if ( have_rows( 'below_navigation' ) ) :
          while ( have_rows( 'below_navigation' ) ) : the_row();
            $section_bg = get_sub_field( 'color_options' );
          endwhile;
        endif;

        if ( have_rows( 'meta_section' ) ) :
          while ( have_rows( 'meta_section' ) ) : the_row();
            $meta_bg = get_sub_field( 'color_options' );
            $meta_text = get_sub_field( 'white_text' );
          endwhile;
        endif;
      endwhile;
    endif;
	endwhile;
endif;

	// var_dump($alt_logo);
?>
<footer class="site-footer site-footer--stacked"  role="contentinfo">
	
    <div class="site-footer__navigation padding-y-md bg-<?= $navigation_bg; ?> <?= ($navigation_text == true) ? 'text-white' : '' ?>">
      <div class="container max-width-lg justify-center">
        <?php bem_menu('footer_nav', 'footer-menu', 'list-inline justify-center' ); ?>
      </div>
    </div>
    <div class="site-footer__bottom bg-<?= $section_bg; ?>">
      <div class="container max-width-lg ">
        <div class="grid grid-gap-lg justify-center">

          <div class="col-8@md col-12 text-center">
            <?php if ($use_alt_logo == true) : ?>
              <img class="site-footer__logo site-footer__logo--white" src="<?php echo esc_url($alt_logo['url']) ;?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>" style="width: <?= $logo_width; ?>;" />
              
            <?php else: ?>
              <img class="site-footer__logo" src="<?php echo esc_url($logo['url']) ;?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>" style="width: <?= $logo_width; ?>;" />
            <?php endif; ?>

            <?= $below_logo; ?>
          </div>

        </div>

      </div> <!-- container -->
    </div>
	
	
	<div class="site-footer__meta text-center padding-y-sm bg-<?= $meta_bg; ?> <?= ($meta_text == true) ? 'text-white' : '' ?>">
		<p class="text-sm">Site Designed by <a href="https://audiologydesign.com" class="site-footer__meta-link" target="_blank" rel="noopener noreferrer">Audiology Design</a> | <?php echo date('Y'); ?> All Rights Reserved</p>
	</div>
</footer>
