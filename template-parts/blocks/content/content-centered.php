<?php
/**
 * Block template file: template-parts/blocks/content/content-centered.php
 *
 * Centered Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'centered-content-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-centered-content';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}

if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$btn_style = get_sub_field( 'button_style' );

if ( have_rows( 'container_padding' ) ) :
  while ( have_rows( 'container_padding' ) ) : the_row(); 
    $padding_top = get_sub_field( 'padding_top' ); 
    $padding_bottom = get_sub_field( 'padding_bottom' ); 
  endwhile; 
endif; 

if ( have_rows( 'background' ) ) :
  while ( have_rows( 'background' ) ) : the_row();
    if ( get_sub_field( 'background_image_check' ) == 1 ) :
      // echo 'true';
    else :
      // echo 'false';
    endif;
    $background_image = get_sub_field( 'background_image' );
    if ( $background_image ) :
      $background_img = esc_url( $background_image['url'] );
    endif;
    if ( have_rows( 'overlay' ) ) :
      while ( have_rows( 'overlay' ) ) : the_row();
        $overlay_color = get_sub_field( 'color' );
        $overlay_opacity = get_sub_field( 'opacity' );
      endwhile;
    endif;
    $background_color = get_sub_field( 'background_color' );
  endwhile;
endif;

?>


<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> padding-top-<?php echo $padding_top; ?> padding-bottom-<?php echo $padding_bottom; ?> bg-color-<?php echo $background_color; ?>">
  <div class="container max-width-<?php the_field( 'container_width' ); ?>">
   <h2><?php the_field( 'title' ); ?></h2>
    <?php the_field( 'content' ); ?>
    <?php if ( have_rows( 'buttons' ) ) : ?>
      <?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
        <?php $button = get_sub_field( 'button' ); ?>
        <?php if ( $button ) : ?>
          <a href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>" class="btn btn--<?php the_sub_field( 'button_color' ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
        <?php endif; ?>
      <?php endwhile; ?>
    <?php else : ?>
  </div>
	<?php endif; ?>
</div>
    </div>