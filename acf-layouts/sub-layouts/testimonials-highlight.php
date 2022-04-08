<?php 

  wp_enqueue_script("carousel", get_template_directory_uri()."/dist/assets/js/carousel.js", ['swiper-js'], false, true );

  wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], false, true );
  // var_dump($this->row['highlight_with_scroll']);
  $content = $this->row['highlight_with_scroll'];
  $feature_image = $content['featured_image'];
  $quote_list = $content['quotes'];
  $count = count($quote_list);

  echo '<div class="col-5@md col-12"><img src="'.$feature_image['url'].'" class="lazyload shadow-md" loading="lazy" width="'.$feature_image['width'].'" height="'.$feature_image['height'].'"/></div>';

  echo '<div class="col-7@md col-12"><div class="swiper-container carousel--highlight"><div class="swiper-wrapper">';
  foreach($quote_list as $q) {
    // var_dump($q);
    echo '<div class="swiper-slide"><blockquote class="testimonial__quote text-component">
    <p class="testimonial__bubble-quote">
      <strong>'.$q['quote'].'</strong>
    </p>
    <cite>
      <span class="text-headline">'.$q['cite'].'</span>
      <?php if($additional_cite) : ?>
        <br /><span class="text-uppercase text-sm">'.$q['additional_cite'].'</span>
      <?php endif; ?>
    </cite>
  </blockquote></div>';
  }
  
  echo '</div></div><div class="navigation-inline"><div class="swiper-navigation"><div class="swiper-button-prev"></div><div class="swiper-pagination swiper-pagination--highlight"></div><div class="swiper-button-next"></div></div></div></div>'; // end column and sipwer containers
  echo '';