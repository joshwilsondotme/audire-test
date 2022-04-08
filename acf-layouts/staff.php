<?php
  $row           = get_row(true);
  $locationBlock = new StaffBlock($row, $block_count);
  $locationBlock->render();  
?>