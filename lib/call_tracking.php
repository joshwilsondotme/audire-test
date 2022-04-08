<?php
    
/**
 * WP Settings Field
 */
add_action( 'admin_init', 'wad_register_calltracking' );

function wad_register_calltracking() {
    
  register_setting('general',
    'wad_enable-calltracking',
    array( 'type' => 'boolean' )
  );
  
  add_settings_field( 'wad_enable-calltracking',
    'Enable Call Tracking',
    'wad_enable_calltracking',
    'general',
    'default',
    array( 'label_for' => 'wad_enable-calltracking' )
  );
  
}

function wad_enable_calltracking( $args ) {
    $html  = '<input type="checkbox" id="' . $args['label_for'] . '" name="wad_enable-calltracking" value="1"' . checked( 1, get_option( 'wad_enable-calltracking' ), false ) . '/>';
    $html .= '<label for="' . $args['label_for'] . '">Activate server side call tracking replacement for this site.</label>';
    
    echo $html;
}

add_action( 'admin_init', 'wad_register_calltracking_debug' );

function wad_register_calltracking_debug() {
    
  register_setting('general',
    'wad_debug-calltracking',
    array( 'type' => 'boolean' )
  );
  
  add_settings_field( 'wad_debug-calltracking',
    'Call Tracking Debugging',
    'wad_debug_calltracking',
    'general',
    'default',
    array( 'label_for' => 'wad_debug-calltracking' )
  );
  
}

function wad_debug_calltracking( $args ) {
    $html  = '<input type="checkbox" id="' . $args['label_for'] . '" name="wad_debug-calltracking" value="1"' . checked( 1, get_option( 'wad_debug-calltracking' ), false ) . '/>';
    $html .= '<label for="' . $args['label_for'] . '">Enable call tracking debug mode.</label>';
    
    echo $html;
}

/**
 * Fetch Call Tracking Data from ADIP
 */
function wad_return_calltracking_number() {
    $calltracking_number = [];

    if ( get_option( 'wad_enable-calltracking', true ) ) {
      $calltracking_number = CallTracking::getTrackingNumbers();
    }
    
    return $calltracking_number;
}


/**
 * Pattern Match Search and Replace
 */
function wad_calltracking_replace($trackingData, $content) {
    foreach ($trackingData as $trackingValue) {
        $content = preg_replace('/'.$trackingValue['target_no_reg'].'/', $trackingValue['tracking_no'], $content);
    }
    
    return $content;
}

/**
 * Additional function for stripping prefixes from WPSL Phone Numbers
 */
function wad_strip_wpsl_prefixes($content) {
  $content = str_replace('>: <', '><', $content);
  
  return $content;
}

/**
 * Additional function for linking out location data
 */
function wad_link_location_details($id, $content) {
  $content = preg_replace(
    '/<div class="wpsl-location-address">(.*?)<\/div>/',
    '<div class="wpsl-location-address"><a href="' . get_permalink($id) . '">$1</a></div>',
    $content
  );

  return $content;
}

/*
 * WPSL Filter
 */
add_filter( 'wpsl_store_data', 'wpsl_calltracking_filter' );

function wpsl_calltracking_filter( $store_data ) {
    $trackingData = wad_return_calltracking_number();
    foreach ( $store_data as $k => $store ) {
        $store_data[$k]['phone'] = wad_calltracking_replace($trackingData, $store['phone']);
    }

    return $store_data;
}

/**
 * Overload WPSL Shortcodes
 */
function wpsl_call_tracking_shortcodes() {

    function wpsl_address_call_tracking($atts) {
        $response     = $GLOBALS['wpsl']->frontend->show_store_address($atts);
        $trackingData = wad_return_calltracking_number();
        
        // Perform call tracking replacement, and strip unnecessary formatting
        $response = wad_strip_wpsl_prefixes(wad_calltracking_replace($trackingData, $response));
        
        // Link out location details
        $response = wad_link_location_details($atts['id'], $response);
        
        return $response;
    }

    remove_shortcode('wpsl_address');
    add_shortcode('wpsl_address', 'wpsl_address_call_tracking');
}
add_action('wp_loaded', 'wpsl_call_tracking_shortcodes');

/**
 * Default Phone Shortcode
 */
function wad_phone_shortcode($atts) {
    // Assign default values and extract
    extract(shortcode_atts(array(
        'number'    => '',
        'link'      => true,
        'tracking'  => true,
        'class'     => '',
    ), $atts));
    
    if ( empty($number) ) return;
    
    $response = ( !empty($link) && $link !== "false" )
        ? '<a href="tel:' . $number . '" class="' . $class . '">' . $number . '</a>'
        : '<span class="' . $class . '">' . $number . '</span>';

    if ( !empty($tracking) && $tracking !== "false" ) {
        $trackingData = wad_return_calltracking_number();
        $response = wad_calltracking_replace($trackingData, $response);
    }
    
    return $response;
}
add_shortcode('phone', 'wad_phone_shortcode');


/*
 * Custom Content Filter Function
 */
 function wad_get_content_with_replacement() {
    $trackingData = wad_return_calltracking_number();
    $content      = wad_calltracking_replace($trackingData, get_the_content());
                  
    return apply_filters('the_content', $content);
 }
 
 function wad_the_content_with_replacement() {
    echo wad_get_content_with_replacement();
 }
 
 
/*
 * Call Tracking Singleton Class
 */
class CallTracking {
    protected static $instance = null;
    
    protected $debug = false;
    protected $calltracking_data = [];
    
    protected function __construct() {
      global $wpdb;
      
      $blog_id = get_current_blog_id();
      $calltracking_number = [];
      
      if( !empty($blog_id) ) {
        $sqlQuery = "SELECT ad_calltracking.target_no,ad_calltracking.tracking_no
            FROM ad_calltracking left join ad_site
            ON ad_calltracking.site_id = ad_site.id
            WHERE ad_site.wp_site_id = $blog_id
            AND ad_calltracking.ad_source like 'website'
            AND ad_calltracking.is_replacement_not_required = 0";
        $rows = $wpdb->get_results( $sqlQuery );
        $find = array('(',')',' ','-','.','_');
        
        foreach ($rows as $key => $rowValue){
          $callsource_find = str_replace($find,'',$rowValue->target_no);
          $callsource_array = str_split($callsource_find);
          $callsource_format = implode('[() -\.]*',$callsource_array);
          $callsource_format = '[()-\.]*'.$callsource_format;

          $calltracking_number[$key]['target_no'] = $rowValue->target_no;
          $calltracking_number[$key]['target_no_reg'] = $callsource_format;
          $calltracking_number[$key]['tracking_no'] = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $rowValue->tracking_no);
        }
      }
      
      if ( get_option( 'wad_debug-calltracking', false ) && is_super_admin()) {
        $this->debug = true;
        
        echo '<pre>' . print_r($calltracking_number, true) . '</pre>';
      }
      
      $this->calltracking_data = $calltracking_number;
    }

    public static function getTrackingNumbers() {
      if (is_null(self::$instance)) {
        self::$instance = new CallTracking();
      }
      
      if ( self::$instance->debug ) {
        echo '<pre>Pulling tracking data from singleton class.</pre>';
      }
      
      return self::$instance->calltracking_data;
    }
}