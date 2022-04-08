<?php 
global $wpsl_settings, $wpsl;

$output         = $this->get_custom_css(); 
$autoload_class = ( !$wpsl_settings['autoload'] ) ? 'class="wpsl-not-loaded"' : '';

$output .= '<div class="col-12"><div id="wpsl-wrap" class="wpsl-store-below wpsl-wrap--stacked">' . "\r\n";

    
if ( $wpsl_settings['reset_map'] ) { 
    $output .= "\t" . '<div class="wpsl-gmap-wrap wpsl-gmap-wrap--fixed">' . "\r\n";
    $output .= "\t\t" . '<div id="wpsl-gmap" class="wpsl-gmap-canvas wpsl-gmap-canvas--short"></div>' . "\r\n";
    $output .= "\t" . '</div>' . "\r\n";
} else {
    $output .= "\t" . '<div id="wpsl-gmap" class="wpsl-gmap-canvas wpsl-gmap-canvas--short"></div>' . "\r\n";
}

$output .= "\t" . '<div id="hp-block__locations">' . "\r\n";
$output .= "\t\t" . '<div id="wpsl-stores" '. $autoload_class .'>' . "\r\n";
$output .= "\t\t\t" . '<ul class="flex justify-center wpsl-list-column"></ul>' . "\r\n";
$output .= "\t\t" . '</div>' . "\r\n";
$output .= "\t" . '</div>' . "\r\n";

if ( $wpsl_settings['show_credits'] ) { 
    $output .= "\t" . '<div class="wpsl-provided-by">'. sprintf( __( "Search provided by %sWP Store Locator%s", "wpsl" ), "<a target='_blank' href='https://wpstorelocator.co'>", "</a>" ) .'</div>' . "\r\n";
}

$output .= '</div></div>' . "\r\n";

return $output;