<?php 
  $block_settings = array();
    
  if ( have_rows( 'section_design_options' ) ) :
    while ( have_rows( 'section_design_options' ) ) : the_row();

      // Background Color Options
      if ( have_rows( 'background_color' ) ) :
        while ( have_rows( 'background_color' ) ) : the_row();
          $block_settings['bg_base_color']   = get_sub_field( 'color_options' );
          $block_settings['bg_custom_color'] = get_sub_field( 'custom_color' );
        endwhile;
      endif;

      // Background Image Option
      if ( have_rows( 'background_image' ) ) :
        while ( have_rows( 'background_image' ) ) : the_row();
          $block_settings['bg_image']       = get_sub_field( 'image' )['url'];
          $block_settings['bg_image_x_pos'] = get_sub_field( 'x_position' );
          $block_settings['bg_image_y_pos'] = get_sub_field( 'y_position' );
          $block_settings['overlay']        = get_sub_field( 'selector' );

          if ( have_rows( 'overlay' ) ) :
            while ( have_rows( 'overlay' ) ) : the_row();
              $block_settings['overlay_color']   = get_sub_field( 'color_options' );
              $block_settings['overlay_opacity'] = get_sub_field( 'opacity' );
            endwhile;
          endif;
        endwhile;
      endif;

      // Section Container Width
      $block_settings['container_width'] = get_sub_field( 'content_container_width' );

      // Section Padding Top/Bottom
      if ( have_rows( 'padding' ) ) :
        while ( have_rows( 'padding' ) ) : the_row();
          $block_settings['padding_top']    = get_sub_field( 'top' );
          $block_settings['padding_bottom'] = get_sub_field( 'bottom' );
        endwhile;
      endif;

      // Section Margins (Convert to Negative values)
      if ( have_rows( 'margin' ) ) :
        while ( have_rows( 'margin' ) ) : the_row();
          $block_settings['margin_top']    = get_sub_field( 'top' );
          $block_settings['margin_bottom'] = get_sub_field( 'bottom' );
        endwhile;
      endif;

      
    endwhile;
  endif;