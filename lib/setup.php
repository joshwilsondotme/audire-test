<?php function add_scripts() {

  if(!is_admin()) {
    wp_deregister_script("jquery");
    wp_register_script("jquery", "https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js", false, '1.12.4', false);
    wp_enqueue_script("jquery");

    // wp_enqueue_script("font-awesome", get_template_directory_uri()."/dist/assets/js/font-awesome.js", [], false, true );
    wp_enqueue_script("mediacheck-js", get_template_directory_uri()."/dist/assets/js/media-check.js", [], false, true );
    wp_enqueue_script("modernizr", get_template_directory_uri()."/dist/assets/js/modernizr-custom.js", [], false, true );
    wp_enqueue_script("lazyloading", "//cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js", null, false, true);
    wp_enqueue_script("font-awesome-cdn", "//kit.fontawesome.com/7e43a03e31.js", null, false, false);
    wp_enqueue_script("nav-js", get_template_directory_uri()."/dist/assets/js/navigation.js", ['mediacheck-js'], false, true );

    wp_enqueue_script("main-site", get_template_directory_uri()."/dist/assets/js/main.js", [], false, true);

    wp_enqueue_script("text-sizer", get_template_directory_uri()."/dist/assets/js/text-resizer.js", [], false, true);
  }

  //load for admin and frontend
  if (defined('GOOGLE_MAPS_API_KEY')) {
    wp_enqueue_script('google-maps-api',  'https://maps.googleapis.com/maps/api/js?v=3&key='.GOOGLE_MAPS_API_KEY, null, false, true);
  }

}
add_action('wp_enqueue_scripts', 'add_scripts');

add_action( 'wp_enqueue_scripts', 'theme_deregister_styles', 11 );
function theme_deregister_styles() {
    wp_dequeue_style( 'cnss_font_awesome_css' );
    wp_dequeue_style( 'cnss_font_awesome_v4_shims' );
    wp_dequeue_style( 'cnss_css' );
    // wp_dequeue_style( 'sp-news-public' );
    wp_dequeue_style( 'simple-staff-list' );
    wp_dequeue_style( 'wpsl-styles' );
    wp_dequeue_script( 'cnss_js' );
    wp_dequeue_style( 'reviewstream' );
};

// Fully Disable Gutenberg editor.
add_filter('use_block_editor_for_post_type', '__return_false', 10);
// Don't load Gutenberg-related stylesheets.
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );
function remove_block_css() {
wp_dequeue_style( 'wp-block-library' ); // WordPress core
wp_dequeue_style( 'wp-block-library-theme' ); // WordPress core
wp_dequeue_style( 'wc-block-style' ); // WooCommerce
wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
}

// ==========================================================================
//  Preload CSS
// ==========================================================================
// add_filter( 'style_loader_tag', 'preload_filter', 10, 2 );
// function preload_filter( $html, $handle ){
//   if (strcmp($handle, 'main-site') == 0) {
//     $html = str_replace("rel='stylesheet", "rel='preload' as='style' ", $html);
//     return $html;
//   }
// }

// ==========================================================================
//  DEFER JS
// ==========================================================================
function mind_defer_scripts( $tag, $handle, $src ) {
  $defer = array( 
    'main-site',
    'lazyloading',
    'nav-js',
    'font-awesome-cdn'
  );
  if ( in_array( $handle, $defer ) ) {
     return '<script src="' . $src . '" defer="defer" defer type="text/javascript"></script>' . "\n";
  }
    
    return $tag;
} 
add_filter( 'script_loader_tag', 'mind_defer_scripts', 10, 3 );


// REMOVE EMOJI ICONS
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// ==========================================================================
//    LOAD STYLES
// ==========================================================================
function add_stylesheets() {
  if (!is_admin()) {
    wp_enqueue_style('master', get_template_directory_uri().'/dist/assets/css/style.css', [], false, 'all');
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', [], false, 'all');
  }
}
add_action('wp_enqueue_scripts', 'add_stylesheets', 99);  //priority added so theme styles are loaded after plugins

