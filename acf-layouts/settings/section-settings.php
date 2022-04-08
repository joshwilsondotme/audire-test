<?php 
  // Container Settings
  if ( have_rows( 'design_options' ) ) :
    while ( have_rows( 'design_options' ) ) : the_row();

      // Section Settings
      if ( have_rows( 'section_settings' ) ) :
        while ( have_rows( 'section_settings' ) ) : the_row();
          
          // Container Width and Grid Gap
          $container_width = get_sub_field( 'container_width' );
          $grid_gap = get_sub_field( 'grid_gap' );

          // Container Padding Top and Bottom
          if ( have_rows( 'padding_y_axis' ) ) :
            while ( have_rows( 'padding_y_axis' ) ) : the_row();
              $section_padding_top = get_sub_field( 'top' );
              $section_padding_bottom = get_sub_field( 'bottom' );

              $cls_section_padding_top = 'padding-top-'.$section_padding_top;
              $cls_section_padding_bottom = 'padding-bottom-'.$section_padding_bottom;
              
            endwhile;
          endif;

          // Container Classes Array
          $container_classes = array(
            $cls_section_padding_top, 
            $cls_section_padding_bottom
          );

          // Container Position
          if ( have_rows( 'position' ) ) :
            while ( have_rows( 'position' ) ) : the_row();
              $section_position_y = get_sub_field( 'y_axis' );
              $section_position_x = get_sub_field( 'x_axis' );
            endwhile;
          endif;          
        endwhile;
      endif; 
      // End Section Settings

      // Background Settings
      if ( have_rows( 'background_settings' ) ) :
        while ( have_rows( 'background_settings' ) ) : the_row();
          // the_sub_field( 'background_color_style' );

          if ( have_rows( 'solid' ) ) :
            while ( have_rows( 'solid' ) ) : the_row();
              
              $bg_colors = get_sub_field( 'colors' );
              $bg_colors_range = get_sub_field( 'range' );

              // Background Class Setup
              if ( $bg_colors_range != 'Default' ) :
                $bg_color = 'bg-color-'.$bg_colors.'-'.$bg_colors_range;
              else :
                $bg_color = 'bg-color-'.$bg_colors;
              endif;
              
            endwhile;
          endif;

          
        endwhile;
      endif;
      // End Background Settings
      $bg_classes = array(
        $bg_color
      );

      // Column Settings
      if ( have_rows( 'column_settings' ) ) :
        while ( have_rows( 'column_settings' ) ) : the_row();

          // Column Background Color
          if ( have_rows( 'background_color' ) ) :
            while ( have_rows( 'background_color' ) ) : the_row();
              $col_bg = get_sub_field( 'colors' );
              $col_bg_color = get_sub_field( 'background_color' );
                
            endwhile;
          endif;
          // Column Padding
          if ( have_rows( 'padding' ) ) :
            while ( have_rows( 'padding' ) ) : the_row();
              $col_pad_y = get_sub_field( 'y_axis' );
              $col_pad_x = get_sub_field( 'x_axis' );

              $cls_pad_y = 'padding-y-'.$col_pad_y;
              $cls_pad_x = 'padding-x-'.$col_pad_x;

              $col_pad_classes = array(
                $cls_pad_y,
                $cls_pad_x
              );
            endwhile;
          endif;

        endwhile;
      endif;
      // End Column Settings
    endwhile; 
  endif;
  
?>