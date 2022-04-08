<?php
  $row           = get_row(true);
  $locationBlock = new CtasBlock($row, $block_count);
  $locationBlock->render();  
?>