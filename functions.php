<?php

/**
 * LOAD ALL /lib FILES
 *
 * keep this file clean by placing all functions, hooks,
 * actions, etc into appropriate files within /lib
 *
 */
require_once ('vendor/mexitek/phpcolors/src/Mexitek/PHPColors/Color.php');
// require_once ('vendor/acf-builder-master/autoload.php');

$theme_includes = [
  'lib/wysiwyg_custom_formats.php',
  'lib/setup.php',
  'lib/custom_post_types.php',
  'lib/hex2rgba.php',
  'lib/theme_support.php',
  'lib/bem_nav_walker.php',
  'lib/filters.php',
  'lib/blocks.php',
  'lib/acf_layout.php',
  'lib/theme_colors.php',
  'lib/theme_fonts.php',
  'lib/block_builder.php',
  'lib/call_tracking.php',
  'lib/gallery.php'
];

/**
 * Loading directory /acf-json for child themes
 */

// changes saving location for custom fields
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path) {
    // update path
    $path = get_template_directory() . '/acf-json';
    
    // return
    return $path;
}

// changes loading location for custom fields
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    error_log('hey!');
    
    // remove original path (optional)
    unset($paths[0]);
    
    // append path
    $paths[] = get_template_directory() . '/acf-json';
    
    // return
    return $paths;
}

// acf filter to prevent editing ID fields
add_filter('acf/load_field/key=field_61e57af3d97d3', 'readonly_field', 20, 1);
function readonly_field($field) {
  $field['readonly'] = true;
  return $field;
}


/**
 * Flushing rewrite rules
 */
// Code for themes
add_action( 'after_switch_theme', 'flush_rewrite_rules' );

// Code for plugins
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'myplugin_flush_rewrites' );
function myplugin_flush_rewrites() {
	// call your CPT registration function here (it should also be hooked into 'init')
	myplugin_custom_post_types_registration();
	flush_rewrite_rules();
}

/**
 * Disabling Gutenberg
 */
add_filter( 'use_block_editor_for_post', '__return_false' );

foreach ($theme_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


/**
 * Register Class Autoloader
 */
 spl_autoload_register( function($classname) {

    $class      = str_replace( '\\', DIRECTORY_SEPARATOR, strtolower($classname) ); 
    $classpath  = dirname(__FILE__) .  DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $class . '.cls.php';
    
    if ( file_exists( $classpath) ) {
        include_once $classpath;
    }
   
} );


/**
 * Display page template for admin only
 */
add_action( 'admin_bar_menu', 'show_template' );

function show_template() {
  global $template;
  print_r( $template );
}
