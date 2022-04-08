<?php
echo '<div class="col-4@md col-12 text-component">'.$locationContent.'</div>';
echo '<div class="col-8@md col-12"><div class="grid grid-gap-x-lg">';
$locationCount = count($locationSelector);
foreach($locationSelector as $location) {
  
  $locationId = $location->ID;
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
  $destination = $address . ',' . $city . ',' . $zip;
  $direction_url = "https://maps.google.com/maps?saddr=&daddr=" . urlencode($destination) . "&travelmode=driving";
  $special_messages = get_post_meta($locationId, 'wpsl_special_message', true);
  if($suite) {
    $destination = $address . ', ' . $suite . ', <br/>' . $city . ', ' . $state . ' ' . $zip;
  } else {
    $destination = $address . ', <br/>' . $city . ', ' . $state . ' ' . $zip;
  }
  
if ($locationCount == 2) {
  echo '<div class="col-6@md col-12">';
} else {
  echo '<div class="col-4@md col-12">';
}

echo '<div class="location__standard-card text-component">';
echo get_the_post_thumbnail($locationId, '3:2', array( 'class' => 'lazyload shadow-sm radius-md margin-bottom-md width-100' ));
echo '<div class="location__floating-details bg-contrast-100 padding-md radius-md shadow-md">';
echo '<h3 class="text-md">'.get_the_title($locationId).'</h3>';
echo '<p class="location__address location__detail-item ">'.$destination.'<br><a href="'.$direction_url.'" class="btn--link btn--icon-arrow text-sm">Get Directions</a></p>';

echo '<p class="location__phone location__detail-item"><a href="tel:'.$phone.'"><strong>'.$phone.'</strong></a></p>';
echo '</div>';
echo '</div>'; // end card
echo '</div>';
}
echo '</div></div>';