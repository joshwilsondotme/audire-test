<?php 
  if ( have_rows( 'custom_interior_banner', 'service-options' ) ) :
    while ( have_rows( 'custom_interior_banner', 'service-options' ) ) : the_row();
      $bg_image = get_sub_field( 'image' );

      if ( have_rows( 'image_styles' ) ) :
        while ( have_rows( 'image_styles' ) ) : the_row();
          $image_blur = get_sub_field( 'image_blur' );
          $image_blur_range = get_sub_field( 'image_blur_range' );

          $image_grayscale = get_sub_field( 'image_grayscale' );
          $image_grayscale_range = get_sub_field( 'image_grayscale_range' );

          $image_opacity = get_sub_field( 'image_opacity' );
          $image_opacity_range = get_sub_field( 'image_opacity_range' );
        endwhile;
      endif;

      if ( have_rows( 'title_color_options' ) ) :
        while ( have_rows( 'title_color_options' ) ) : the_row();
          $background_color = get_sub_field( 'color_options' );
          $overlay_enable = get_sub_field( 'color_overlay_enable' );
          $title_color_options = get_sub_field( 'title_color_options' );
           
          if ( have_rows( 'color_overlay') ) : 
            while ( have_rows ( 'color_overlay' ) ) : the_row();
              $overlay_color =  get_sub_field( 'color_options' );
              $overlay_opacity = get_sub_field( 'opacity_%');
            endwhile;
          endif;
        endwhile;
      endif;

      if ( have_rows( 'text_options' ) ) :
        while ( have_rows( 'text_options' ) ) : the_row();
          $text_color = get_sub_field( 'text_color' );
          $text_bg = get_sub_field( 'color_options' );
          $text_bg_opacity = get_sub_field( 'background_opacity' ); 
        endwhile;
      endif;
      
    endwhile;
  endif;
?>

<header class="padding-y-xl interior-banner bg-<?= $background_color; ?> text-component" >
  <?php if( isset($bg_image) ) : ?>
    <div class="interior-banner__image" style="
      background-image: url(<?= $bg_image['url']; ?>); <?php if($image_grayscale == true || $image_blur == true) {
        echo 'filter: blur('.$image_blur_range.'px)  grayscale('.$image_grayscale_range.'%);';
      } ?> <?= ($image_opacity == true) ? 'opacity: '.$image_opacity_range.'%;' : '' ?>
    "></div>
  <?php endif; ?>

  <?php if ($overlay_enable == true) : ?>
    <div class="interior-banner__overlay" style="background-color: var(--color-<?= $overlay_color; ?>); opacity: <?= $overlay_opacity; ?>%;"></div>
  <?php endif; ?>

  <div class="container max-width-md <?php echo ($text_color == 'white') ? 'text-white' : ''; ?>">
  <?php 
      if (is_post_type_archive( 'services' )) {
        if (have_rows( 'service_introduction', 'service-options' )) {
          while (have_rows( 'service_introduction', 'service-options' )) {
            the_row();
            echo '<div class="text-center">';
            the_sub_field( 'introduction' );
            echo '</div>';
          }
        } 
      } else {
        the_title('<h1 class="single-post__title">', '</h1>');
      }
    ?>
  </div>
</header>