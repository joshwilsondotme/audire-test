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

if($singleLayoutStyle == 'featured') {
  $locationSelector = $this->row['single_location']['location_selector'];
  $content = $this->row['single_location']['location_content'];
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
    $destination = $address . ', ' . $suite . ', <br/>' . $city . ', ' . $state . ' ' . $zip;
  } else {
    $destination = $address . ', <br/>' . $city . ', ' . $state . ' ' . $zip;
  }
  
  $direction_url = "https://maps.google.com/maps?saddr=&daddr=" . urlencode($destination) . "&travelmode=driving";
  
  echo '<div class="col-5@md col-12 text-component '.$side_left.'">' . $content . '</div>'; 
  echo '<div class="col-7@md col-12 '.$side_right.'">';
  echo '<div class="location__overlay-wrapper">';
  echo get_the_post_thumbnail($locationId, '5:4', array( 'class' => 'lazyload shadow-md radius-md margin-bottom-md' ));
  echo '<div class="location__overlay-content text-component">';
  echo '<h2 class="text-lg">'.get_the_title($locationId).'</h2>';
  echo '<p class="location__address location__detail-item location__detail-item--no-icon"> <strong>Address:</strong><span>'.$destination.'<br/><a href="'.$direction_url.'" target="_blank" rel="noopener noreferrer" class="text-sm btn--link btn--icon-arrow location__btn-directions">Get Directions</a></span></p>';
  echo '<p class="location__phone location__detail-item location__detail-item--no-icon items-center"><strong>Phone:</strong><a href="tel:'.$phone.'"><strong>'.$phone.'</strong></a></p>';
  
  echo '</div>';
  echo '</div>'; // overlayout content wrapper
  echo '</div>'; // overlayout content wrapper
  

}