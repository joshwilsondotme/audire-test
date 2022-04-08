<?php
  if ( have_rows ( 'header_options', 'themes-options' ) ) : 
    while ( have_rows ( 'header_options', 'themes-options' ) ) : the_row();
      $header_message = get_sub_field( 'enable_site_message' );

      if ( have_rows( 'site_message' ) ) :
        while ( have_rows( 'site_message' ) ) : the_row();
          $message_content = get_sub_field( 'message' );
          $message_link = get_sub_field( 'link' );
          $bg_color = get_sub_field( 'color_options' );
        endwhile;
      endif;

    endwhile;
endif;
?>
<div class="site-header__notification bg-<?= $bg_color; ?>">
  <div class="container max-width-lg">
    <?= $message_content; ?> 
  </div>
</div>