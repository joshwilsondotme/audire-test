<?php 

use \Mexitek\PHPColors\Color;

// Initialize my color
$GLOBALS['themeColors'] = array(
  'neutral'  => array(
    100 => 'f7d6d0',
    200 => 'efaea1',
    300 => 'e78672',
    400 => 'df5e43',
    500 => 'd83615',
    600 => 'ac2b10',
    700 => '81200c',
    800 => '561508',
    900 => '2b0a04'
  ),
  'contrast' => array(
    100 => 'ffffff',
    200 => 'f2f2f2',
    300 => 'dbdbdc',
    400 => '79797c',
    500 => '313135',
    600 => '1c1c21'
  )
);
$root                   = color_builder();
// $color_palette       = color_palette();

// Color builder used for WYSIWYG
function color_builder() {
  $primary    = '#e04f3c';
  $secondary  = '#f7931d';
  $tertiary   = '#1b2938';
  $quaternary = '#00a99b';

  if ( have_rows( 'theme_colors', 'themes-options' ) ) : 
    while ( have_rows( 'theme_colors', 'themes-options' ) ) : the_row();
      $primary = get_sub_field( 'primary' ); 
      $secondary = get_sub_field( 'secondary' ); 
      $tertiary = get_sub_field( 'tertiary' ); 
      $quaternary = get_sub_field( 'quaternary' ); 
    endwhile; 
  endif; 
  
  $colors = [
    'primary' => $primary,
    'secondary' => $secondary,
    'tertiary' => $tertiary,
    'quaternary' => $quaternary,
  ];
  
  $root = ":root {";

  foreach ($colors as $key => $val) {
    try {
      $color = new Color($val);
      $hsl = $color->getHsl();

      $h = $hsl['H'];
      $s = $hsl['S'] * 100;
      $l = $hsl['L'] * 100;
      
      

      /**
       * This allows us to pull the color as sass variables if needed
       * @link https://codyhouse.co/blog/post/how-to-combine-sass-color-functions-and-css-variables
       */
      $root .= "
      --color-{$key}: hsl({$h},{$s}%,{$l}%);
      --color-{$key}-h: {$h};
      --color-{$key}-s: {$s}%;
      --color-{$key}-l: {$l}%;
      ";

      $black = new Color('#000');
      $white = new Color('#fff');

      $range = [
          '100' => $color->mix($white, -80),
          '200' => $color->mix($white, -60),
          '300' => $color->mix($white, 1),
          '400' => $color->mix($white, 40),
          // '100' => $color->mix($white, -80),
          // '200' => $color->mix($white, -50),
          // '300' => $color->mix($white, -20),
          // '400' => $color->mix($white, 20),
          '500' => $color,
          '600' => $color->mix($black, 50),
          '700' => $color->mix($black, 25),
          '800' => $color->mix($black, -25),
          '900' => $color->mix($black, -75),
      ];

      // This creates css variables for the entire range
      foreach ($range as $num => $color) {
          $GLOBALS['themeColors'][$key][$num] = is_string($color) ? $color : $color->getHex();
          $root .= "--color-{$key}-{$num}: " . ($num == 500 ? '' : '#') . "$color;";
      }


    } catch (Exception $e) {
    }
  }
  $root .= "}";
  return $root;

}

// Generate color css custom properties for inline on admin.
function color_palette() {

  $primary = '#e04f3c';
  $secondary = '#f7931d';
  $tertiary = '#1b2938';
  $quaternary = '#00a99b';

  if ( have_rows( 'theme_colors', 'themes-options' ) ) : 
    while ( have_rows( 'theme_colors', 'themes-options' ) ) : the_row();
      $primary = get_sub_field( 'primary' ); 
      $secondary = get_sub_field( 'secondary' ); 
      $tertiary = get_sub_field( 'tertiary' ); 
      $quaternary = get_sub_field( 'quaternary' ); 
    endwhile; 
  endif; 
  
  $colors = [
    'primary' => $primary,
    'secondary' => $secondary,
    'tertiary' => $tertiary,
    'quaternary' => $quaternary,
  ];

  foreach ($colors as $key => $val) {
    try {
      $color = new Color($val);
      $hsl = $color->getHsl();

      $h = $hsl['H'];
      $s = $hsl['S'] * 100;
      $l = $hsl['L'] * 100;
      

      $black = new Color('#000');
      $white = new Color('#fff');

      $range = [
          '100' => $color->mix($white, -60),
          '200' => $color->mix($white, -20),
          '300' => $color->mix($white, 20),
          '400' => $color->mix($white, 60),
          '500' => $color->mix($white, 100),
          '600' => $color->mix($black, 60),
          '700' => $color->mix($black, 20),
          '800' => $color->mix($black, -20),
          '900' => $color->mix($black, -60),
      ];
      

      // var_dump($range);

      // This creates css variables for the entire range
      foreach ($range as $num => $color) {
          $colors_array = '';
          $colors_array .= ($num == 500 ? '' : '#') . "$color";   
      }
  

    } catch (Exception $e) {
    }
  }
  return $colors_array;
  
}

