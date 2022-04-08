<?php
include( TEMPLATEPATH . '/template-parts/components/manufacturer-logos.php' ) ;
        
$logoListSettings = $this->row;

$title = $logoListSettings['list_title'];
$size = $logoListSettings['image_size'];
$addBg = $logoListSettings['add_white_bg'];
$imgDesc = $logoListSettings['add_image_description'];
// $spacing = $logoListSettings['image_spacing'];
$grey = $logoListSettings['grey_scale_image'];
$logos = $this->row['manufacturer_list'];
$logoCount = count($logos);     
$white_logos = $logoListSettings['white_logos'];
$greyImg = '';
if ( $grey == true ) {
  $greyImg = 'img-grey';
}

if($logoCount <= 4) {
  echo '<ul class="list-inline logo-list logo-list--manufacturers justify-center">';
    if ($title) {
      echo '<li class="logo-list__item"><span class="text-headline text-uppercase">'.$title.'</span></li>';
    }
    
    foreach ($logos as $logo) {
      $item = $logo['value'];
      
      echo '<li class="logo-list__item margin-left-lg">';
      if($addBg == true) {
        echo '<div class="logo-list__inner flex items-center bg-contrast-100 shadow-md radius-md">';
      }             

      if($white_logos == true) {
        if($size == 'standard') {
          echo '<img src="'.$manufactuer[$item]['white-logo'].'" alt="'.$item .' logo" class="logo-list__logo--standard">';
        } else {
          echo '<img src="'.$manufactuer[$item]['white-logo'].'" alt="'.$item .' logo" class="logo-list__logo--small">';
        } 
      } else {
        if($size == 'standard') {
          echo '<img src="'.$manufactuer[$item]['color-logo'].'" alt="'.$item .' logo" class="logo-list__logo--standard '.$greyImg.'">';
        } else {
          echo '<img src="'.$manufactuer[$item]['color-logo'].'" alt="'.$item .' logo" class="logo-list__logo--small '.$greyImg.'">';
        } 
      }
      
      if($addBg == true) {
        echo '</div>';
      }
      echo '</li>';
    }
  echo '</div>';
}

if($logoCount > 4) {

  wp_enqueue_script("carousel", get_template_directory_uri()."/dist/assets/js/carousel.js", ['swiper-js'], false, true );

  wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], false, true );

  if(isset($title)) {
    echo '<div class="col-12">'.$title.'</div>';
    echo '<div class="col-12"><div class="swiper-container logo-list__carousel logo-list__carousel--manufacturers "><div class="swiper-wrapper logo-list__wrapper">';
    foreach ($logos as $logo) {
      $item = $logo['value'];
      echo '<div class="swiper-slide text-component">';
      if($addBg == true) {
        echo '<div class="logo-list__inner bg-contrast-100 padding-sm shadow-sm radius-md">';
      } 
      if($white_logos == true) {
        if($size == 'standard') {
          echo '<img src="'.$manufactuer[$item]['white-logo'].'" alt="'.$item .' logo" class="logo-list__logo--standard ">';
        } else {
          echo '<img src="'.$manufactuer[$item]['white-logo'].'" alt="'.$item .' logo" class="logo-list__logo--small">';
        } 
      } else {
        if($size == 'standard') {
          echo '<img src="'.$manufactuer[$item]['color-logo'].'" alt="'.$item .' logo" class="logo-list__logo--standard '.$greyImg.'">';
        } else {
          echo '<img src="'.$manufactuer[$item]['color-logo'].'" alt="'.$item .' logo" class="logo-list__logo--small '.$greyImg.'">';
        } 
      }
      if ($imgDesc) {
        echo '<p class="text-sm text-center">'.$logo['caption'].'</p>';
      }
      if($addBg == true) {
        echo '</div>'; // end inner bg
      }
      echo '</div>'; // end slide
    }
    echo '</div></div></div>'; // end swiper container and wrapper
    // echo '<div class="col-12 text-center"><a id="view-all" class="btn btn--gray btn--sm"><i class="fas fa-th"></i> View All</a></div>';
    echo '<div class="navigation-inline margin-top-lg"><div class="swiper-navigation"><div class="swiper-button-prev swiper-button-prev--manufacturers"></div><div class="swiper-pagination swiper-pagination--manufacturers swiper-pagination--logo-list"></div><div class="swiper-button-next swiper-button-next--manufacturers"></div></div></div>';
  }
}