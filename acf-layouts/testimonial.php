<?php
  

  // include( TEMPLATEPATH . '/acf-layouts/settings/settings-section.php' ) ;
  // include( TEMPLATEPATH . '/acf-layouts/settings/settings-column.php' ) ;
  
  $row           = get_row(true);
  $testimonialBlock = new TestimonialBlock($row, $block_count);
  $testimonialBlock->render();  
  
?>
