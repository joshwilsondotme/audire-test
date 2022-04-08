<?php
class FontLoader
{
  // key => name, fallback
  public $fontmap = [
    'playfair_display' => ["Playfair Display", 'serif'],
    'roboto_slab' => ["Roboto Slab", 'serif'],
    'lora' => ["Lora", 'serif'],
    'bitter' => ["Bitter", 'serif'],
    'eb_garamond' => ["EB Garamond", 'serif'],
    'literata' => ["Literata", 'serif'],
    'Domine' => ["Domine", 'serif'],
    'work_sans' => ["Work Sans", 'sans-serif'],
    'merriweather_sans' => ["Merriweather Sans", 'sans-serif'],
    'rubik' => ["Rubik", 'sans-serif'],
    'maven_pro' => ["Maven Pro", 'sans-serif'],
    'raleway' => ["Raleway", 'sans-serif'],
    'heebo' => ["Heebo", 'sans-serif'],
    'noto_sans_display' => ["Noto Sans Display", 'sans-serif'],
    'open_sans' => ["Open Sans", 'sans-serif'],
    'montserrat' => ["Montserrat", 'sans-serif'],
    'oswald' => ["Oswald", 'sans-serif'],
    'source_sans' => ["Source Sans", 'sans-serif'],

  ];

  function __construct() { 
    $this->enqueue(); 
  } 

  function url_format($font) {
    return str_replace(' ', '+', $this->fontmap[$font][0]);
  }

  function enqueue() {
    
    add_action('wp_head', function () {
      if ( have_rows( 'theme_fonts', 'themes-options' ) ) :
        while ( have_rows( 'theme_fonts', 'themes-options' ) ) : the_row();
          $title = get_sub_field( 'title_font' );
          $body = get_sub_field( 'body_font' );
        endwhile;
      endif;
      
      if (isset($body) && isset($title)) {
        echo "<link rel='preconnect' href='https://fonts.googleapis.com'><link rel='preload' as='style' onload='this.onload=null;this.rel=\"stylesheet\"' href='https://fonts.googleapis.com/css2?family={$this->url_format($title)}:ital,wght@0,400..700;1,400..700&family={$this->url_format($body)}:ital,wght@0,400..700;1,400..700&display=swap' rel='stylesheet'>";
      }
    }, 999);

    add_action('wp_enqueue_scripts', function () {
      wp_register_style( 'root-fonts', false );
      wp_enqueue_style( 'root-fonts' );
      
      if ( have_rows( 'theme_fonts', 'themes-options' ) ) :
        while ( have_rows( 'theme_fonts', 'themes-options' ) ) : the_row();
          $title = get_sub_field( 'title_font' );
          $body = get_sub_field( 'body_font' );
        endwhile;
      endif;

        if (isset($body) && isset($title)) {
          $body_str = "{$this->fontmap[$body][0]}, {$this->fontmap[$body][1]}";
          $title_str = "{$this->fontmap[$title][0]}, {$this->fontmap[$title][1]}";

          wp_add_inline_style('root-fonts', "
          :root {
              --font-primary: {$body_str};
              --font-headline: {$title_str};
          }
        ");
        }
    }, 200);


    add_filter( 'tiny_mce_before_init', function($mceInit){
      if ( have_rows( 'theme_fonts', 'themes-options' ) ) :
        while ( have_rows( 'theme_fonts', 'themes-options' ) ) : the_row();
          $title = get_sub_field( 'title_font' );
          $body = get_sub_field( 'body_font' );
        endwhile;
      endif;
      
      $body_str = "{$this->fontmap[$body][0]}, {$this->fontmap[$body][1]}";
      $title_str = "{$this->fontmap[$title][0]}, {$this->fontmap[$title][1]}";

      $styles = "@import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap'); :root{--font-primary:{$body_str};--font-headline:{$title_str};}";

      if ( !isset( $mceInit['content_style'] ) ) {
        $mceInit['content_style'] = $styles . ' ';
      } else {
        $mceInit['content_style'] .= ' ' . $styles . ' ' ;
      }

      return $mceInit;

    }, 200);
    
  }

}

new FontLoader();
