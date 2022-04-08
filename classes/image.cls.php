<?php

class Image {

  protected $row;
    
  public $image;
  public $box_shadow;
  public $border_radius;
  public $overlay_selector;
  public $overlay_color_rgba;
  public $overlay_blur;
    
  public function __construct($row) {
    $this->row = $row;
      
    $this->image            = $row['image'];
    $this->box_shadow       = $row['box_shadow'];
    $this->border_radius    = $row['border_radius'];
    $this->overlay_selector = (bool)$row['overlay_selector'];
    
    if ( $this->overlay_selector ) {
      $overlay_array            = explode('-', $row['image_overlay']['color_options']);
      $this->overlay_color_rgba = ($row['image_overlay']['opacity'] > 0)
                                    ? hex2rgba($GLOBALS['themeColors'][$overlay_array[0]][$overlay_array[1]], $row['image_overlay']['opacity'] / 100)
                                    : '';
      $this->overlay_blur       = (bool)$row['image_overlay']['filters']['blur'];
      $this->overlay_gray       = (bool)$row['image_overlay']['filters']['grayscale'];
    }
  }
    
  public function render() {    
    echo '<div class="image-container ' . $this->getImageClasses() . '">
      <img src="' . $this->image['url'] . '" alt="' . $this->image['alt'] . '" title="' . $this->image['title'] . '" />';
      
      if ( !empty( $this->overlay_selector ) ) {
        echo '<div class="image-overlay" style="' . $this->getOverlayStyles() . '"></div>';
      }
      
    echo '</div>';
  }
    
  /*
   * Utility Functions
   */
  protected function getImageClasses() {
    $classes = [];
    
    if ( !empty( $this->box_shadow ) ) {
      $classes[] = 'shadow-' . $this->box_shadow;
    }
      
    if ( !empty( $this->border_radius ) ) {
      $classes[] = 'radius-' . $this->border_radius;
    }
      
    return implode(' ', $classes);
  }
  
  protected function getOverlayStyles() {
    $styles = [];
      
    if ( !empty( $this->overlay_color_rgba ) ) {
      $styles[] = 'background-color: ' . $this->overlay_color_rgba;
    }
    
    if ( !empty( $this->overlay_blur ) || !empty( $this->overlay_gray ) ) {
      $filter   = 'backdrop-filter:';
    
      if ( !empty( $this->overlay_blur ) ) $filter .= ' blur(5px)';
      if ( !empty( $this->overlay_gray ) ) $filter .= ' grayscale(1)';
      
      $styles[] = $filter;
    }
  
    return implode('; ', $styles);
  }
  
}