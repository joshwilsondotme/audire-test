<?php
echo '<div class="col-8@md col-12 text-component margin-left-auto margin-right-auto">'.$locationContent.'</div>';
// var_dump($locationContent);
echo '<div class="grid grid-gap-x-lg margin-top-lg justify-center">';
foreach($locationSelector as $location) {
  // var_dump($location);
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
    $destination = $address . ', ' . $suite . ', <br/>' .$city . ', ' . $state . ' ' . $zip;
  } else {
    $destination = $address . ', <br/>' . $city . ', ' . $state . ' ' . $zip;
  }
  echo '<div class="col-3@md col-6@sm col-12@xs">';
  echo '<div class="location__standard-card text-component">';
  echo get_the_post_thumbnail($locationId, '3:2', array( 'class' => 'lazyload shadow-md radius-md margin-bottom-md' ));
  echo '<h3 class="text-md">'.get_the_title($locationId).'</h3>';
  echo '<p class="location__address location__detail-item">'.$destination.'<br><a href="'.$direction_url.'" class="btn--link btn--icon-arrow text-sm" target="_blank" rel="noopener noreferrer">Get Directions</a></p>';

  echo '<p class="location__phone location__detail-item"><a href="tel:'.$phone.'"><strong>'.$phone.'</strong></a></p>';
  
  echo '</div>'; // end card
  echo '</div>';
}
echo '</div>'; // close grid