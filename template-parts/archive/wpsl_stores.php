<?php

if ( have_rows( 'title_design_options', 'location-options' ) ) :
  while ( have_rows( 'title_design_options', 'location-options' ) ) : the_row();
    $title_bg = get_sub_field( 'color_options' );
    $title_text_color = get_sub_field( 'text_color' );
  endwhile;
endif; 

?>

<div class="location__overview">
  <div class="container max-width-adaptive-lg padding-top-xl">
    <div class="location__overview-intro text-component">
      <?php the_field( 'intro_paragraph', 'location-options' ); ?>
    </div>
  </div>

  <div class="container max-width-lg padding-bottom-xl">
    <?php echo do_shortcode('[wpsl]'); ?>
    <?php
      add_filter( 'wpsl_listing_template', 'custom_listing_template' );

      function custom_listing_template() {
      
        global $wpsl, $wpsl_settings;
        
        $listing_template = '<li data-store-id="<%= id %>">' . "\r\n";
        $listing_template .= "\t\t" . '<div class="wpsl-store-location" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">' . "\r\n";
        $listing_template .= "\t\t\t" . '<% if ( thumb ) { %>' . "\r\n";
        $listing_template .= "\t\t\t" . '<div class="wpsl-store-image"><a href="<%= permalink %>"><%= thumb %></a></div>' . "\r\n";
        $listing_template .= "\t\t\t" . '<% } %>' . "\r\n";
        $listing_template .= "\t\t\t\t" . '<div class="wp-store-details-container">' . "\r\n"; 
        $listing_template .= "\t\t\t\t" . '<h3 class="margin-bottom-xs">' . wpsl_store_header_template( 'listing' ) . '</h3>' . "\r\n"; // Check which header format we use
        $listing_template .= "\t\t\t\t" . '<p class="location__address location__detail-item"><span class="wpsl-street" itemprop="streetAddress"><%= address %></span>' . "\r\n";
        $listing_template .= "\t\t\t\t" . '<% if ( address2 ) { %>' . "\r\n";
        $listing_template .= "\t\t\t\t" . '<span class="wpsl-street"><%= address2 %>, </span>' . "\r\n";
        $listing_template .= "\t\t\t\t" . '<% } %>' . "\r\n";
        $listing_template .= "\t\t\t\t" . '<span itemprop="addressLocality"><%= city %></span>, <span itemprop="addressRegion"><%= state %></span> <span itemprop="postalCode"><%= zip %></span>' . "\r\n"; // Use the correct address format
        $listing_template .= "\t\t\t\t" . '<br><a href="https://www.google.com/maps/place/<%= address %>+<%= city %>+<%= state %>+<%= zip %>" class="btn--link btn--icon-arrow text-sm" target="_blank">Get Directions</a></p>' . "\r\n"; // Use the correct address format
    
    
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
    
        $listing_template .= "\t\t\t" . wpsl_more_info_template() . "\r\n"; // Check if we need to show the 'More Info' link and info
        // $listing_template .= "\t\t" . '</div>' . "\r\n";
        $listing_template .= "\t\t" . '<div class="wpsl-direction-wrap margin-top-md">' . "\r\n";
    
        if ( !$wpsl_settings['hide_distance'] ) {
            $listing_template .= "\t\t\t" . '<%= distance %> ' . esc_html( $wpsl_settings['distance_unit'] ) . '' . "\r\n";
        }
    
        $listing_template .= "\t\t\t" . '<a href="<%= permalink %>" class="btn btn--primary btn--sm">Contact Clinic</a>' . "\r\n"; 
      
        // $listing_template .= "\t\t\t" . '<%= createDirectionUrl() %>' . "\r\n"; 
        $listing_template .= "\t\t" . '</div>' . "\r\n";
        $listing_template .= "\t\t" . '</div>' . "\r\n";
        $listing_template .= "\t" . '</li>';
    
        return $listing_template;
      }
    ?>  
  </div>

</div>
