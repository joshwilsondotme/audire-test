<?php
  if ( have_rows( 'content_container_design_options' ) ) :
    while ( have_rows( 'content_container_design_options' ) ) : the_row();
      $column_styles = get_sub_field( 'enable' );
      $columns_size = get_sub_field( 'column_sizing' );
      if ( have_rows( 'design_options' ) ) :
        while ( have_rows( 'design_options' ) ) : the_row();
          $column_bg = get_sub_field( 'color_options' );
          $column_padding = get_sub_field( 'padding' );
          $column_shadow = get_sub_field( 'box_shadow' );
        endwhile;
      endif;
    endwhile;
  endif;