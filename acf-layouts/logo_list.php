<?php
  $row           = get_row(true);
  $locationBlock = new LogoListBlock($row, $block_count);
  $locationBlock->render();  
?>