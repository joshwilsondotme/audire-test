<?php 
  $row           = get_row(true);
  $standardBlock = new StandardBlock($row, $block_count);
  $standardBlock->render();
?>