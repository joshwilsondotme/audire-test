<?php
$ctaPadding = ($this->ctaContentContainer == 'full') ? 'padding-xl' : '';
$ctaBg = ($this->ctaContentContainer == 'full') ? 'bg-' : '';
$ctaIconStyle = ($this->ctaIconStyle == 'light') ? 'light' : 'dark';
$textAlign = '';

if ( $this->ctaIconStyle == 'solid' ) {
  foreach ( $this->ctaRepeater as $cta ) {
    $image = $cta['image']['sizes']['cta-image'];
    $icon = $cta['icon_group_start']['icon']['url'];
    $icon_altText = $cta['icon_group_start']['icon']['alt'];
    $icon_hover = $cta['icon_group_hover']['icon']['url'];
    $icon_hover_altText = $cta['icon_group_hover']['icon']['alt'];
    
    $content = $cta['cta_content'];
    $bgColor = $cta['color_options'];
    $link = $cta['cta_link'];
  
    $icon_group_icon_color = $cta['icon_group_start']['color_options'];
    $icon_group_icon_color_hover = $cta['icon_group_hover']['color_options'];
  
    $textAlignment = $cta['cta_text_alignment'];
    
    if ($textAlignment == true ) {
      $textAlign = 'text-center items-center';
    }
  
    echo '<div class="col-4@md col-12 '.$ctaBg.$bgColor.'">';
    echo '<a href="'.$link.'" class="card card__icon card__icon--stacked '.$ctaPadding.'">';
    echo '<div class="card__inner">';
    echo '<div class="card__image-container">';
    echo '<div class="card__image card__image--start bg-'.$icon_group_icon_color.'">';
    echo '<img loading="lazy" src="'.$icon.'" alt="'.$icon_altText.'">';
    echo '</div>';
    echo '<div class="card__image card__image--hover bg-'.$icon_group_icon_color_hover.'">';
    echo '<img loading="lazy" src="'.$icon_hover.'" alt="'.$icon_hover_altText.'">';
    echo'</div>';
    echo '</div>';
    echo '<div class="card__details text-component padding-md flex flex-column '.$textAlign.'">';
    echo $content;
    echo '</div>'; // Details
    echo '</div>'; // CTA Innter
    echo '</a>'; // CTA
    echo '</div>'; // Grid
  }
} elseif ( $this->ctaIconStyle == 'bordered' ) {
  foreach ( $this->ctaRepeater as $cta ) {
    $image = $cta['image']['sizes']['cta-image'];
    $icon = $cta['icon_group_start']['icon']['url'];
    $icon_altText = $cta['icon_group_start']['icon']['alt'];
    $icon_hover = $cta['icon_group_hover']['icon']['url'];
    $icon_hover_altText = $cta['icon_group_hover']['icon']['alt'];
    
    $content = $cta['cta_content'];
    $bgColor = $cta['color_options'];
    $link = $cta['cta_link'];
  
    $icon_group_icon_color = $cta['icon_group_start']['color_options'];
    $icon_group_icon_color_hover = $cta['icon_group_hover']['color_options'];
  
    $textAlignment = $cta['cta_text_alignment'];
    
    if ($textAlignment == true ) {
      $textAlign = 'text-center items-center';
    }
  
    echo '<div class="col-4@md col-12 '.$ctaBg.$bgColor.'">';
    echo '<a href="'.$link.'" class="card card__icon card__icon--stacked '.$ctaPadding.'">';
    echo '<div class="card__inner">';
    echo '<div class="card__image-container">';
    echo '<div class="card__image card__image--start" style="border: 2px solid var(--color-'.$icon_group_icon_color.');">';
    echo '<img loading="lazy" src="'.$icon.'" alt="'.$icon_altText.'">';
    echo '</div>';
    echo '<div class="card__image card__image--hover bg-'.$icon_group_icon_color_hover.'">';
    echo '<img loading="lazy" src="'.$icon_hover.'" alt="'.$icon_hover_altText.'">';
    echo'</div>';
    echo '</div>';
    echo '<div class="card__details text-component padding-md flex flex-column '.$textAlign.'">';
    echo $content;
    echo '</div>'; // Details
    echo '</div>'; // CTA Innter
    echo '</a>'; // CTA
    echo '</div>'; // Grid
  }
}
