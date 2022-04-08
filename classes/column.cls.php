<?php
 
/*
 * TO DO
 *
 * Theme Color global array doesn't load contrast values
 * Schema Implementation
 *
 * Toggleable column type:
 * - Image(s) w/ Styling and Overlap Options
 * - Image Cluster w/ Hover Cards
 * - Carousel
 * - Logo List
 * - Step Blocks
 * - Staff?
 *
 */

abstract class Column {

    protected $data;
    protected $content_type;

    public $colspan;
    public $offset;
    public $content_alignment;
    public $padding;

    public $boxed_content;
    public $bg_color_rgba;    
    public $border_radius;
    public $box_shadow;
    
    public function __construct($data) {
      $this->data = $data;
      $this->content_type = $data['content_type'];
      
      if ( !empty( $columnOptions = $this->data['column_design_options'] ) ) {
        $this->colspan           = $columnOptions['column_size']['span'] ?: $columnOptions['column_width'];
        $this->offset            = $columnOptions['column_size']['offset'];
        $this->content_alignment = $columnOptions['content_alignment'];
        $this->padding           = $columnOptions['padding'];
      }
      
      if ( (bool)$columnOptions['boxed_content'] ) {
        $bg_array = explode('-', $columnOptions['content_bg_settings']['color_options']);
        
        $this->bg_color_rgba = hex2rgba($GLOBALS['themeColors'][$bg_array[0]][$bg_array[1]], $columnOptions['content_bg_settings']['opacity'] / 100);
        $this->border_radius = $columnOptions['content_bg_settings']['border_radius'];
        $this->box_shadow    = $columnOptions['content_bg_settings']['box_shadow'];
      }
    }
    
    public function render() {      
      echo '<div class="column ' . $this->getColumnClasses() . '" style="' . $this->getColumnStyles() . '">';
      
      $this->renderContent();
      
      echo '</div>';
    }
    
    /* Protected Functions */
    protected function getColumnClasses() {
      $classes = [];
      
      if ($this->content_type == "text") {
        $classes[] = 'text-component';
      }
      
      // Assign column span only for non-mobile displays.
      // Otherwise, use the full content width.
      $classes[] = 'col-' . $this->colspan . '@sm';
      
      // Apply offset only if greater than 0,
      // and only on non-mobile displays.
      if ( !empty($this->offset) ) {
        $classes[] = 'offset-' . $this->offset . '@sm';
      }
      
      $classes[] = 'padding-x-' . $this->padding['horizontal'];
      $classes[] = 'padding-y-' . $this->padding['vertical'];
      $classes[] = 'text-' . $this->content_alignment['horizontal'];
      
      if ( !empty( $this->border_radius ) ) {
        $classes[] = 'radius-' . $this->border_radius;
      }
      
      return implode(' ', $classes);
    }
    
    protected function getColumnStyles() {
      $styles = [];
      
      if ( !empty( $this->bg_color_rgba ) ) {
        $styles[] = 'background-color: ' . $this->bg_color_rgba;
      }
      
      if ( !empty( $this->box_shadow ) ) {
        $styles[] = 'box-shadow: 2px 2px 4px rgba(0,0,0,0.16)';
      }
      
      if ($this->content_alignment['vertical'] == "top")    $styles[] = "align-self: flex-start";
      if ($this->content_alignment['vertical'] == "middle") $styles[] = "align-self: center";
      if ($this->content_alignment['vertical'] == "bottom") $styles[] = "align-self: flex-end";
      
      return implode('; ', $styles);
    }
    
    protected function getStructuredJson() {
      return false;
    }
    
    abstract protected function renderContent();
}