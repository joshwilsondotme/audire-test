<?php 
  // var_dump($this->row);
  $content = $this->row['standard'];
  
  // var_dump($count);
  // $pull_quote = $this->row['standard'];
  // var_dump($pull_quote);
  foreach($content as $testimonial) {
    
    // $pull_quote = $testimonial['pull-quote'];
    $quote = $testimonial['quote'];
    $cite = $testimonial['cite'];
    $additional_cite = $testimonial['additional_cite'];
    $pull_quote = $testimonial['pull_quote'];
    $media_options = $testimonial['media_options'];
    $photo = $testimonial['photo'];
    $column_bg = $testimonial['color_options'];
    $column_bg_enable = $testimonial['enable_background_color'];
    
    
    if( $count >= 3) {
      echo '<div class="swiper-slide carousel--testimonial__slide text-center text-component">';
    }

    if( $count <= 2) {
      echo '<div class="col-8@md col-12"><div class="text-center text-component">';
    }
    

    if($column_bg_enable == true) {
      echo '<div class="testimonial__inner bg-' . $column_bg . ' padding-lg shadow-sm radius-md">';
    }

    if ($media_options == 'photo') {
      echo  '<img class="radius-full aligncenter margin-bottom-lg shadow-sm" src="'.$photo['sizes']['thumbnail'].'" alt="'.$photo['title'].'" />';
    }

    if ($media_options == 'stars') {
      echo '<div class="testimonials__stars margin-bottom-lg"><i class="fas fa-star color-warning"></i> <i class="fas fa-star color-warning"></i> <i class="fas fa-star color-warning"></i> <i class="fas fa-star color-warning"></i> <i class="fas fa-star color-warning"></i></div>';
    }

    echo '<blockquote class="testimonial__quote">';

    echo ($pull_quote) ? '<p class="testimonial__pull-quote margin-top-md"><strong>'.$pull_quote.'</strong></p>': '';

    echo $quote;

    echo '<cite><span class="text-headline">'.$cite.'</span>';
    echo (isset($additional_cite)) ? '<br><span class="text-uppercase text-sm">'.$additional_cite.'</span>' : '';
    echo '</cite>';

    echo '</blockquote>';

    if($column_bg_enable == true) { echo '</div>'; } // column bg
    
    if( $count <= 2) {
      echo '</div></div>'; // end column
    }
    if( $count >= 3) {
      echo '</div>';
    }
  }
  // $quote = $content['quote'];
  // $cite = $content['cite'];
  // $additional_cite = $content['additional_cite'];
  // $media_options = $content['media_options'];
  // $photo = $content['photo'];
  // $column_width = $content['column_width'];
  // $column_design = $content['column_design_options'];
  // $column_bg_enable = $column_design['enable'];
  // $column_bg = $column_design['design_options']['color_options'];
  // $column_padding = $column_design['design_options']['padding'];
  // $column_shadow = $column_design['design_options']['box_shadow'];
  // // var_dump($count);
  // if($count >= 3) {
  //   echo '<div class="swiper-slide flex justify-center">';
  // }

  // echo '<div class="col-'.$column_width.'@md col-12 text-component text-center justify-center">';

  // if($column_bg_enable == true) {
  //   // var_dump($column_design);
  //   echo '<div class="testimonial__inner text-component bg-' . $column_bg . ' padding-'. $column_padding. ' shadow-'.$column_shadow.' radius-md">';
  // }

  // if ($media_options == 'photo') {
  //   echo  '<img class="radius-full aligncenter margin-bottom-md shadow-sm" src="'.$photo['sizes']['thumbnail'].'" alt="'.$photo['title'].'" />';
  // }

  // if ($media_options == 'stars') {
  //   echo '<div class="testimonials__stars margin-bottom-md"><i class="fas fa-star color-warning"></i> <i class="fas fa-star color-warning"></i> <i class="fas fa-star color-warning"></i> <i class="fas fa-star color-warning"></i> <i class="fas fa-star color-warning"></i></div>';
  // }
  // echo '<blockquote class="testimonial__quote">';

  // echo ($pull_quote) ? '<p class="testimonial__pull-quote margin-top-md"><strong>'.$pull_quote.'</strong></p>': '';

  // echo $quote;

  // echo '<cite><span class="text-headline">'.$cite.'</span>';
  // echo (isset($additional_cite)) ? '<br><span class="text-uppercase text-sm">'.$additional_cite.'</span>' : '';
  // echo '</cite>';

  // echo '</blockquote>';

  // if($column_bg_enable == true) {
  //   echo '</div>';
  // }
  // echo '</div>';
  // if($count >= 3) {
  //   echo '</div>';
  // }
?>
