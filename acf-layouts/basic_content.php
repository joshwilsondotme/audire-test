<?php if ( get_row_layout() == 'basic_content' ) : ?>

<?php include('settings/section-settings.php'); ?>

<section 
  data-id="<?= $block_count; ?>" 
  class="<?= implode( " ", $container_classes ); ?> <?= implode( " ", $bg_classes ); ?>">

  <div class="container max-width-<?= $container_width ; ?>">
    <div class="grid grid-gap-x-<?= $grid_gap; ?>">
      <div 
        class="container__inner text-component <?= ($col_bg === 'white') ? 'bg-color-white' : '' ?> <?= implode( " ", $col_pad_classes ); ?>" <?= ($col_bg != 'white') ? 'style="background-color:'.$col_bg_color.'"' : ""; ?> >
        <?php the_sub_field( 'content' ); ?>
      </div>
      
    </div>
  </div>

</section>


			
<?php endif; ?>