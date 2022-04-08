<?php 
global $wpsl_settings, $wpsl;

$output         = $this->get_custom_css(); 
$autoload_class = ( !$wpsl_settings['autoload'] ) ? 'class="wpsl-not-loaded"' : '';

$output .= '<div id="wpsl-split-wrap" class="grid grid-gap-lg">' . "\r\n";

$output .= "\t" . '<div id="wpsl-gmap" class="wpsl-gmap-canvas order-2 col-6@md col-12"></div>' . "\r\n";

$output .= "\t" . '<div id="wpsl-result-list" class="order-1 col-6@md col-12">' . "\r\n";
$output .= "\t\t" . '<div id="wpsl-stores" '. $autoload_class .'>' . "\r\n";
$output .= "\t\t\t" . '<ul class="scroll-list"></ul>' . "\r\n";
$output .= "\t\t" . '</div>' . "\r\n";
$output .= "\t\t" . '<div id="wpsl-direction-details">' . "\r\n";
$output .= "\t\t\t" . '<ul></ul>' . "\r\n";
$output .= "\t\t" . '</div>' . "\r\n";
$output .= "\t" . '</div>' . "\r\n";

$output .= '</div>' . "\r\n";

return $output;