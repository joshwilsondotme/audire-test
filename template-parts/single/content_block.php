<?php
if(have_rows('layouts')) :

  $block_count = 0;

  while(have_rows('layouts')) : the_row();
  
    ACF_Layout::render(get_row_layout(), $block_count);
    $block_count++;

  endwhile;

endif;
?>