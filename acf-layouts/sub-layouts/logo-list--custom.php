<?php
  $logoListSettings = $this->row;
  $title = $logoListSettings['list_title'];
  $size = $logoListSettings['image_size'];
  $addBg = $logoListSettings['add_white_bg'];
  $imgDesc = $logoListSettings['add_image_description'];
  $grey = $logoListSettings['grey_scale_image'];
  $logos = $this->row['logos'];
  $logoCount = count($logos);     

  if($logoCount <= 4) {
    // echo '<ul class="list-inline logo-list">';
    echo '<ul class="grid grid-gap-md">';
      if ($title) {
        echo '<li class="col"><span class="text-headline text-uppercase">'.$title.'</span></li>';
      }
      foreach ($logos as $logo) {
        // var_dump($logo);
        echo '<li class="col">';
        if($addBg == true) {
          echo '<div class="logo-list__inner bg-contrast-100 padding-md shadow-md radius-md">';
        }

        if($size == 'standard') {
          echo '<img src="'.$logo['sizes']['standard-logo'].'" alt="'.$logo['title'].'" />';
        } else {
          echo '<img src="'.$logo['sizes']['small-logo'].'" alt="'.$logo['title'].'" />';
        }
        
        if($addBg == true) {
          echo '</div>';
        }
        echo '</li>';
      }
    echo '</div>';
  }

  if($logoCount > 5) {
    
    wp_enqueue_script("carousel", get_template_directory_uri()."/dist/assets/js/carousel.js", ['swiper-js'], false, true );

    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], false, true );

    if($title) {
      echo '<div class="col-12">'.$title.'</div>';
      echo '<div class="col-12"><div class="swiper-container logo-list__carousel logo-list__carousel--custom"><div class="swiper-wrapper logo-list__wrapper logo-list__wrapper--custom">';
      foreach ($logos as $logo) {
        
        echo '<div class="swiper-slide text-component">';
        if($addBg == true) {
          echo '<div class="logo-list__inner bg-contrast-100 padding-sm shadow-sm radius-md">';
        } ?>

        <img src="<?= ($size == 'standard') ? $logo['sizes']['standard-logo'] : $logo['sizes']['small-logo']  ?>" alt="<?= $logo['title'] ?>" class="<?= ($grey == true) ? 'img-grey' : '' ?>" />
        <?php
        
        if ($imgDesc) {
          echo '<p class="text-sm text-center">'.$logo['caption'].'</p>';
        }
        if($addBg == true) {
          echo '</div>'; // end inner bg
        }
        echo '</div>'; // end slide
      }
      echo '</div></div></div>'; // end swiper container and wrapper
      // echo '<div class="col-12 text-center"><a id="view-all--custom" class="btn btn--gray btn--sm"><i class="fas fa-th"></i> View All</a></div>';
      echo '<div class="navigation-inline margin-top-lg"><div class="swiper-navigation"><div class="swiper-button-prev swiper-button-prev--custom"></div><div class="swiper-pagination swiper-pagination--custom"></div><div class="swiper-button-next swiper-button-next--custom"></div></div></div>';
    }
  }