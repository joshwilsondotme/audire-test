<?php

    
class LocationBlock extends Block {
    public $locationLayout;
    public $locations;
    
    public function __construct($row, $block_count = null) {
      /*
       * Make sure we call the parent constructor
       * to initialize all section-level options.
       */
      parent::__construct($row);

      // $this->locationLayout = $this->row['style'];
      // $this->locations = $this->row[$this->locationLayout];
     
    }
    
    /*
     * This method is called by the parent's render()
     * method and should never be called directly. Use
     * it to define output for the inner content
     * containers of the child class for each block type.
     */
    protected function renderContent() {
      $singleLayoutStyle = $this->row['single_location']['single_location_layouts'];
      $multipleLayoutStyle = $this->row['multiple_locations']['styles'];
      // Confined
      if ($this->locationLayout = $this->row['layout_options'] == 'single') {
        // Confined
        include (TEMPLATEPATH . '/acf-layouts/sub-layouts/location-single--confined.php');

        // Full-Width
        include (TEMPLATEPATH . '/acf-layouts/sub-layouts/location-single--full-width.php');

        // Featured Content
        include (TEMPLATEPATH . '/acf-layouts/sub-layouts/location-single--featured.php');
      }

      
      if ($this->locationLayout = $this->row['layout_options'] == 'multiple') {
        
        $locationSelector = $this->row['multiple_locations']['location_selector'];
        $locationContent = $this->row['multiple_locations']['location_content'];

        if ($multipleLayoutStyle == 'standard' ) {
          include (TEMPLATEPATH . '/acf-layouts/sub-layouts/location-multiple--standard.php');  
        }

        if($multipleLayoutStyle == 'featured') {
          include (TEMPLATEPATH . '/acf-layouts/sub-layouts/location-multiple--featured.php');  
        }

        if($multipleLayoutStyle == 'full') {
          include (TEMPLATEPATH . '/acf-layouts/sub-layouts/location-multiple--full-stacked.php');  
        }

        if($multipleLayoutStyle == 'split') {
          echo do_shortcode('[wpsl template="mutliple-split"]');

          add_filter('wpsl_listing_template', 'split_listings');
          
          function split_listings() {
            global $wpsl, $wpsl_settings;

            $listing_template = '<li data-store-id="<%= id %>">' . "\r\n";
            $listing_template .= "\t\t" . '<div class="wpsl-store-location" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">' . "\r\n";
            $listing_template .= "\t\t\t\t" . '<div class="wp-store-details-container">' . "\r\n"; 
            $listing_template .= "\t\t\t\t" . '<h3 class="margin-bottom-xs">' . wpsl_store_header_template( 'listing' ) . '</h3>' . "\r\n"; // Check which header format we use
            $listing_template .= "\t\t\t\t" . '<p class="location__address location__detail-item"><span class="wpsl-street" itemprop="streetAddress"><%= address %></span><br/>' . "\r\n";
            $listing_template .= "\t\t\t\t" . '<% if ( address2 ) { %>' . "\r\n";
            $listing_template .= "\t\t\t\t" . '<span class="wpsl-street"><%= address2 %></span><br/>' . "\r\n";
            $listing_template .= "\t\t\t\t" . '<% } %>' . "\r\n";
            $listing_template .= "\t\t\t\t" . '<span itemprop="addressLocality"><%= city %></span>, <span itemprop="addressRegion"><%= state %></span> <span itemprop="postalCode"><%= zip %></span></p>' . "\r\n"; // Use the correct address format
            

            if ( !$wpsl_settings['hide_country'] ) {
                $listing_template .= "\t\t\t\t" . '<span class="wpsl-country"><%= country %></span>' . "\r\n";
            }

            // Show the phone, fax or email data if they exist.
            if ( $wpsl_settings['show_contact_details'] ) {
                $listing_template .= "\t\t\t" . '<div class="wpsl-contact-details">' . "\r\n";
                $listing_template .= "\t\t\t" . '<% if ( phone ) { %>' . "\r\n";
                $listing_template .= "\t\t\t" . '<p class="location__phone location__detail-item" itemprop="telephone"><strong><%= formatPhoneNumber( phone ) %></strong></p>' . "\r\n";
                $listing_template .= "\t\t\t" . '<% } %>' . "\r\n";
                $listing_template .= "\t\t\t" . '</div>' . "\r\n";
            }
            $listing_template .= "\t\t\t\t" . '<a href="https://www.google.com/maps/place/<%= address %>+<%= city %>+<%= state %>+<%= zip %>" class="btn btn--primary margin-top-md" target="_blank">Get Directions</a></p>' . "\r\n"; 
            $listing_template .= "\t\t\t" . wpsl_more_info_template() . "\r\n"; // Check if we need to show the 'More Info' link and info
            // $listing_template .= "\t\t" . '</div>' . "\r\n";
            $listing_template .= "\t\t" . '<div class="wpsl-direction-wrap">' . "\r\n";
            
            if ( !$wpsl_settings['hide_distance'] ) {
                $listing_template .= "\t\t\t" . '<%= distance %> ' . esc_html( $wpsl_settings['distance_unit'] ) . '' . "\r\n";
            }

            // $listing_template .= "\t\t\t" . '<%= createDirectionUrl() %>' . "\r\n"; 
            $listing_template .= "\t\t" . '</div>' . "\r\n";
            $listing_template .= "\t\t" . '</div>' . "\r\n";
            $listing_template .= "\t" . '</li>';

            return $listing_template;
          }
          
        }
      }
      
    } 
}