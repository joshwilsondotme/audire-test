<?php
$textAlign = '';
foreach ( $this->ctaRepeater as $cta ) {
  $image = $cta['image']['sizes']['cta-image'];
  $alt = $cta['image']['alt'];
  $width = $cta['image']['sizes']['cta-image-width'];
  $height = $cta['image']['sizes']['cta-image-height'];
  $content = $cta['cta_content'];
  $bgColor = $cta['color_options'];
  $link = $cta['cta_link'];
  $textAlignment = $cta['cta_text_alignment'];
  
  if ($textAlignment == true ) {
    $textAlign = 'text-center items-center';
  }

  if ( $this->ctaImageStyle == 'no_bg' ) {
    echo '<div class="col-4@md col-12">';
    echo '<a href="'.$link.'" class="card card__basic card__basic--transparent link__block ">';
    echo '<div class="card__inner">';
    echo '<div class="card__image radius-md">';
    echo '<img loading="lazy" src="'.$image.'" alt="'.$alt.'" class="width-100 radius-md" width="'.$width.'" height="'.$height.'">';
    echo '</div>'; // Image
    echo '<div class="card__details text-component padding-md flex flex-column '.$textAlign.'">';
    echo $content;
    echo '</div>'; // Details
    echo '</div>'; // CTA Innter
    echo '</a>';
    echo '</div>'; // Grid
  } elseif ( $this->ctaImageStyle == 'white' ) {
    echo '<div class="col-4@md col-12">';
    echo '<a href="'.$link.'" class="card card__basic radius-md bg-contrast-100 link__block">';
    echo '<div class="card__inner">';
    echo '<div class="card__image">';
    echo '<img loading="lazy" src="'.$image.'" alt="'.$alt.'" class="width-100 radius-md radius-bottom-right-0 radius-bottom-left-0" width="'.$width.'" height="'.$height.'">';
    echo '</div>'; // Image
    echo '<div class="card__details text-component padding-md flex flex-column '.$textAlign.'">';
    echo $content;
    echo '</div>'; // Details
    echo '</div>'; // CTA Innter
    echo '</a>';
    echo '</div>'; // Grid
  } elseif ( $this->ctaImageStyle == 'hover' ) {
    if ($this->ctaContentContainer == 'full') {
      echo '<div class="col-4@md col-12">';
      echo '<a href="'.$link.'" class="card card__hover link__block">';
      echo '<div class="card__overlay"></div>';
      echo '<div class="card__image">';
      echo '<img loading="lazy" src="'.$image.'" alt="'.$alt.'" class="width-100" width="'.$width.'" height="'.$height.'">';
      echo '</div>'; // Image
      echo '<div class="card__details text-component padding-md">';
      echo '<div class="card__hover-overlay radius-0 bg-'.$bgColor.'"></div>';
      echo '<div class="card__details-inner">';
      echo $content;
      echo '</div>'; // Details Inner
      echo '</div>'; // Details
      echo '</a>'; // CTA
      echo '</div>'; // Grid
    } elseif ($this->row['section_design_options']['grid_gap'] == 'none') {
      echo '<div class="col-4@md col-12">';
      echo '<a href="'.$link.'" class="card card__hover link__block">';
      echo '<div class="card__overlay"></div>';
      echo '<div class="card__image">';
      echo '<img loading="lazy" src="'.$image.'" alt="'.$alt.'" class="width-100" width="'.$width.'" height="'.$height.'">';
      echo '</div>'; // Image
      echo '<div class="card__details text-component padding-md">';
      echo '<div class="card__hover-overlay radius-0 bg-'.$bgColor.'"></div>';
      echo '<div class="card__details-inner">';
      echo $content;
      echo '</div>'; // Details Inner
      echo '</div>'; // Details
      echo '</a>'; // CTA
      echo '</div>'; // Grid
    } else {
      echo '<div class="col-4@md col-12">';
      echo '<a href="'.$link.'" class="card card__hover radius-md link__block">';
      echo '<div class="card__overlay radius-md"></div>';
      echo '<div class="card__image">';
      echo '<img loading="lazy" src="'.$image.'" alt="'.$alt.'" class="width-100 radius-md" width="'.$width.'" height="'.$height.'">';
      echo '</div>'; // Image
      echo '<div class="card__details text-component padding-md">';
      echo '<div class="card__hover-overlay  bg-'.$bgColor.'"></div>';
      echo '<div class="card__details-inner">';
      echo $content;
      echo '</div>'; // Details Inner
      echo '</div>'; // Details
      echo '</a>'; // CTA
      echo '</div>'; // Grid
    }
    
  }
}