// Adding inline styles for all colors
add_action('wp_enqueue_scripts', function () {
  global $root;
  wp_register_style( 'root-colors', false );
  wp_enqueue_style( 'root-colors' );
  wp_add_inline_style('root-colors', $root);
}, 200);

// Adding CSS Variables to Admin 
add_action( 'admin_enqueue_scripts', function() {
  global $root;
  wp_register_style( 'color-palette', false );
  wp_enqueue_style( 'color-palette' );
  wp_add_inline_style('color-palette', $root);
} );


// TinyMCE Styles
function kwh_add_editor_style( $mceInit ) {
  global $root;
  
  $string = trim(preg_replace('/\s+/', ' ', $root));
  $styles = $string;
  

  if ( !isset( $mceInit['content_style'] ) ) {
    $mceInit['content_style'] = $styles ;
  } else {
    $mceInit['content_style'] .= $styles ;
  }

  return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'kwh_add_editor_style', 300 );

// ACF Color Palette
function theme_color_palette() {
  add_theme_support( 'editor-color-palette', array( 
    array( 
      'name' => esc_attr__( 'Primary 100' ),
      'slug' => 'primary-100',
      'color' => '#f7d6d0',
    ),
    array( 
      'name' => esc_attr__( 'Primary 200' ),
      'slug' => 'primary-200',
      'color' => '#efaea1',
    ),
    array( 
      'name' => esc_attr__( 'Primary 300' ),
      'slug' => 'primary-300',
      'color' => '#e78672',
    ),
    array( 
      'name' => esc_attr__( 'Primary 400' ),
      'slug' => 'primary-400',
      'color' => '#df5e43',
    ),
    array( 
      'name' => esc_attr__( 'Primary' ),
      'slug' => 'primary-500',
      'color' => '#d83615',
    ),
    array( 
      'name' => esc_attr__( 'Primary 600' ),
      'slug' => 'primary-600',
      'color' => '#ac2b10',
    ),
    array( 
      'name' => esc_attr__( 'Primary 700' ),
      'slug' => 'primary-700',
      'color' => '#81200c',
    ),
    array( 
      'name' => esc_attr__( 'Primary 800' ),
      'slug' => 'primary-800',
      'color' => '#561508',
    ),
    array( 
      'name' => esc_attr__( 'Primary 900' ),
      'slug' => 'primary-900',
      'color' => '#2b0a04',
    ),
    array( 
      'name' => esc_attr__( 'Secondary 100' ),
      'slug' => 'secondary-100',
      'color' => '#f7d6d0',
    ),
    array( 
      'name' => esc_attr__( 'Secondary 200' ),
      'slug' => 'secondary-200',
      'color' => '#efaea1',
    ),
    array( 
      'name' => esc_attr__( 'Secondary 300' ),
      'slug' => 'secondary-300',
      'color' => '#e78672',
    ),
    array( 
      'name' => esc_attr__( 'Secondary 400' ),
      'slug' => 'secondary-400',
      'color' => '#df5e43',
    ),
    array( 
      'name' => esc_attr__( 'Secondary' ),
      'slug' => 'secondary-500',
      'color' => '#d83615',
    ),
    array( 
      'name' => esc_attr__( 'Secondary 600' ),
      'slug' => 'secondary-600',
      'color' => '#ac2b10',
    ),
    array( 
      'name' => esc_attr__( 'Secondary 700' ),
      'slug' => 'secondary-700',
      'color' => '#81200c',
    ),
    array( 
      'name' => esc_attr__( 'Secondary 800' ),
      'slug' => 'secondary-800',
      'color' => '#561508',
    ),
    array( 
      'name' => esc_attr__( 'Secondary 900' ),
      'slug' => 'secondary-900',
      'color' => '#2b0a04',
    ),
    array( 
      'name' => esc_attr__( 'Tertiary 100' ),
      'slug' => 'tertiary-100',
      'color' => '#f7d6d0',
    ),
    array( 
      'name' => esc_attr__( 'Tertiary 200' ),
      'slug' => 'tertiary-200',
      'color' => '#efaea1',
    ),
    array( 
      'name' => esc_attr__( 'Tertiary 300' ),
      'slug' => 'tertiary-300',
      'color' => '#e78672',
    ),
    array( 
      'name' => esc_attr__( 'Tertiary 400' ),
      'slug' => 'tertiary-400',
      'color' => '#df5e43',
    ),
    array( 
      'name' => esc_attr__( 'Tertiary' ),
      'slug' => 'tertiary-500',
      'color' => '#d83615',
    ),
    array( 
      'name' => esc_attr__( 'Tertiary 600' ),
      'slug' => 'tertiary-600',
      'color' => '#ac2b10',
    ),
    array( 
      'name' => esc_attr__( 'Tertiary 700' ),
      'slug' => 'tertiary-700',
      'color' => '#81200c',
    ),
    array( 
      'name' => esc_attr__( 'Tertiary 800' ),
      'slug' => 'tertiary-800',
      'color' => '#561508',
    ),
    array( 
      'name' => esc_attr__( 'Tertiary 900' ),
      'slug' => 'tertiary-900',
      'color' => '#2b0a04',
    ),
    array( 
      'name' => esc_attr__( 'Quaternary 100' ),
      'slug' => 'quaternary-100',
      'color' => '#f7d6d0',
    ),
    array( 
      'name' => esc_attr__( 'Quaternary 200' ),
      'slug' => 'quaternary-200',
      'color' => '#efaea1',
    ),
    array( 
      'name' => esc_attr__( 'Quaternary 300' ),
      'slug' => 'quaternary-300',
      'color' => '#e78672',
    ),
    array( 
      'name' => esc_attr__( 'Quaternary 400' ),
      'slug' => 'quaternary-400',
      'color' => '#df5e43',
    ),
    array( 
      'name' => esc_attr__( 'quaternary' ),
      'slug' => 'quaternary-500',
      'color' => '#d83615',
    ),
    array( 
      'name' => esc_attr__( 'Quaternary 600' ),
      'slug' => 'quaternary-600',
      'color' => '#ac2b10',
    ),
    array( 
      'name' => esc_attr__( 'Quaternary 700' ),
      'slug' => 'quaternary-700',
      'color' => '#81200c',
    ),
    array( 
      'name' => esc_attr__( 'Quaternary 800' ),
      'slug' => 'quaternary-800',
      'color' => '#561508',
    ),
    array( 
      'name' => esc_attr__( 'Quaternary 900' ),
      'slug' => 'quaternary-900',
      'color' => '#2b0a04',
    ),
    array( 
      'name' => esc_attr__( 'Neutral 100' ),
      'slug' => 'neutral-100',
      'color' => '#f7d6d0',
    ),
    array( 
      'name' => esc_attr__( 'Neutral 200' ),
      'slug' => 'neutral-200',
      'color' => '#efaea1',
    ),
    array( 
      'name' => esc_attr__( 'Neutral 300' ),
      'slug' => 'neutral-300',
      'color' => '#e78672',
    ),
    array( 
      'name' => esc_attr__( 'Neutral 400' ),
      'slug' => 'neutral-400',
      'color' => '#df5e43',
    ),
    array( 
      'name' => esc_attr__( 'Neutral' ),
      'slug' => 'neutral-500',
      'color' => '#d83615',
    ),
    array( 
      'name' => esc_attr__( 'Neutral 600' ),
      'slug' => 'neutral-600',
      'color' => '#ac2b10',
    ),
    array( 
      'name' => esc_attr__( 'Neutral 700' ),
      'slug' => 'neutral-700',
      'color' => '#81200c',
    ),
    array( 
      'name' => esc_attr__( 'Neutral 800' ),
      'slug' => 'neutral-800',
      'color' => '#561508',
    ),
    array( 
      'name' => esc_attr__( 'Neutral 900' ),
      'slug' => 'neutral-900',
      'color' => '#2b0a04',
    ),
    array( 
      'name' => esc_attr__( 'Contrast 100' ),
      'slug' => 'contrast-100',
      'color' => '#df5e43',
    ),
    array( 
      'name' => esc_attr__( 'Contrast 200' ),
      'slug' => 'contrast-200',
      'color' => '#d83615',
    ),
    array( 
      'name' => esc_attr__( 'Contrast 300' ),
      'slug' => 'contrast-300',
      'color' => '#ac2b10',
    ),
    array( 
      'name' => esc_attr__( 'Contrast 400' ),
      'slug' => 'contrast-400',
      'color' => '#81200c',
    ),
    array( 
      'name' => esc_attr__( 'Contrast 500' ),
      'slug' => 'contrast-500',
      'color' => '#561508',
    ),
    array( 
      'name' => esc_attr__( 'Contrast 600' ),
      'slug' => 'contrast-600',
      'color' => '#2b0a04',
    ),
   ) );
}
add_action( 'after_setup_theme', 'theme_color_palette');

// Adding custom styling for Color Picker 
add_filter('acf/load_field/name=color_options', 'wd_acf_dynamic_colors_load');

function wd_acf_dynamic_colors_load( $field ) {

     // get array of colors created using editor-color-palette
     $colors = get_theme_support( 'editor-color-palette' );

     // if this array is empty, continue
     if( ! empty( $colors ) ) {

          // loop over each color and create option
          foreach( $colors[0] as $color ) {
               $field['choices'][ $color['slug'] ] = $color['name'];
          }
     }

     return $field;
}

function color_palette_admin() {
  wp_enqueue_style('admin-color-palette', get_template_directory_uri().'/dist/assets/css/admin.css');
}

add_action( 'admin_enqueue_scripts', 'color_palette_admin' );