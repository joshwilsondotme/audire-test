<?php 
  $standardBlock_settings = array();
    
  // Columns
  if ( have_rows( 'columns' ) ) :
    while ( have_rows( 'columns' ) ) : the_row();
      $columnData = array(
        'content'           => get_sub_field('content'),
        'column_width'      => get_sub_field('column_width')
      );
      
      // Column Content Align
      if ( have_rows( 'content_alignment' ) ) :
        while ( have_rows( 'content_alignment' ) ) : the_row();
          $columnData['align_horizontal'] = get_sub_field( 'horizontal' );
          $columnData['align_vertical']   = get_sub_field( 'vertical' );
        endwhile;
      endif;
      
      $standardBlock_settings['columns'][] = $columnData;
    endwhile;
  endif;
  
  // Grid Gap
  $standardBlock_settings['grid_gap'] = get_sub_field( 'grid_gap' );