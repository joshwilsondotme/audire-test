<?php
// Block Variables
$text_color = get_sub_field( 'two_column_design_text_color' );

// Background Color Options
if ( have_rows( 'two_column_design_background_color' ) ) :
  while ( have_rows( 'two_column_design_background_color' ) ) : the_row();
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

// Container Styles
if ( have_rows( 'two_column_design_container_settings' ) ) :
  while ( have_rows( 'two_column_design_container_settings' ) ) : the_row();
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


// Image Settings
$image = get_sub_field( 'image' );
if ( have_rows( 'image_settings' ) ) :
  while ( have_rows( 'image_settings' ) ) : the_row();
    $position_setting = get_sub_field( 'photo_position' );
    $style = get_sub_field( 'photo_style' );
    $radius_setting = get_sub_field( 'border_radius' );
    $radius = 'radius-'.$radius_setting;
    $shadow_setting = get_sub_field( 'shadow' );
    $shadow = 'shadow-'.$shadow_setting;
    $outline_setting = get_sub_field( 'outline' );
    $style_settting = get_sub_field( 'style' );
    $color_setting = get_sub_field( 'color_option' );
  endwhile;
endif;

$image_classes = array($radius, $shadow);

foreach ($image_classes as $classes) { $image_styles = $classes.' '; } 
?>

<section data-id="<?= $block_count?>" class="<?= $bg_color; ?> <?= $padding_top; ?> <?= $padding_bottom; ?>">
  <div class="container max-width-<?= $container_width; ?> <?= 'color-'.$text_color; ?>">
    <div class="grid grid-x-gap-<?= $gap ?>">
      <div class="col-12 col-6@md <?php echo ($position_setting === 'left') ? 'order-2' : 
    'order-1' ;?>">
        <?php the_sub_field( 'content' ); ?>
      </div>
      <div class="col-12 col-6@md <?php echo ($position_setting === 'left') ? 'order-1' : 
    'order-2' ;?>">
        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" class="<?= $radius; ?> <?= $shadow; ?>"/>
      </div>
    </div>
    
    
  </div>
</section>
