<?php
  $row           = get_row(true);
  $locationBlock = new LocationBlock($row, $block_count);
  $locationBlock->render();  
  
?>
