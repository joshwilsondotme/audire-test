<?php

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );

/*
 * Enable support for Post Thumbnails on posts and pages.
 * only support for specific post types by passing post type in array
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
add_theme_support( 'post-thumbnails', array('post', 'product')  );

/**
 * Enable responsive embeds
 * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content
 */
add_theme_support('responsive-embeds');

/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption'));

/**
 * Enable selective refresh for widgets in customizer
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
 */
add_theme_support('customize-selective-refresh-widgets');

/*
 * Adding Theme Options Page
 */

// Check function exists.
if( function_exists('acf_add_options_page') ) {

  // Register options page.
  acf_add_options_page(array(
    'page_title'    => __('Theme General Settings'),
    'menu_title'    => __('Theme Settings'),
    'menu_slug'     => 'theme-general-settings',
    'capability'    => 'edit_posts',
    'post_id'       => 'themes-options',
    'redirect'      => false,
    'position'      => '2',
  ));

  // Blog Settings Page
  acf_add_options_sub_page(array(
    'title'      => 'Blog Options',
    'parent'     => 'edit.php',
    'menu_slug'  => 'blog-options',
    'post_id'    => 'blog-options',
    'capability' => 'manage_options'
  ));

  // Staff Settings Page
  acf_add_options_sub_page(array(
    'page_title'  => __('Staff Archive'),
    'menu_title'  => __('Staff Archive'),
    'menu_slug'   => 'staff-options',
    'post_id'   => 'staff-options',
    'parent_slug' => 'edit.php?post_type=staff_member',
  ));
  
  // Location Settings Page
  acf_add_options_sub_page(array(
    'page_title'  => __('Locations Archive'),
    'menu_title'  => __('Locations Archive'),
    'menu_slug'   => 'locations-options',
    'post_id'     => 'location-options',
    'parent_slug' => 'edit.php?post_type=wpsl_stores',
  ));

  // Products Settings Page
  acf_add_options_sub_page(array(
    'page_title'  => __('Product Archive'),
    'menu_title'  => __('Product Archive'),
    'menu_slug'   => 'product-options',
    'post_id'     => 'product-options',
    'parent_slug' => 'edit.php?post_type=products',
  ));

  // Services Settings Page
  acf_add_options_sub_page(array(
    'page_title'  => __('Services Archive'),
    'menu_title'  => __('Services Archive'),
    'menu_slug'   => 'service-options',
    'post_id'     => 'service-options',
    'parent_slug' => 'edit.php?post_type=services',
  ));

  // Resource Settings Page
  acf_add_options_sub_page(array(
    'page_title'  => __('Resource Archive'),
    'menu_title'  => __('Resource Archive'),
    'menu_slug'   => 'resource-options',
    'post_id'     => 'resource-options',
    'parent_slug' => 'edit.php?post_type=resources',
  ));
}




/**
 * Add Custom Image Sizes
 *
 * Dimensions defined in the array are for regular screens
 */
$image_sizes = [
  '1:1'   => [200, 200],
  '3:2'   => [300, 200],
  '4:2'   => [400, 200],
  '4:3'   => [400, 300],
  '5:4'   => [500, 400],
  '16:9'  => [1600, 900],
  '16:10' => [1600, 1000],
  'cta-image' => [670, 400],
  'standard-logo' => [200, 100],
  'small-logo' => [150, 75]
];
foreach ($image_sizes as $size => $dimensions){
  $width = $dimensions[0];
  $height = $dimensions[1];

  add_image_size($size, $width, $height, true);
  add_image_size("$size-retina", $width * 2, $height * 2, true);
  add_image_size("$size-small", $width / 2, $height / 2, true);
  add_image_size("$size-vertical", $height, $width, true);
  add_image_size("$size-retina-vertical", $height * 2, $width * 2, true);
}

add_image_size("tacos", 370, 270, true);

/**
 * Register the `.brand` selector as the blogname.
 *
 * @param  \WP_Customize_Manager $wp_customize
 * @return void
 */
add_action('customize_register', function (WP_Customize_Manager $wp_customize) {
  $wp_customize->get_setting('blogname')->transport = 'postMessage';
  $wp_customize->selective_refresh->add_partial('blogname', [
      'selector' => '.brand',
      'render_callback' => function () {
          bloginfo('name');
      },
  ]);
});


/**
 * Disable Comments and related functionality
 */
add_action('admin_init', function () {
  // Redirect any user trying to access comments page
  global $pagenow;

  if ($pagenow === 'edit-comments.php') {
      wp_redirect(admin_url());
      exit;
  }

  // Remove comments metabox from dashboard
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

  // Disable support for comments and trackbacks in post types
  foreach (get_post_types() as $post_type) {
      if (post_type_supports($post_type, 'comments')) {
          remove_post_type_support($post_type, 'comments');
          remove_post_type_support($post_type, 'trackbacks');
      }
  }
});

/**
 * Close comments on the front-end
 */
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

/**
 * Hide existing comments
 */
add_filter('comments_array', '__return_empty_array', 10, 2);

 /**
 * Remove comments page in menu
 */
add_action('admin_menu', function () {
  remove_menu_page('edit-comments.php');
});

/**
 * Remove comments links from admin bar
 */
add_action('init', function () {
  if (is_admin_bar_showing()) {
      remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
  }
});

/**
 * Disable all colors within Gutenberg.
 */
function disable_gutenberg_color_settings() {
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'editor-gradient-presets', [] );
	add_theme_support( 'disable-custom-gradients' );
}
add_action( 'after_setup_theme', 'disable_gutenberg_color_settings' );

/**
 * Moving media in menu
 */

function media_custom_menu_order() {
  return array( 'index.php', 'upload.php' );
}

add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order', 'media_custom_menu_order' );

/*
 * Enable support for shortcode within text area for ACF
 */
add_filter('acf/format_value/type=textarea', 'do_shortcode');