// Disable caching on main stylesheet for admin users only
function add_stylesheets_nocache() {
  if (!is_admin()) {
    wp_dequeue_style('master');
    wp_enqueue_style('master-nocache', get_template_directory_uri().'/dist/assets/css/style.css?v='.time(), [], null, 'all');
  }
}
if (current_user_can('activate_plugins')) {
  add_action('wp_enqueue_scripts', 'add_stylesheets_nocache', 99);
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
// function admin_styles() {
//   wp_enqueue_style('admin-styles', get_template_directory_uri().'/dist/assets/css/wysiwyg-admin.style.css');
// }

function admin_scripts() {
  wp_enqueue_script('acf_id_generator', get_template_directory_uri().'/dist/assets/js/admin.js?v='.time(), [], null, 'all');
}

add_action('admin_enqueue_scripts', 'admin_scripts');

function tabor_setup() {
  // Add support for editor styles.
  add_theme_support( 'editor-styles' );

  // Enqueue editor styles.
  add_editor_style( '/dist/assets/css/wysiwyg-admin.style.css' );
}
add_action( 'after_setup_theme', 'tabor_setup' );

// ==========================================================================
//  DETECT JS
// ==========================================================================

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function adept_javascript_detection() {
  echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'adept_javascript_detection', 0 );

// ==========================================================================
//  RESET SOME WORDPRESS DEFAULTS
// ==========================================================================

/*
 * when oembed is youtube or vimeo,
 * wrap code in a class to make it responsive.
 * otherwise just return the typical embed code
 */
function custom_oembed_filter($html, $url, $attr, $post_ID) {
  if(strpos($url,'youtube') !== false || strpos($url,'youtu.be') !== false || strpos($url,'vimeo') !== false) {
      return '<div class="media-wrapper media-wrapper--video">'.$html.'</div>';
  }
  else {
      return $html;
  }
}
add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

/*
* by default, images are set to link to the attachment,
* this resets the default so images are not links
*/
function wpb_imagelink_setup() {
  $image_set = get_option( 'image_default_link_type' );

  if ($image_set !== 'none') {
      update_option('image_default_link_type', 'none');
  }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);

// ==========================================================================
//  USEFUL FUNCTIONS
// ==========================================================================

function get_the_slug() {
  $slug = basename(get_permalink());
  return $slug;
}

function get_top_level_parent_slug() {
  global $post;
  $parent = array_reverse(get_post_ancestors($post->ID));
  $first_parent = get_page($parent[0]);
  return $first_parent->post_name;
}

function get_the_parent_slug() {
  global $post;
  if($post->post_parent == 0) return '';
  $post_data = get_post($post->post_parent);
  return $post_data->post_name;
}

function is_blog() {
  global  $post;
  $posttype = get_post_type($post );
  return ( ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() ) && ( $posttype == 'post' ) ) ? true : false;
}

function add_blog_nav_active_class( $classes, $item ) {
  if ( is_blog() && $item->title == 'Blog' ) {
      $classes[] = 'current_page_item';
  }
  return $classes;
}
add_filter( 'nav_menu_css_class', 'add_blog_nav_active_class', 10, 2 );

// ==========================================================================
//  Custom Admin Column for Staff Members
// ==========================================================================

add_filter( 'manage_staff_member_posts_columns', 'set_custom_edit_staff_member_columns' );

function set_custom_edit_staff_member_columns( $columns ) {
  $date = $colunns['date'];
  unset( $columns['date'] );

  $columns['photo'] = __( 'Photo' );

  return $columns;
}

add_action( 'manage_staff_member_posts_custom_column' , 'custom_staff_member_column', 10, 2 );

function custom_staff_member_column( $column, $post_id ) {
  switch ( $column ) {

    // display a thumbnail photo
    case 'photo' :
      echo get_the_post_thumbnail( $post_id, array( 100, 100) );
      break;
  }
}

// ==========================================================================
//    MENUS
// ==========================================================================
function register_nav() {
  register_nav_menu('main_nav',__( 'Main Menu' ));
  register_nav_menu('main_util_nav',__( 'Main Utility Menu' ));
  register_nav_menu('footer_nav',__( 'Footer Menu' ));
  register_nav_menu('footer_util_nav',__( 'Footer Utility Menu' ));
} add_action( 'init', 'register_nav' );


