<?php

abstract class Block {
    
    // Static Variables
    protected static $block_count = 0;
    protected static $block_ids = array();

    // Instance Variables
    protected $row;
    protected $id;
    
    // Section Variables
    public $section_style;
    public $section_split_image;
    public $section_contained_width;
    public $section_height;
    public $section_overlap;
    public $section_padding;
    public $grid_gap;

    public $bg_color_name;
    public $bg_color_custom;
    public $bg_image;
    public $bg_image_x_pos;
    public $bg_image_y_pos;
    
    // Overlay Variables
    public $bg_image_overlay_style;
    public $bg_image_overlay_primary;
    public $bg_image_overlay_secondary;
    public $bg_image_overlay_angle;
    public $bg_image_filters;
    
    // Content Wrapper Variables
    public $content_align;
    public $content_column_valign;
    public $content_column_halign;
    public $content_padding;
    public $content_margin;
    public $content_bg_color;
    
    // Container Variables
    public $container_width;
    
    public function __construct($row, $block_count = null) {
      $this->row = $row;
      $this->id  = $this->getSectionId();
  
      // Section Level Options
      if ( !empty( $sectionOptions = $this->row['section_design_options'] ) ) {
        $this->section_style           = $sectionOptions['layout_style'];
        $this->section_split_image     = $sectionOptions['split_content_image_alignment'];
        $this->section_contained_width = $sectionOptions['contained_content_width'];
        
        $this->bg_color_name   = ( !empty( $sectionOptions['background_color']['color_options'] ) ) ? $sectionOptions['background_color']['color_options'] : '';
        $this->bg_color_custom = ( !empty( $sectionOptions['background_color']['custom_color'] ) ) ? $sectionOptions['background_color']['custom_color'] : '';
        
        if ( !empty( $bgImageOptions = $sectionOptions['background_image'] ) ) {
          $this->bg_image       = $bgImageOptions['image']['url'];
          $this->bg_image_x_pos = $bgImageOptions['x_position'];
          $this->bg_image_y_pos = $bgImageOptions['y_position'];
        
          if ( (bool)$bgImageOptions['overlay_selector'] ) {
            $this->bg_image_overlay_style = $bgImageOptions['overlay']['overlay_style'];
            
            // Primary Color
            $overlay_array = explode('-', $bgImageOptions['overlay']['color_options']);
            $this->bg_image_overlay_primary = hex2rgba($GLOBALS['themeColors'][$overlay_array[0]][$overlay_array[1]], $bgImageOptions['overlay']['opacity'] / 100);
            
            // var_dump($GLOBALS['themeColors']);
            
            // Gradient Settings
            if ($this->bg_image_overlay_style == "gradient") {
              $overlay_array_2 = explode('-', $bgImageOptions['overlay']['color_options_2']);
              $this->bg_image_overlay_secondary = hex2rgba($GLOBALS['themeColors'][$overlay_array_2[0]][$overlay_array_2[1]], $bgImageOptions['overlay']['opacity_2'] / 100);
              
              $this->bg_image_overlay_angle = $bgImageOptions['overlay']['angle'];
            }
          }
        
          if ( (bool)$bgImageOptions['filter_selector'] ) {
            $this->bg_image_filters = $bgImageOptions['filter'];
          }
        }
        
        $this->section_height  = $sectionOptions['section_height'];
        $this->section_overlap = $sectionOptions['section_overlap'];
        $this->section_padding = $sectionOptions['padding'];
        $this->grid_gap        = $sectionOptions['grid_gap'];
      }
      
      // Content Container Options
      if ( !empty( $containerOptions = $this->row['content_container_design_options'] ) ) {
        $this->content_align          = $containerOptions['content_alignment'];
        $this->content_column_valign  = $containerOptions['content_column_valign'];
        $this->content_column_halign  = $containerOptions['content_column_halign'];
        $this->container_width        = $containerOptions['content_container_width'];
        $this->content_padding        = $containerOptions['padding'];
        $this->content_margin         = $containerOptions['margin'];
        
        if ( !empty($containerOptions['background_color']['custom_color']) ) {
          $containerBg = $containerOptions['background_color']['custom_color'];
        }
        
        elseif ( !empty($containerOptions['background_color']['color_options']) ) {
          $containerBg_array = explode('-', $containerOptions['background_color']['color_options']);
          $containerBg       = $GLOBALS['themeColors'][$containerBg_array[0]][$containerBg_array[1]];
        }
        
        if ( !empty($containerBg) && $containerOptions['background_color']['opacity'] > 0 ) {
          $this->content_bg_color = hex2rgba($containerBg, $containerOptions['background_color']['opacity'] / 100);
        }
      }
    }
    
