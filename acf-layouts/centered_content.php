<?php 

  // Block Variables
  $text_color = get_sub_field( 'text_color' );

  // Background Color Options
  if ( have_rows( 'background_color' ) ) :
    while ( have_rows( 'background_color' ) ) : the_row();
      $colors = get_sub_field( 'colors' );
      $primary_bg = get_sub_field( 'primary' );
      $secondary_bg = get_sub_field( 'secondary' );
      $tertiary_bg = get_sub_field( 'tertiary' );
      $quaternary_bg = get_sub_field( 'quaternary' );
      $default_bg = get_sub_field( 'default' );
    endwhile;
  endif;

  // Logic for background color class
  switch ( $colors) {
    case "primary" :
      $bg_color = 'bg-color-primary-'.$primary_bg;
      break;
    case "secondary" :
      $bg_color = 'bg-color-secondary-'.$secondary_bg;
      break;
    case "tertiary" :
      $bg_color = 'bg-color-tertiary-'.$tertiary_bg;
      break;
    case "quaternary" :
      $bg_color = 'bg-color-quaternary-'.$quaternary_bg;
      break;
    case "default" :
      $bg_color = 'bg-color-default-'.$default_bg;
      break;
    default :
      $bg_color = 'bg-none';
  }

  // Background Image
  if ( have_rows( 'background_image' ) ) :
    while ( have_rows( 'background_image' ) ) : the_row();
      $bg_image = get_sub_field( 'image' );
      $opacity = get_sub_field( 'opacity' );
      $blend_mode = get_sub_field( 'blend_mode' );
    endwhile; 
  endif;

  // Container Styles
  if ( have_rows( 'container_settings' ) ) :
    while ( have_rows( 'container_settings' ) ) : the_row();
      $container_width = get_sub_field( 'container_width' );
      $gap = get_sub_field( 'grid_gap' );
      if ( have_rows( 'padding_y-axis' ) ) :
        while ( have_rows( 'padding_y-axis' ) ) : the_row();
          $padding_top_value = get_sub_field( 'top' );
          $padding_bottom_value = get_sub_field( 'bottom' );
          $padding_top = 'padding-top-'.$padding_top_value;
          $padding_bottom = 'padding-bottom-'.$padding_bottom_value;
        endwhile;
      endif;
    endwhile;
  endif;

  
?>
<?= $bg_color?>
<?php if($bg_image) :?>
  <section data-id="<?= $block_count; ?>" style="background: url('<?= $bg_image['url']; ?>'); background-size: cover; background-position: center center;" class="<?= $padding_top; ?> <?= $padding_bottom; ?>" >
  <?php else: ?>
    <section data-id="<?= $block_count?>" class="<?= $bg_color; ?> <?= $padding_top; ?> <?= $padding_bottom; ?>">
<?php endif; ?>

  <div class="container max-width-<?= $container_width; ?> <?= 'color-'.$text_color; ?>">
    <div class="grid grid-gap-<?= $gap; ?>">
      <div class="col-12">
      <?php the_sub_field( 'content' ); ?>
      </div>
    </div>
  </div>
</section>