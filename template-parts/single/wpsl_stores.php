<?php 

  // wp_enqueue_script("map-js", get_template_directory_uri()."/dist/assets/js/location-map.js", [], false, true );

  // wp_enqueue_script('google-map-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCajZKL139FWm3lDrHTz76xU0mvcPwLLmY', [], false, true );

  wp_enqueue_script("logo-carousel", get_template_directory_uri()."/dist/assets/js/logo-carousel.js", ['swiper-js'], false, true );

  wp_enqueue_script("carousel", get_template_directory_uri()."/dist/assets/js/carousel.js", ['swiper-js'], false, true );

  wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], false, true );

  wp_enqueue_script("table-of-contents", get_template_directory_uri()."/dist/assets/js/table-of-contents.js", [], false, true );

  $alt_phone = '';

  $phone = get_post_meta($post->ID, 'wpsl_phone', true);
  $phone = wad_calltracking_replace(wad_return_calltracking_number(), $phone);

  $fax = get_post_meta($post->ID, 'wpsl_fax', true);
  $address = get_post_meta($post->ID, 'wpsl_address', true);
  $suite = get_post_meta($post->ID, 'wpsl_address2', true);
  $city = get_post_meta($post->ID, 'wpsl_city', true);
  $state = get_post_meta($post->ID, 'wpsl_state', true);
  $zip = get_post_meta($post->ID, 'wpsl_zip', true);
  $country = get_post_meta($post->ID, 'wpsl_country', true);
  $facebook = get_post_meta($post->ID, 'wpsl_facebook_url', true);
  $twitter = get_post_meta($post->ID, 'wpsl_twitter_url', true);
  $youtube = get_post_meta($post->ID, 'wpsl_youtube_url', true);
  $instagram = get_post_meta($post->ID, 'wpsl_instagram_url', true);
  $linkedin = get_post_meta($post->ID, 'wpsl_linkedin_url', true);
  $hh = get_post_meta($post->ID, 'wpsl_hh_url', true);
  $bbb = get_post_meta($post->ID, 'wpsl_bbb_url', true);
  $holiday_hours = get_post_meta($post->ID, 'wpsl_holiday_hours', true);
  $building = get_post_meta($post->ID, 'wpsl_neighborhood', true);
  $special_messages = get_post_meta($post->ID, 'wpsl_special_message', true);
  $destination = $address . ',' . $city . ',' . $zip;
  $direction_url = "https://maps.google.com/maps?saddr=&daddr=" . urlencode($destination) . "&travelmode=driving";
  $premium = get_field( 'premium_layout' );
  $microsite = get_field( 'microsite_layout' );
  $post_type = get_post_type();
  $gallery_images = get_field( 'gallery' );
  $background_image = '';
  $button = '';
  
  if ( have_rows( 'scheduler_options' ) ) :
    while ( have_rows( 'scheduler_options' ) ) : the_row(); 
      $scheduler = get_sub_field( 'online_appointment_scheduler' );
      $introduction = get_sub_field( 'introduction' );
      $blueprint_solutions = get_sub_field( 'blueprint_solutions' );
      $sycle = get_sub_field( 'sycle' );
    endwhile; 
  endif;

  if ( have_rows( 'title_design_options', 'location-options' ) ) :
    while ( have_rows( 'title_design_options', 'location-options' ) ) : the_row(); 
    $title_bg = get_sub_field( 'color_options' );
    $title_text_color = get_sub_field( 'text_color' );
    endwhile;
  endif; 

  if ( have_rows( 'quick_links_background' ) ) :
    while ( have_rows( 'quick_links_background' ) ) : the_row(); 
    $toc_bg = get_sub_field( 'color_options' );
    endwhile;
  endif; 
  
