<?php
$job_title = get_post_meta($this->staffFeature->ID, 'job_title', true);

// var_dump($this->staffFeature->ID);
echo '<div class="col-5@md col-12 text-component">';
echo '<div class="hp-staff text-component text-center radius-md shadow-md">';
echo '<div class="hp-staff__hover">';
    echo '<img src="'.get_the_post_thumbnail_url($this->staffFeature->ID,'4:5').'" class="radius-md" />';
    echo '<div class="hp-staff__overlay radius-md"></div>';
    echo '<div class="hp-staff__overlay--hover radius-md bg-'.$this->staffOverlay.'"></div>';
    echo '<div class="hp-staff__details text-white text-center">';
    echo '<h3>'.$this->staffFeature->post_title.'</h3>';
    echo '<h4 class="text-semibold letter-spacing-xxxxs text-uppercase text-sm font-primary">'.$job_title.'</h4>';
    echo '<a href="'.get_the_permalink($this->staffFeature->ID).'" class="hp-staff__link btn--link btn--icon-arrow">View Profile</a>';
    echo '</div>';
    echo '</div>';
echo '</div>';
echo '</div>';
echo '<div class="col-7@md col-12 text-component">'.$this->staffContent.'</div>';
echo '<div class="col-12">';
echo '<div class="grid grid-gap-xl">';
foreach ($this->staff as $s) {
  echo '<div class="col-3@md col-12">';
  echo '<div class="hp-staff text-component text-center">';
  
  $job_title = get_post_meta($s->ID, 'job_title', true);

  if ($this->staffProfile != 'hover') {
    if ($this->staffProfile == 'large') {
      echo '<div class="hp-staff__img hp-staff__img--large"><img src="'.get_the_post_thumbnail_url($s->ID,'4:3-vertical').'" class="shadow-md width-100 radius-md margin-bottom-md" /></div>';
    } elseif ($this->staffProfile == 'small') {
      echo '<div class="hp-staff__img hp-staff__img--small"><img src="'.get_the_post_thumbnail_url($s->ID,'1:1').'" class="shadow-md radius-md width-100 margin-bottom-md" /></div>';
    }
    
    echo '<h3>'.$s->post_title.'</h3>';
    echo '<h4 class="text-semibold letter-spacing-xxxxs text-uppercase text-sm font-primary color-secondary">'.$job_title.'</h4>';
    
    if ($this->staffProfile != 'small' || !empty( $this->learnMore )) {
      echo '<p><a href="'.get_the_permalink($s->ID).'" class="btn--link btn--icon-arrow">View Profile</a></p>';
    }
  } 

  if ( $this->staffProfile == 'hover' ) {
    echo '<div class="hp-staff__hover radius-md">';
    echo '<img src="'.get_the_post_thumbnail_url($s->ID,'1:1').'" class="radius-md" />';
    echo '<div class="hp-staff__overlay radius-md"></div>';
    echo '<div class="hp-staff__overlay--hover radius-md bg-'.$this->staffOverlay.'"></div>';
    echo '<div class="hp-staff__details text-white text-center">';
    echo '<h3>'.$s->post_title.'</h3>';
    echo '<h4 class="text-semibold letter-spacing-xxxxs text-uppercase text-sm font-primary">'.$job_title.'</h4>';
    echo '<a href="'.get_the_permalink($s->ID).'" class="hp-staff__link btn--link btn--icon-arrow">View Profile</a>';
    echo '</div>';
    echo '</div>';
  }
  echo '</div>';
  echo '</div>';  
}
echo '</div>';
echo '</div>';