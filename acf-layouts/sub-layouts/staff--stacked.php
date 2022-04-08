<?php
$count = count($this->staff);
echo '<div class="grid">';
echo '<div class="container max-width-sm">';
echo '<div class="col-12 text-component margin-bottom-xl">';
echo $this->staffContent;
echo '</div>';
echo '</div>';
echo '</div>';
echo '<div class="col-12">';
echo '<div class="grid grid-gap-xl justify-center">';


foreach ($this->staff as $s) {
  if ($count < 4 && $this->staffProfile == 'small' ) {
    echo '<div class="col-4@md col-12">';
    echo '<div class="hp-staff text-component grid grid-gap-md items-center">';
    // var_dump($s);
    $job_title = get_post_meta($s->ID, 'job_title', true);

    if ($this->staffProfile != 'hover') {
      echo '<div class="hp-staff__img hp-staff__img--small col-6"><img src="'.get_the_post_thumbnail_url($s->ID,'1:1').'" class="shadow-sm radius-md width-100 margin-bottom-md" /></div>';
      echo '<div class="col-6">';
      echo '<h3 class="text-md">'.$s->post_title.'</h3>';
      echo '<h4 class="text-semibold letter-spacing-xxxxs text-uppercase text-sm font-primary color-secondary">'.$job_title.'</h4>';
      
      if ($this->staffProfile != 'small' || !empty( $this->learnMore )) {
        echo '<p><a href="'.get_the_permalink($s->ID).'" class="text-sm btn--link btn--icon-arrow">View Profile</a></p>';
      }
      
      echo '</div>';
      
    }
    echo '</div>';
    echo '</div>';
  } else {
    echo '<div class="col-3@md col-12">';
    echo '<div class="hp-staff text-component text-center radius-md">';
    // var_dump($s);
    $job_title = get_post_meta($s->ID, 'job_title', true);
  
    if ($this->staffProfile != 'hover') {
      if ($this->staffProfile == 'large') {
        echo '<div class="hp-staff__img hp-staff__img--large"><img src="'.get_the_post_thumbnail_url($s->ID,'4:3-vertical').'" class="radius-md shadow-md width-100 margin-bottom-md" /></div>';
      } elseif ($this->staffProfile == 'small') {
        echo '<div class="hp-staff__img hp-staff__img--small"><img src="'.get_the_post_thumbnail_url($s->ID,'1:1').'" class="shadow-sm radius-md width-100 margin-bottom-md" /></div>';
      }
      
      echo '<h3>'.$s->post_title.'</h3>';
      echo '<h4 class="text-semibold letter-spacing-xxxxs text-uppercase text-sm font-primary color-secondary">'.$job_title.'</h4>';
      
      if ($this->staffProfile != 'small' || !empty( $this->learnMore )) {
        echo '<p><a href="'.get_the_permalink($s->ID).'" class="btn--link btn--icon-arrow">View Profile</a></p>';
      }
    }
  
    if ( $this->staffProfile == 'hover' ) {
      echo '<div class="hp-staff__hover">';
      echo '<img src="'.get_the_post_thumbnail_url($s->ID,'1:1').'" class="radius-md" />';
      echo '<div class="hp-staff__overlay radius-md"></div>';
      echo '<div class="hp-staff__details text-white text-center">';
      echo '<h3>'.$s->post_title.'</h3>';
      echo '<h4 class="letter-spacing-xxxxs text-uppercase text-sm font-primary color-secondary">'.$job_title.'</h4>';
      echo '<a href="'.get_the_permalink($s->ID).'" class="hp-staff__link btn--link btn--icon-arrow">View Profile</a>';
      echo '</div>';
      echo '</div>';
    }
    echo '</div>';
    echo '</div>';
  }
    
}

echo '</div>';