    public function render() {
      self::$block_count++;
      
      echo '<section data-id="' . self::$block_count . '" id="section-' . $this->id . '" class="block-builder block-builder__'.$this->row['acf_fc_layout'].' ' . $this->getSectionClasses() . '" style="' . $this->getSectionStyles() . '">';
      
      if ( !empty( $this->section_style )) {
        call_user_func(array($this, 'render' . ucfirst($this->section_style)));
      }
      
      echo '</section>';
    }
    
    /*
     * Randomly generated 6 character hex string
     * used to dynamically assign IDs to sections
     */
    protected function getSectionId() {
      /*
      do {
        $hash = bin2hex(random_bytes(3));
      } while ( in_array($hash, self::$block_ids) );
      
      self::$block_ids[] = $hash;
      return $hash;
      */

      return $this->row['section_design_options']['layout_id'];
    }
    
    /*
     * Specific layout based render functions
     */
    protected function renderFull() {
      echo '<div class="section-bg-overlay flex width-100 justify-center ' . $this->getOverlayClasses() . '" style="' . $this->getOverlayStyles() . '">
          <div class="container-wrapper ' . $this->getContentWrapperClasses() . '" style="' . $this->getContentWrapperStyles() . '">
            <div class="container max-width-' . $this->container_width . '">
              <div class="grid ' . $this->getGridClasses() . '">';
      
              $this->renderContent();
      
      echo '
              </div>
            </div>
          </div>
        </div>';
    }
    
    protected function renderContained() {
      echo '<div class="section-inner-wrap flex ' . $this->getInnerWrapClasses() . '" style="' . $this->getInnerWrapStyles() . '">
        <div class="section-bg-overlay flex width-100 justify-center ' . $this->getOverlayClasses() . '" style="' . $this->getOverlayStyles() . '">
          <div class="container-wrapper ' . $this->getContentWrapperClasses() . '" style="' . $this->getContentWrapperStyles() . '">
            <div class="container max-width-' . $this->container_width . '">
              <div class="grid ' . $this->getGridClasses() . '">';
      
              $this->renderContent();
      
      echo '
              </div>
            </div>
          </div>
        </div>
        </div>';
    }
    
    protected function renderSplit() {
      $sides = ['left', 'right'];
      foreach($sides as $side) {
        if ( $side == $this->section_split_image ) {
          echo '<div class="section-split-' . $side . ' section-split-image">';
          $this->renderSplitImage();
          echo '</div>';
        } else {
          echo '<div class="section-split-' . $side . ' section-split-content">';
          $this->renderSplitContent();
          echo '</div>';
        }
      }
    }
    
    protected function renderSplitImage() {
      echo '<div class="section-inner-wrap flex width-100 ' . $this->getInnerWrapClasses() . '" style="' . $this->getInnerWrapStyles() . '">
        <div class="section-bg-overlay flex width-100 ' . $this->getOverlayClasses() . '" style="' . $this->getOverlayStyles() . '">
        </div>
      </div>';
    }
    
    protected function renderSplitContent() {
      echo '<div class="container-wrapper ' . $this->getContentWrapperClasses() . '" style="' . $this->getContentWrapperStyles() . '">
        <div class="container max-width-' . $this->container_width . '">
          <div class="grid ' . $this->getGridClasses() . '">';
      
            $this->renderContent();
      
      echo '
          </div>
        </div>
      </div>';
    }
    
    /*
     * Section level styling
     *   - Height
     *   - Negative Margins
     *   - Background Color
     *   - Background Image (Full Viewport only)
     *   - Section Padding (Full Viewport only)
     */
    protected function getSectionClasses() {
      $classes = [];
      
      if ( empty($this->bg_color_custom) ) {
        $classes[] = 'bg-' . $this->bg_color_name;
      }
      
      // if ( $this->section_style == 'full' || $this->section_style == 'contained' ) {
        $classes[] = 'padding-top-' . $this->section_padding['top'];
        $classes[] = 'padding-bottom-' . $this->section_padding['bottom'];
      // }
      
      return implode(' ', $classes);
    }
    
    protected function getSectionStyles() {
      $styles = [];
      
      if ( !empty($this->bg_color_custom) ) {
        $styles[] = 'background-color: ' . $this->bg_color_custom;
      }
      
      if ( $this->section_style == 'full' ) {
        if ( !empty($this->bg_image) ) {
          $styles[] = 'background-image: url(' . $this->bg_image . ')';
          $styles[] = 'background-size: cover';
          $styles[] = 'background-position: ' . $this->bg_image_x_pos . ' ' . $this->bg_image_y_pos;
        }
      
        if ( $this->bg_image_overlay_style == "solid" ) {
          $styles[] = 'box-shadow: inset 0 0 0 50vw ' . $this->bg_image_overlay_primary;
        }
      }
      
      if ( (bool)$this->section_height['custom_height'] == true) {
        $styles[] = 'height: ' . $this->section_height['height_px'];
        $styles[] = 'min-height: ' . $this->section_height['height_px'];
      }
      
      if ( !empty($this->section_overlap) ) {
        $styles[] = 'margin-top: calc(-1 * var(--space-' . $this->section_overlap . '))';
      }
      
      return implode('; ', $styles);
    }
    
