<?php
 
/*
 * TO DO
 *
 * Toggleable column type:
 * - WYSIWYG
 * - Image(s) w/ Styling and Overlap Options
 * - Image Cluster w/ Hover Cards
 * - Carousel
 * - Logo List
 * - Step Blocks
 *
 * Full viewport / Partial viewport options
 * Zero grid gap option
 * Container bg settings
 * Padding on columns
 */
    
class StaffBlock extends Block {
    public $staffLayout;
    public $staffProfile;
    
    public function __construct($row, $block_count = null) {
      /*
       * Make sure we call the parent constructor
       * to initialize all section-level options.
       */
      parent::__construct($row);
      $this->staffLayout = $this->row['layout_options'];
      $this->staffProfile = $this->row['profile_options'];
      $this->staffOverlay = $this->row['color_options'];
      $this->learnMore = $this->row['learn_more'];
      $this->staff = $this->row['column']['staff_selector'];
      $this->staffContent = $this->row['column']['content'];
      $this->staffFeature = $this->row['column']['featured_staff'];
      $this->contentSide = $this->row['column']['content_side'];
      // $this->staffId = $this->row['column']['staff_selector']->ID();
      // $this->staffLayout = $this->row['style'];
      // $this->testimonials = $this->row[$this->testimonialLayout];
    }
    
    /*
     * This method is called by the parent's render()
     * method and should never be called directly. Use
     * it to define output for the inner content
     * containers of the child class for each block type.
     */
    protected function renderContent() {
      
      if ($this->staffLayout == 'column') {
        include( TEMPLATEPATH . '/acf-layouts/sub-layouts/staff--standard.php' ) ;
      }

      if ($this->staffLayout == 'featured') {
        include( TEMPLATEPATH . '/acf-layouts/sub-layouts/staff--featured.php' ) ;
      }

      if ($this->staffLayout == 'stacked') {
        include( TEMPLATEPATH . '/acf-layouts/sub-layouts/staff--stacked.php' ) ;
      }
      
    } 
}