?>
<div class="location">
  <section class="location__header padding-y-xl bg-<?= $title_bg; ?> <?= ($title_text_color == 'white') ? 'text-white' : ''; ?>">
    <div class="container max-width-lg">
        <?php if ( $premium == true || $microsite == true ) : ?>
          <h1 class="text-center"><?php the_title(); ?></h1>
        <?php else : ?>
          <h1><?php the_title(); ?></h1>
        <?php endif; ?>
    </div>
  </section>
  <?php if( $premium == true || $microsite == true ) : ?>
    <section class="padding-y-lg bg-<?= $toc_bg; ?>">
      <div class="container max-width-lg text-center">
          <div class="table-contents ">
            <span class="padding-right-lg"><strong>On This Page:</strong></span>
            <ul id="toc" class="table-content__list list-reset flex flex-center"></ul>
          </div>
      </div>
    </section>
  <?php endif; ?>
  <section class="location__details padding-y-xxl">
    <div class="container max-width-lg">
      <div class="grid grid-gap-xl">
        <div class="col-6@md col-12">
          <div class="location__image">
            <?php if ($gallery_images) : ?>
                <div class="swiper-container location__gallery carousel--basic swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                
                  <div class="swiper-wrapper">
                  <?php foreach ( $gallery_images as $gallery_image ): ?>
                    <div class="swiper-slide">
                      <img src="<?php echo esc_url( $gallery_image['sizes']['4:2-retina'] ); ?>" alt="<?php echo esc_attr( $gallery_image['alt'] ); ?>" class="lazyload radius-md" />
                    </div>
                    
                  <?php endforeach ;?>
                  </div>
                  <div class="navigation-inline margin-top-lg">
                    <div class="swiper-navigation">
                      <div class="swiper-button-prev"></div>
                      <div class="swiper-pagination"></div>
                      <div class="swiper-button-next"></div>
                    </div>
                  </div>
                </div>
              <?php else : ?>
                <?php the_post_thumbnail( '16:9', array( 'class' => 'lazyload shadow-md radius-md' ) );  ?>
            <?endif; ?>
            
          </div>

          
          <div class="location__location-information margin-top-lg">
            <h3 class="margin-bottom-sm">Contact Us</h3>
            <div class="grid grid-gap-md">

              <div class="col-12 col-6@md text-component">
                <p class="location__phone location__detail-item">
                  <a href="tel:<?= $phone; ?>"><strong><?= $phone; ?></strong></a>
                </p>

                <?php if ( $alt_phone ): ?>
                  <p class="location__alt-phone location__detail-item">
                    <a href="tel:<?= $alt_phone; ?>">
                      <?= $alt_phone; ?>
                    </a>
                  </p>
                <?php endif; ?>

                <?php if ( $fax ): ?>
                  <p class="location__fax location__detail-item">
                    <a href="tel:<?= $fax; ?>">
                      <?= $fax; ?>
                    </a>
                  </p>
                <?php endif; ?>

                <p class="location__address location__detail-item" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                <span>
                  <span itemprop="streetAddress"><?php echo $address ?></span><br>
                  <?php if(!empty($suite)): ?>
                      <span><?php echo $suite; ?></span><br>
                  <?php endif; ?>
                  <span itemprop="addressLocality"><?php echo $city ?></span>, <span itemprop="addressRegion"><?php echo $state ?></span> <span itemprop="postalCode"><?php echo $zip ?></span> <br>
                </span>
                  <a href="<?= $direction_url; ?>" class="btn--link btn--icon-arrow location__btn-directions" target="_blank" rel="noopener noreferrer">Get Directions</a>
                </p>
                

                <?php if ( $building ): ?>
                  <p class="location__building location__detail-item"><?= $building; ?></p>
                <?php endif; ?>

                
                <?php if ( have_rows( 'social_media' ) ) : ?>
                  <p class="margin-bottom-0"><strong>Connect with us:</strong></p>
                  <ul class="location-social__list flex">
                    <?php while ( have_rows( 'social_media' ) ) : the_row(); ?>
                      <?php 
                        $provider_icon = get_sub_field( 'platform' ); 
                        $provider = get_sub_field( 'platform' );
                        switch( $provider_icon ) {
                          case 'facebook':
                            $provider_icon = '<i class="fab fa-facebook-f"></i>';
                            break;
                          case 'instagram':
                            $provider_icon = '<i class="fab fa-instagram"></i>';
                            break;
                          case 'twitter':
                            $provider_icon = '<i class="fab fa-twitter"></i>';
                            break;
                          case 'youtube':
                            $provider_icon = '<i class="fab fa-youtube"></i>';
                            break;
                          case 'google':
                            $provider_icon = '<i class="fab fa-google"></i>';
                            break;
                          case 'yelp':
                            $provider_icon = '<i class="fab fa-yelp"></i>';
                            break;
                          case 'linkedin':
                            $provider_icon = '<i class="fab fa-linkedin"></i>';
                            break;
                          case 'bbb':
                            $provider_icon = '<img src="'. get_template_directory_uri().'/images/svgs/bbb_color.svg" alt="">';
                            break;
                          case 'healthy-hearing':
                            $provider_icon = '<img src="'. get_template_directory_uri().'/images/svgs/healthy-hearing_color.svg" alt="">';
                            break;
                          default:
                        }

                        $provider_url = get_sub_field( 'url' );
                      ?>
                      
                      <li class="location-social__item">
                        <a class="location-social__link location-social__link--<?= $provider; ?>" href="<?php echo esc_url( $provider_url ); ?>"><?= $provider_icon; ?></a>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                <?php endif; ?>
                
              </div>

              <div class="col-12 col-6@md">
                <?= do_shortcode( '[wpsl_hours]' ); ?>
                
                <?php if ( $holiday_hours ): ?>
                  <div class="location__holiday-hours">
                    <?= $holiday_hours ?>
                  </div>
                <?php endif; ?>
                
              </div>
            </div>
          </div>

          <div class="location__special-message margin-top-lg text-component">
            <?= $special_messages; ?>
          </div>
          
        </div>
        <div class="col-6@md col-12">
          <?= do_shortcode( '[wpsl_map zoom="19"]' ); ?>
          <div class="location__contact bg-primary-500 padding-md margin-top-lg text-component text-white radius-lg <?= $microsite== true ? 'flex items-center justify-between' : '' ?>">
              <?php if ( have_rows( 'contact_form' ) ) : ?>
                <?php while ( have_rows( 'contact_form' ) ) : the_row(); ?>
                  <?= ($microsite == true || get_sub_field( 'contact_form' ) == null) ? '<div class=" location__contact-wrap flex items-center justify-between width-100">' : ''?>
                    <h3 class="<?= ( $microsite == true || get_sub_field( 'contact_form' ) == null ) ? 'margin-bottom-0' : '' ?>"><?php the_sub_field( 'title' ); ?></h3>
                    <?php if ( $microsite == true || get_sub_field( 'contact_form' ) == null ) :?>
                      <a href="#schedule-online" class="btn btn--white ">Schedule Today!</a>
                    <?php else : ?>
                      <?php echo  do_shortcode( get_sub_field( 'contact_form' ) ); ?>
                    <?php endif; ?>
                  <?= ($microsite == true || get_sub_field( 'contact_form' ) == null) ? '</div>' : ''?>
                <?php endwhile; ?>
              <?php endif; ?>
            </div>
        </div>
      </div>
    </div>
  </section>

  <?php if ( $premium != true ) : ?> 
    <?php if ( have_rows( 'scheduler_options' ) ) : ?>
      
      <?php while ( have_rows( 'scheduler_options' ) ) : the_row(); 
        $scheduler = get_sub_field( 'online_appointment_scheduler' );
        $introduction = get_sub_field( 'introduction' );
        $blueprint_solutions = get_sub_field( 'blueprint_solutions' );
        $sycle = get_sub_field( 'sycle' );
      ?>
        
        <?php if ( $scheduler === 'blueprint') : ?>
          <section class="location__schedule bg-color-tertiary-100 padding-y-xxxl">
            <div class="container max-width-md text-component text-center">
              <?= $introduction ?>
              <div class="media-wrapper"><?= $blueprint_solutions; ?></div>
            </div>
          </section>

        <?php elseif ( $scheduler === 'sycle' ) : ?>

          <section class="location__schedule bg-color-tertiary-100 padding-y-xxxl">
            <div class="container max-width-md text-component text-center">
              <?= $introduction ?>
              <script type="text/javascript">!function(){window.__ct = window.__ct || [];__ct.token='$sycle';__ct.adSource='1';var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://sycle.audiologydesign.com/assets/js/sycle_script.js";var e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(t,e)}();</script><!-- add below div in your html where do you wish to see the sycle widget--><div id="ad-sycle-form"></div>
            </div>
          </section>

        <?php endif; ?>
      <?php endwhile; ?>

    <?php endif; ?>
  <?php endif; ?>

  <?php if ( $premium == true ) :
    get_template_part('template-parts/blocks/content/location-premium');
  endif; ?>
  <?php if ( $microsite == true ) :
    get_template_part('template-parts/blocks/content/location-microsite');
  endif; ?>
</div>