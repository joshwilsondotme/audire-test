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
    
class TestimonialBlock extends Block {
    public $testimonialLayout;
    public $testimonials;
    
    public function __construct($row, $block_count = null) {
      /*
       * Make sure we call the parent constructor
       * to initialize all section-level options.
       */
      parent::__construct($row);

      $this->testimonialLayout = $this->row['style'];
      // $this->testimonials = $this->row[$this->testimonialLayout];
     
    }
    
    /*
     * This method is called by the parent's render()
     * method and should never be called directly. Use
     * it to define output for the inner content
     * containers of the child class for each block type.
     */
    protected function renderContent() {
    $highlight = '';
      // Standard
      if ($this->testimonialLayout = $this->row['style'] == 'standard') {
        $count = count($this->row['standard']);
      
        if( $count <= 2) {
          include( TEMPLATEPATH . '/acf-layouts/sub-layouts/testimonials-standard.php' ) ;
        } else {
          wp_enqueue_script("carousel", get_template_directory_uri()."/dist/assets/js/carousel.js", ['swiper-js'], false, true );

          wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], false, true );
          echo '<div class="col-6@md col-12">';
          
          echo '<div class="swiper-container carousel--testimonial margin-bottom-0"><div class="swiper-wrapper">';

          include( TEMPLATEPATH . '/acf-layouts/sub-layouts/testimonials-standard.php' ) ;
          
          echo '</div></div>';
          echo '<div class="navigation-inline"><div class="swiper-navigation"><div class="swiper-button-prev"></div><div class="swiper-pagination swiper-pagination--testimonials"></div><div class="swiper-button-next"></div></div></div>';
          echo '</div>';
        }
      }

      // 2 Column with Slider
      if ($this->testimonialLayout = $this->row['style'] == '2-column') {
        include( TEMPLATEPATH . '/acf-layouts/sub-layouts/testimonials-two_column.php' ) ;
      }
      
      // Static 2 Column
      if ($this->testimonialLayout = $this->row['style'] == 'featured') {
        include( TEMPLATEPATH . '/acf-layouts/sub-layouts/testimonials-single_featured.php' ) ;
      }
      
      if($this->testimonialLayout = $this->row['style'] == 'highlight') {
        include( TEMPLATEPATH . '/acf-layouts/sub-layouts/testimonials-highlight.php' ) ;
      }
    } 
}