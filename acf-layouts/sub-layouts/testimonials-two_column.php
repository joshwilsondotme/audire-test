<?php
$content = $this->row['2-column'];
$featured_content = $content['featured_content'];
$column_sizing = $content['column_sizing'];
$quote_list = $content['quotes'];
$count = count($content['quotes']);
$column_bg_enable = $content['enable_background_color'];
$column_bg = $content['color_options'];
$content_side = $content['content_side'];

$side_left = '';
if ($content_side == 'left' ) {
  $side_left = 'order-1';
} else {
  $side_left = 'order-2';
}

$side_right = '';
if ($content_side == 'right' ) {
  $side_right = 'order-1';
} else {
  $side_right = 'order-2';
}

if($column_sizing == '40-60') {
  echo '<div class="col-5@md col-12 text-component '.$side_left.'">'. $featured_content .'</div>';
}else{
  echo '<div class="col-6@md col-12 text-component '.$side_left.'">'. $featured_content .'</div>';
}

// var_dump($this->testimonials['column_sizing']);
if($column_sizing == '40-60') {
  echo '<div class="col-7@md col-12 text-component '.$side_right.'">';
}else{
  echo '<div class="col-6@md col-12 text-component '.$side_right.'">';
}
// echo '<div class="col-6@md col-12 text-component">';

if($count >= 2) {
  wp_enqueue_script("carousel", get_template_directory_uri()."/dist/assets/js/carousel.js", ['swiper-js'], false, true );

  wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], false, true );

  echo '<div class="swiper-container carousel--testimonial"><div class="swiper-wrapper">';
}


foreach($content['quotes'] as $testimonial) {
  // var_dump($testimonial);
  $pull_quote = $testimonial['pull_quote'];
  $quote = $testimonial['quote'];
  $cite = $testimonial['cite'];
  $additional_cite = $testimonial['cite_additional'];
  $media_options = $testimonial['media_options'];
  $photo = $testimonial['photo'];
  
  if($count >= 2) {
    echo '<div class="swiper-slide">';
  }

  if($column_bg_enable == true) {
    echo '<div class="testimonial__inner text-component bg-' . $column_bg . ' padding-lg shadow-sm radius-md">';
  }

  if ($media_options == 'stars') {
    echo '<div class="testimonials__stars margin-bottom-md"><i class="fas fa-star color-warning"></i> <i class="fas fa-star color-warning"></i> <i class="fas fa-star color-warning"></i> <i class="fas fa-star color-warning"></i> <i class="fas fa-star color-warning"></i></div>';
  }

  echo '<blockquote class="testimonial__quote">';

  echo ($pull_quote) ? '<p class="testimonial__pull-quote testimonial__pull-quote--right margin-top-md"><strong>'.$pull_quote.'</strong></p>': '';

  echo $quote;

  if($photo) {
    echo '<div class="testimonial__photo-cite flex items-center"> <div class="testimonial__photo-cite--left margin-right-lg">';
    echo '<img src="'. $photo['sizes']['thumbnail'] .'" class="lazyload radius-full shadow-sm" loading="lazy" alt="'. $photo['alt'].'" width="'.$photo['sizes']['thumbnail-width'].'" height="'.$photo['sizes']['thumbnail-height'].'>">';
    echo '</div>';
    echo '<div class="testimonial__photo-cite--right">';
    echo '<cite><span class="text-headline">'.$cite.'</span>';
    echo (isset($additional_cite)) ? '<br><span class="text-uppercase text-sm">'.$additional_cite.'</span>' : '';
    echo '</cite>';
    echo '</div>';
    echo '</div>';
  } else {
    echo '<cite><span class="text-headline">'.$cite.'</span>';
    echo (isset($additional_cite)) ? '<br><span class="text-uppercase text-sm">'.$additional_cite.'</span>' : '';
    echo '</cite>';
  }

  echo '</blockquote>';

  if($column_bg_enable == true) {
    echo '</div>';
  }
  
  if($count >= 2) {
    // end slide
    echo '</div>';
  }
}
if($count >= 2) {
  // end carousel
  echo '</div><div class="swiper-navigation">
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination swiper-pagination--testimonials"></div>
    <div class="swiper-button-next"></div>
  </div></div>';
}
echo '</div>';