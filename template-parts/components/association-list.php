<?php 
  /**
   * TODO: Refactor to an array
   * https://github.com/StalwartJourneys/wordpress-site/blob/master/wordpress/wp-content/themes/live-better-hearing-theme/single-staff-member.php
   */
?>
<?php if ( 
  ( $list_checked_option['value']  == 'academy-of-doctors-of-audiology' ) ||
  ( $memberships_associations_value['value']  == 'academy-of-doctors-of-audiology' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/ada_logo-color.svg" alt="" class="">';
} elseif ( 
  ( $list_checked_option['value'] == 'american-board-of-audiology' ) ||
  ( $memberships_associations_value['value'] == 'american-board-of-audiology' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/aba_logo-color.svg" alt="" class="">';
} elseif ( 
  ( $list_checked_option['value'] == 'american-speech-language-hearing-association' ) ||
  ( $memberships_associations_value['value'] == 'american-speech-language-hearing-association' ) 
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/asha_logo-color.svg" alt="" class="">';
} elseif ( 
  ( $list_checked_option['value'] == 'audigy-member' ) ||
  ( $memberships_associations_value['value'] == 'audigy-member' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/audigy_logo-color.png" alt="" class="">';
} elseif ( 
  ( $list_checked_option['value'] == 'cochlear-alliance' ) ||
  ( $memberships_associations_value['value'] == 'cochlear-alliance' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/cpn_logo-color.png" alt="" class="">';
} elseif ( 
  ( $list_checked_option['value'] == 'national-board-certified-hearing-instrument-specialist' ) ||
  ( $memberships_associations_value['value'] == 'national-board-certified-hearing-instrument-specialist' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/nb-his_logo-color.png" alt="" class="">';
} elseif ( 
  ( $list_checked_option['value'] == 'american-academy-of-audiology' ) ||
  ( $memberships_associations_value['value'] == 'american-academy-of-audiology' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/aaa_logo-color.svg" alt="" class="">';
} elseif ( 
  ( $list_checked_option['value'] == 'the-american-institute-of-balance' ) ||
  ( $memberships_associations_value['value'] == 'the-american-institute-of-balance' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/aib_logo-color.svg" alt="" class="">';
} elseif ( 
  ( $list_checked_option['value'] == 'american-tinnitus-association' ) ||
  ( $memberships_associations_value['value'] == 'american-tinnitus-association' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/ata_logo-color.png" alt="" class="">';
} elseif ( 
  ( $list_checked_option['value'] == 'better-business-bureau' ) ||
  ( $memberships_associations_value['value'] == 'better-business-bureau' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/bbb_logo-color.svg" alt="" class="">';
} elseif ( 
  ( $list_checked_option['value'] == 'hearing-loss-association-of-america' ) ||
  ( $memberships_associations_value['value'] == 'hearing-loss-association-of-america' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/haa_logo-color.svg" alt="" class="">';
} elseif ( 
  ( $list_checked_option['value'] == 'healthy-hearing' ) ||
  ( $memberships_associations_value['value'] == 'healthy-hearing' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/healthy alt="" class=""-hearing_logo-color.svg">';
} elseif ( 
  ( $list_checked_option['value'] == 'international-hearing-society' ) ||
  ( $memberships_associations_value['value'] == 'international-hearing-society' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/ihs_logo-color.png" alt="" class="">';
} elseif ( 
  ( $list_checked_option['value'] == 'speech-language-and-audiology-canada' ) ||
  ( $memberships_associations_value['value'] == 'speech-language-and-audiology-canada' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/sac_logo-color.png" alt="" class="">';
} elseif ( 
  ( $list_checked_option['value'] == 'canadian-academy-of-audiology ' ) ||
  ( $memberships_associations_value['value'] == 'canadian-academy-of-audiology ' )
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/caa-aca alt="" class=""_logo-color.svg">';
} elseif ( 
  ( $list_checked_option['value'] == 'better-business-bureau-canada ' ) ||
  ( $memberships_associations_value['value'] == 'better-business-bureau-canada ' ) 
  ) {
  echo '<img src="'. get_template_directory_uri().'/images/associations/bbb_logo-color.svg" alt="" class="">';
}