    /*
     * Inner wrap styling
     * This element is only used for contained content blocks.
     *   - Contained Content Width
     *   - Background Image (Contained only)
     */
    protected function getInnerWrapClasses() {
      $classes = [];
      
      if ( $this->section_style == 'contained' ) {
        $classes[] = 'max-width-' . $this->section_contained_width;
      }
      
      return implode(' ', $classes);
    }
    
    protected function getInnerWrapStyles() {
      $styles = [];

      if ( $this->section_style == 'contained' || $this->section_style == 'split' ) {
        if ( !empty($this->bg_image) ) {
          $styles[] = 'background-image: url(' . $this->bg_image . ')';
          $styles[] = 'background-size: cover';
          $styles[] = 'background-position: ' . $this->bg_image_x_pos . ' ' . $this->bg_image_y_pos;
        }
      
        if ( $this->bg_image_overlay_style == "solid" ) {
          $styles[] = 'box-shadow: inset 0 0 0 50vw ' . $this->bg_image_overlay_primary;
        }
      }
      
      return implode('; ', $styles);
    }
    
    /*
     * Overlay styling
     *   - Background Image Overlay & Filters
     *   - Content Alignment
     */
    protected function getOverlayClasses() {
      $classes = [];
      
      return implode(' ', $classes);
    }
    
    protected function getOverlayStyles() {
      $styles = [];
      
      if ( $this->bg_image_overlay_style == "gradient" ) {
        $styles[] = 'background-image: linear-gradient(' . $this->bg_image_overlay_angle . 'deg, ' . $this->bg_image_overlay_primary . ' 0%, ' . $this->bg_image_overlay_secondary . ' 100%)';
      }
      
      if ( !empty( $this->bg_image_filters ) ) {
        $filter   = 'backdrop-filter:';
    
        if ( !empty( $this->bg_image_filters['blur'] ) )      $filter .= ' blur(5px)';
        if ( !empty( $this->bg_image_filters['grayscale'] ) ) $filter .= ' grayscale(1)';
      
        $styles[] = $filter;
      }
      
      // Alignment for child element goes here
      if ($this->content_align['horizontal'] == "right")  $styles[] = "justify-content: flex-end";
      if ($this->content_align['horizontal'] == "center") $styles[] = "justify-content: center";
      
      return implode('; ', $styles);
    }
    
    /*
     * Content wrapper styling
     *   - Content Padding
     *   - Content Margin
     *   - Content Stretch
     *   - Vertical Align
     *   - Background Color
     */
    protected function getContentWrapperClasses() {
      $classes = [];
      
      $classes[] = 'width-100';
      $classes[] = 'max-width-' . $this->container_width;
      
      $classes[] = 'padding-top-' . $this->content_padding['top'];
      $classes[] = 'padding-bottom-' . $this->content_padding['bottom'];
      $classes[] = 'margin-top-' . $this->content_margin['top'];
      $classes[] = 'margin-bottom-' . $this->content_margin['bottom'];
      
      if ( $this->content_align['horizontal'] == "full") {
        $classes[] = 'max-width-full';
      }
      
      return implode(' ', $classes);
    }
    
    protected function getContentWrapperStyles() {
      $styles = [];
      
      if ( !empty($this->content_bg_color) ) {
        $styles[] = 'background-color: ' . $this->content_bg_color;
      }
      
      if ($this->content_align['vertical'] == "top")    $styles[] = "align-self: flex-start";
      if ($this->content_align['vertical'] == "middle") $styles[] = "align-self: center";
      if ($this->content_align['vertical'] == "bottom") $styles[] = "align-self: flex-end";
      
      return implode('; ', $styles);
    }
    
    /*
     * Grid level styling
     *  - Grid max width
     *  - Content Alignment
     */
    protected function getGridClasses() {
      $classes = [];
      
      if ($this->grid_gap !== 'none') {
        $classes[] = 'grid-gap-x-' . $this->grid_gap;
      }
      
      if ( (bool)$this->content_column_valign ) {
        $classes[] = 'items-center';
      }

      if ( (bool)$this->content_column_halign ) {
        $classes[] = 'justify-center';
      }
      
      return implode(' ', $classes);
    }
    
    /*
     * Child render function
     */
    abstract protected function renderContent();
}