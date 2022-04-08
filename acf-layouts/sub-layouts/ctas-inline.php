<?php
foreach ( $this->ctaRepeater as $cta ) {
  $image = $cta['image']['sizes']['cta-image'];
  $alt = $cta['image']['alt'];
  $width = $cta['image']['sizes']['cta-image-width'];
  $height = $cta['image']['sizes']['cta-image-height'];
  $content = $cta['cta_content'];
  $bgColor = $cta['color_options'];
  $link = $cta['cta_link'];
  
  echo '<div class="col-4@md col-12 '.$ctaBg.$bgColor.'">';
  echo '<div class="card card--icon '.$ctaPadding.'">';
  echo '<div class="card__inner--inline">';
  echo $content;
  echo '</div>'; // CTA Innter
  echo '</div>'; // CTA
  echo '</div>'; // Grid
}