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
    
class CtasBlock extends Block {
    public $ctaLayout;
    
    public function __construct($row, $block_count = null) {
      /*
       * Make sure we call the parent constructor
       * to initialize all section-level options.
       */
      parent::__construct($row);
      $this->ctaLayout = $this->row['layout_options'];
      $this->ctaRepeater = $this->row['call_to_actions'];
      $this->ctaImageStyle = $this->row['image_cta_styles'];
      $this->ctaContentContainer = $this->row['content_container_design_options']['content_container_width'];

      if(isset($this->row['icon_cta_layout'])) {
        $this->ctaIconLayout = $this->row['icon_cta_layout'];
      }

      if(isset( $this->row['icon_cta_styles'])) {
        $this->ctaIconStyle = $this->row['icon_cta_styles'];
      }
    }
    
    /*
     * This method is called by the parent's render()
     * method and should never be called directly. Use
     * it to define output for the inner content
     * containers of the child class for each block type.
     */
    protected function renderContent() {
    
      if ( $this->ctaLayout == 'image' ) {
        include( TEMPLATEPATH . '/acf-layouts/sub-layouts/ctas-image.php' ) ;
      } 

      if ( $this->ctaLayout == 'icon' && $this->ctaIconLayout == 'stacked' ) {
        include( TEMPLATEPATH . '/acf-layouts/sub-layouts/ctas-icon--stacked.php' ) ;
      } 

      if ( $this->ctaLayout == 'icon' && $this->ctaIconLayout == 'left' ) {
        include( TEMPLATEPATH . '/acf-layouts/sub-layouts/ctas-icon--left.php' ) ;
      } 

      if ( $this->ctaLayout == 'icon' && $this->ctaIconLayout == 'inline' ) {
        include( TEMPLATEPATH . '/acf-layouts/sub-layouts/ctas-icon--inline.php' ) ;
      } 
      if ( $this->ctaLayout == 'inline') {
        $ctaPadding = ($this->ctaContentContainer == 'full') ? 'padding-xl' : '';
        $ctaBg = ($this->ctaContentContainer == 'full') ? 'bg-' : '';
        // $ctaIconStyle = ($this->ctaIconStyle == 'light') ? 'light' : 'dark';
        
        foreach ( $this->ctaRepeater as $cta ) {
          $image = $cta['image']['sizes']['cta-image'];
          $alt = $cta['image']['alt'];
          $width = $cta['image']['sizes']['cta-image-width'];
          $height = $cta['image']['sizes']['cta-image-height'];
          $content = $cta['cta_content'];
          $bgColor = $cta['color_options'];
          $link = $cta['cta_link'];
          echo '<a href="'.$link.'" class="card__inline link__block col-4@md col-12 bg-'.$bgColor.'">';
          echo '<div class="card">';
          echo '<div class="card__inner--inline flex flex-center padding-xl">';
          echo $content;
          echo '</div>'; // CTA Innter
          echo '</div>'; // CTA
          echo '</a>'; // Grid
        }
      } 
    } 
}