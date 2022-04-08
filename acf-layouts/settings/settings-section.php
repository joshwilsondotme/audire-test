<?php 
  if ( have_rows( 'section_design_options' ) ) :
    while ( have_rows( 'section_design_options' ) ) : the_row();

      // Background Color Options
      if ( have_rows( 'background_color' ) ) :
        while ( have_rows( 'background_color' ) ) : the_row();
          $section_bg = get_sub_field( 'color_options' );
          $section_custom_bg = get_sub_field( 'custom_color' );
        endwhile;
      endif;

      // Background Image Option
      if ( have_rows( 'background_image' ) ) :
        while ( have_rows( 'background_image' ) ) : the_row();
          $section_bg_image = get_sub_field( 'image' );
          $bg_image = $section_bg_image['url'];
          $section_bg_x_pos = get_sub_field( 'x_position' );
          $section_bg_y_pos = get_sub_field( 'y_position' );
          $section_bg_overlay = get_sub_field( 'selector' );

          if ( have_rows( 'overlay' ) ) :
            while ( have_rows( 'overlay' ) ) : the_row();
              $overlay_color = get_sub_field( 'color_options' );
              $overlay_opacity = get_sub_field( 'opacity' );
            endwhile;
          endif;
        endwhile;
      endif;

      // Section Container Width
      $section_container = get_sub_field( 'content_container_width' );

      // Section Padding Top/Bottom
      if ( have_rows( 'padding' ) ) :
        while ( have_rows( 'padding' ) ) : the_row();
          $section_pad_top = get_sub_field( 'top' );
          $section_pad_bottom = get_sub_field( 'bottom' );
        endwhile;
      endif;

      // Section Margins (Convert to Negative values)
      if ( have_rows( 'margin' ) ) :
        while ( have_rows( 'margin' ) ) : the_row();
          $section_margin_top = get_sub_field( 'top' );
          $section_margin_bottom = get_sub_field( 'bottom' );
        endwhile;
      endif;

      
    endwhile;
  endif;