<?php
$side_left = '';
if ($this->row['content_side'] == 'left' ) {
  $side_left = 'order-1';
} else {
  $side_left = 'order-2';
}

$side_right = '';
if ($this->row['content_side'] == 'right' ) {
  $side_right = 'order-1';
} else {
  $side_right = 'order-2';
}
if($singleLayoutStyle == 'confined') {
  $locationSelector = $this->row['single_location']['location_selector'];
  $locationId = $locationSelector->ID;
  $phone = get_post_meta($locationId, 'wpsl_phone', true);
  $fax = get_post_meta($locationId, 'wpsl_fax', true);
  $address = get_post_meta($locationId, 'wpsl_address', true);
  $suite = get_post_meta($locationId, 'wpsl_address2', true);
  $city = get_post_meta($locationId, 'wpsl_city', true);
  $state = get_post_meta($locationId, 'wpsl_state', true);
  $zip = get_post_meta($locationId, 'wpsl_zip', true);
  $country = get_post_meta($locationId, 'wpsl_country', true);
  $facebook = get_post_meta($locationId, 'wpsl_facebook_url', true);
  $twitter = get_post_meta($locationId, 'wpsl_twitter_url', true);
  $youtube = get_post_meta($locationId, 'wpsl_youtube_url', true);
  $instagram = get_post_meta($locationId, 'wpsl_instagram_url', true);
  $linkedin = get_post_meta($locationId, 'wpsl_linkedin_url', true);
  $hh = get_post_meta($locationId, 'wpsl_hh_url', true);
  $bbb = get_post_meta($locationId, 'wpsl_bbb_url', true);
  $holiday_hours = get_post_meta($locationId, 'wpsl_holiday_hours', true);
  $building = get_post_meta($locationId, 'wpsl_neighborhood', true);
  $special_messages = get_post_meta($locationId, 'wpsl_special_message', true);
  if($suite) {
    $destination = $address . ', ' . $suite . ', ' . $city . ', ' . $state . ' ' . $zip;
  } else {
    $destination = $address . ', ' . $city . ', ' . $state . ' ' . $zip;
  }
  
  $direction_url = "https://maps.google.com/maps?saddr=&daddr=" . urlencode($destination) . "&travelmode=driving";

  echo '<div class="col-8@md col-12 '.$side_left.'">' . do_shortcode( '[wpsl_map id="'.$locationId.'"]') . '</div>'; 
  echo '<div class="col-4@md col-12 text-component '.$side_right.'">';
  echo get_the_post_thumbnail($locationId, '16:9-small', array( 'class' => 'lazyload shadow-md radius-sm margin-bottom-md' ));
  echo '<h2 class="text-lg">'.get_the_title($locationId).'</h2>';
  echo '<p class="location__address location__detail-item">'.$destination.'</p>';
  echo '<p class="location__phone location__detail-item"><a href="tel:'.$phone.'"><strong>'.$phone.'</strong></a></p>';
  echo '<p><a href="'.get_the_permalink($locationId).'" class="btn btn--primary btn--sm">Contact Clinic</a> <a href="'.$direction_url.'" target="_blank" rel="noopener noreferrer" class="btn btn--secondary btn--sm">Get Directions</a></p>';
  echo '</div>';

}