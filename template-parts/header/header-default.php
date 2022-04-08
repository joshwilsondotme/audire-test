
<?php 
  if ( have_rows( 'branding', 'themes-options' ) ) :
    while ( have_rows( 'branding', 'themes-options' ) ) : the_row();
      $logo = get_sub_field( 'logo' );
      $alt_logo = get_sub_field( 'alt_logo' );
    endwhile;
  endif;  
  if ( have_rows ( 'header_options', 'themes-options' ) ) : 
    while ( have_rows ( 'header_options', 'themes-options' ) ) : the_row();
      $header_message = get_sub_field( 'enable_site_message' );
      $logo_width = get_sub_field( 'logo_width' );

      if ( have_rows( 'site_message' ) ) :
        while ( have_rows( 'site_message' ) ) : the_row();
          $message_content = get_sub_field( 'message' );
          $message_link = get_sub_field( 'link' );
        endwhile;
      endif;

      if ( have_rows( 'main_navigation_design_options' ) ) :
        while ( have_rows( 'main_navigation_design_options' ) ) : the_row();
          $navigation_bg = get_sub_field( 'color_options' );
          $navigation_white_text = get_sub_field( 'white_text' );
        endwhile;
      endif;

      if ( have_rows( 'top_bar_design_options' ) ) :
        while ( have_rows( 'top_bar_design_options' ) ) : the_row();
          $topbar_bg = get_sub_field( 'color_options' );
          $util_text_color = get_sub_field( 'white_text' );
          $resizer = get_sub_field( 'enable_text_resizer' );
          $top_bar_left_content = get_sub_field( 'top_bar_left_content' );
        endwhile;
      endif;
    endwhile;
endif;
?>

<header class="site-header site-header--sticky site-header--at-top" role="banner">

  <div class="site-header__main bg-<?= $navigation_bg; ?>">
    <div class="container max-width-xl">

      <a class="site-header__logo" href="<?php bloginfo('url') ?>" style="width: <?= $logo_width; ?> ">
        <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>" />
      </a>

      <nav class="site-nav site-header__nav site-header__nav--main" role="navigation" aria-label="Main menu">

        <button class="nav-toggle nav-toggle--nav-is-closed" aria-expanded="false">
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </button>
        
        <?php 
          if ( $navigation_white_text == true) {
            bem_menu('main_nav', 'site-menu', 'site-menu--main text-white'); 
          } else {
            bem_menu('main_nav', 'site-menu', 'site-menu--main'); 
          } 
        ?>
        
      </nav>
      
    </div>
  </div>

  <div class="site-header__util bg-<?= $topbar_bg; ?> <?php echo ( $util_text_color == true ) ? 'text-white' : ''; ?>">
    <div class="container max-width-xl justify-between text-inherit">
      <div class="site-header__left">
          <?php if ($resizer == true) : ?>
            <ul class="resizer list-inline display@md">
              <li class="text-sm"><a href="#" id="smallFont" class="<?php echo ( $util_text_color == true ) ? 'text-white' : ''; ?>">A</a></li>
              <li><a href="#" id="resetFont">A</a></li>
              <li class="text-lg"><a href="#" id="largeFont">A</a></li>
            </ul>
          <?php endif; ?>
          <?php if ( isset( $top_bar_left_content ) ) : ?>
            <?php echo $top_bar_left_content; ?>
          <?php endif;?>
      </div>
      <div class="site-header__right flex items-center">
        <nav class="site-nav site-header__nav site-header__nav--util" role="navigation" aria-label="Utility menu">
          <?php bem_menu('main_util_nav', 'site-menu', 'site-menu--main-util'); ?>
        </nav>
          <ul class="site-header__social-list social-list flex items-center">
            <?php if ( $util_text_color == true) {
              get_template_part('template-parts/components/social-list--white');
            } else {
              get_template_part('template-parts/components/social-list');
            } ?>
          </ul>
      </div>
    </div>
  </div>

  <?php 
    if ($header_message === true ) {
      get_template_part( 'template-parts/header/head/header-message' );
    } 
  ?>
</header>