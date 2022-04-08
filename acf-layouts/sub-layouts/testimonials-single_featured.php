<?php
$content = $this->row['single_featured'];
$featured_image = $content['featured_image'];
$pull_quote = $content['pull_quote'];
$quote = $content['quote'];
$cite = $content['cite'];
$additional_cite = $content['additional_cite'];
$column_bg_enable = $content['enable_background_color'];
$column_bg = $content['color_options'];

echo '<div class="col-4@md col-12"><img loading="lazy" src="'.$featured_image['url'].'" class="lazyload shadow-md radius-md"/></div>';

echo '<div class="col-8@md col-12 text-component">';

if($column_bg_enable == true) {
  echo '<div class="testimonial__inner text-component bg-' . $column_bg . ' padding-lg shadow-sm radius-md">';
}

echo '<blockquote class="testimonial__quote">';
if ($pull_quote) {
  echo '<p class="testimonial__pull-quote testimonial__pull-quote--right margin-top-md text-headline text-lg"><strong>'.$pull_quote.'</strong></p>';
}
echo $quote;
echo '<cite><span class="text-headline">'.$cite.'</span>';
echo (isset($additional_cite)) ? '<br><span class="text-uppercase text-sm">'.$additional_cite.'</span>' : '';
echo '</cite>';

echo '</blockquote>';



if($column_bg_enable == true) {
  // end column bg
  echo '</div>';
}

echo '</div>'; // end column