// ==========================================================================
//    GOOGLE MAPS
// ==========================================================================
// Method 1: Filter.

// Method 2: Setting.
function my_acf_init() {
  acf_update_setting('google_api_key', 'AIzaSyCajZKL139FWm3lDrHTz76xU0mvcPwLLmY');
}
add_action('acf/init', 'my_acf_init');

// ==========================================================================
//  Contact Forms
// ==========================================================================
add_filter('wpcf7_form_elements', function($content) {
  $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

  return $content;
});

// ==========================================================================
//    WP Store Locator Settings
// ==========================================================================

// Additional Location Information
add_filter( 'wpsl_meta_box_fields', 'additional_location_meta_box_fields' );

function additional_location_meta_box_fields( $meta_fields ) {
    
    $meta_fields[__( 'Additional Information', 'wpsl' )] = array(
        'phone' => array(
            'label' => __( 'Tel', 'wpsl' )
        ),
        'alt_phone' => array(
          'label' => __( 'Alt Tel', 'wpsl' )
      ),
        'fax' => array(
            'label' => __( 'Fax', 'wpsl' )
        ),
        'email' => array(
            'label' => __( 'Email', 'wpsl' )
        ),
        'neighborhood' => array(
            'label' => __( 'Neighborhood', 'wpsl' )
        ),
        'holiday_hours' => array(
          'label' => __( 'Holiday Hours', 'wpsl' ),
          'type'  => 'textarea'
        ),
        'special_message' => array(
          'label' => __( 'Special Message', 'wpsl' ),
          'type'  => 'wp_editor'
        ),
    );

    return $meta_fields;
}


// Adding Archive for WPSL
add_filter( 'wpsl_post_type_args', 'wpsl_type_args' );

function wpsl_type_args( $args ) {
    
    $args['has_archive'] = true;
    
    return $args;
}

add_filter( 'wpsl_address_shortcode_defaults', 'custom_address_shortcode_defaults' );

function custom_address_shortcode_defaults( $shortcode_defaults ) {

    $shortcode_defaults['country'] = false;
    $shortcode_defaults['state'] = true;

    return $shortcode_defaults;
}

// Changes the admin label in menu
add_filter( 'wpsl_post_type_labels', 'custom_post_type_labels' );

function custom_post_type_labels( $labels ) {

  $labels['name_admin_bar'] = __( 'Office Location', 'wpsl' );
  
  return $labels;
}

// Changes featured image size on search results
add_filter( 'wpsl_thumb_size', 'custom_thumb_size' );

function custom_thumb_size() {
    
    $size = array( 170, 170 );
    
    return $size;
}

// Hide starting marker
add_filter( 'wpsl_js_settings', 'custom_js_settings' );

function custom_js_settings( $settings ) {

    $settings['startMarker'] = '';

    return $settings;
}

// Custom templates
add_filter( 'wpsl_templates', 'custom_templates', 999 );

function custom_templates( $templates ) {

    /**
     * The 'id' is for internal use and must be unique ( since 2.0 ).
     * The 'name' is used in the template dropdown on the settings page.
     * The 'path' points to the location of the custom template,
     * in this case the folder of your active theme.
     */
    // $templates[] = array (
    //     'id'   => 'custom',
    //     'name' => 'Overview template',
    //     'path' => get_template_directory_uri() . '/' . 'wpsl-templates/overview.php',
    // );

    $templates[] = array (
      'id'   => 'custom',
      'name' => 'Overview template',
      'path' => get_template_directory() . '/' . 'wpsl-templates/overview.php',
  );

  $templates[] = array (
    'id'   => 'mutliple-split',
    'name' => 'Split Location Listing & Map',
    'path' => get_template_directory() . '/' . 'wpsl-templates/split.php',
  );

  $templates[] = array (
    'id'   => 'full-stacked',
    'name' => 'Full Viewport Map Stacked',
    'path' => get_template_directory() . '/' . 'wpsl-templates/full-stacked.php',
  );
    return $templates;
}

// Changes the search result content
add_filter( 'wpsl_include_post_content', '__return_true' );
?>