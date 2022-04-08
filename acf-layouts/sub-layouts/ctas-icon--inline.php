<?php
$ctaPadding = ($this->ctaContentContainer == 'full') ? 'padding-xl' : '';
$ctaBg = ($this->ctaContentContainer == 'full') ? 'bg-' : '';
$ctaIconStyle = ($this->ctaIconStyle == 'light') ? 'light' : 'dark';
foreach ( $this->ctaRepeater as $cta ) {
  $image = $cta['image']['sizes']['cta-image'];
  $icon = $cta['icon']['url'];
  $iconHover = $cta['icon_hover']['url'];
  $iconAlt = $cta['icon_hover']['alt'];
  $iconHoverAlt = $cta['icon']['alt'];
  $iconWidth = $cta['image']['sizes']['cta-image-width'];
  $iconHeight = $cta['image']['sizes']['cta-image-height'];
  $content = $cta['cta_content'];
  $bgColor = $cta['color_options'];
  

  // var_dump($bgColor);

  echo '<div class="col-4@md col-12 ">';
  echo '<div class="card card--icon '.$ctaPadding.'">';
  echo '<div class="card__inner--inline">';
  echo '<div class="card__left">'; 
  echo '<div class="card__icon card__icon--'.$ctaIconStyle.'">';
  echo '<img loading="lazy" src="'.$icon.'" alt="'.$iconAlt.'">';
  echo '<img loading="lazy" src="'.$iconHover.'" alt="'.$iconHoverAlt.'" class="card__icon--hover">';
  echo '</div>'; // Image
  echo '</div>';
  echo '<div class="card__right">';
  
  echo '<div class="card__details text-component padding-x-md padding-bottom-md">';
  echo $content;
  echo '</div>'; // Details
  echo '</div>';
  echo '</div>'; // CTA Innter
  echo '</div>'; // CTA
  echo '</div>'; // Grid
}