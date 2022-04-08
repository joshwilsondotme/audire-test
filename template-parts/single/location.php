<?php 

wp_enqueue_script("map-js", get_template_directory_uri()."/dist/assets/js/location-map.js", [], false, true );

wp_enqueue_script('google-map-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCajZKL139FWm3lDrHTz76xU0mvcPwLLmY', [], false, true );

wp_enqueue_script("logo-carousel", get_template_directory_uri()."/dist/assets/js/logo-carousel.js", ['swiper-js'], false, true );

wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], false, true );

wp_enqueue_script("table-of-contents", get_template_directory_uri()."/dist/assets/js/table-of-contents.js", [], false, true );
/**
 * Todo:
 * ==Layouts==
 * Premium Layout
 * ==Location Details (Basic && Premium)==
 * Image or Carousel
 * Contact Form

 * ==Premium Sections==
 * Introduction
 * Staff Options
 * Services
 * Products
 * Maufacturer Logo List
 * Reviews
 * Schedule Apppointment (Same as Staff Profile)
 */

  $location = get_field( 'location_information' );
  $phone = get_field( 'phone' );
  $alt_phone = get_field( 'alt_phone' );
  $fax = get_field( 'fax' );
  $email = get_field( 'email' );
  $address = $location['address'];
  $building = get_field( 'building' );
  $special_messages = get_field( 'special_messages' );
  $holiday_hours = get_field( 'holiday_hours' );
  $premium = get_field( 'premium_layout' );
  $post_type = get_post_type();
  

  // if ( have_rows( 'scheduler_options' ) ) :
  //   while ( have_rows( 'scheduler_options' ) ) : the_row(); 
  //     $scheduler = get_sub_field( 'online_appointment_scheduler' );
  //     $introduction = get_sub_field( 'introduction' );
  //     $blueprint_solutions = get_sub_field( 'blueprint_solutions' );
  //     $sycle = get_sub_field( 'sycle' );
  //   endwhile; 
  // endif;

?>
<div class="location">
  <section class="location__header bg-neutral-200 padding-y-xxl">
    <div class="container max-width-lg text-center">
        <h1><?php the_title(); ?></h1>
    </div>
  </section>
  <?php if( $premium == true ) : ?>
    <?php include( TEMPLATEPATH . '/template-parts/components/table-of-contents.php' ) ;?>
  <?php endif; ?>
  <section class="location__details padding-y-xxl">
    <div class="container max-width-lg">
      <div class="grid grid-gap-lg">
        <div class="col-6@md col-12">
          <div class="location__image">
            <?php the_post_thumbnail( '16:9', array( 'class' => 'lazyload shadow-md' ) );  ?>
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

                <p class="location__address location__detail-item">
                  <?= $location['address']; ?>
                  <a href="https://www.google.com/maps/place/<?php echo esc_attr($location['address']); ?>" class="btn--link btn--icon-arrow location__btn-directions" target="_blank" rel="noopener noreferrer">Get Directions</a>
                </p>
                

                <?php if ( $building ): ?>
                  <p class="location__building location__detail-item"><?= $building; ?></p>
                <?php endif; ?>
                
                <?php if ( have_rows( 'social_media' ) ) : ?>
                  <p><strong>Connect with us:</strong></p>
                  <ul class="location-social__list flex">
                    <?php while ( have_rows( 'social_media' ) ) : the_row(); ?>
                      <?php 
                        $provider_icon = get_sub_field( 'platform' ); 
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
                        <a class="location-social__link" href="<?php echo esc_url( $provider_url ); ?>"><?= $provider_icon; ?></a>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                <?php endif; ?>
                
              </div>

              <div class="col-12 col-6@md">
                <?php if ( have_rows( 'hours' ) ) : ?>
                  <ul class="location__hours">
                  <?php while ( have_rows( 'hours' ) ) : the_row(); ?>
                    <li>
                      <span>Monday: </span>
                      <span><?php the_sub_field( 'monday' ); ?></span>
                    </li>
                    <li>
                      <span>Tuesday: </span>
                      <span><?php the_sub_field( 'tuesday' ); ?></span>
                    </li>
                    <li>
                      <span>Wednesday: </span>
                      <span><?php the_sub_field( 'wednesday' ); ?></span>
                    </li>
                    <li>
                      <span>Thursday: </span>
                      <span><?php the_sub_field( 'thursday' ); ?></span>
                    </li>
                    <li>
                      <span>Friday: </span>
                      <span><?php the_sub_field( 'friday' ); ?></span>
                    </li>
                    <li>
                      <span>Saturday: </span>
                      <span><?php the_sub_field( 'saturday' ); ?></span>
                    </li>
                    <li>
                      <span>Sunday: </span>
                      <span><?php the_sub_field( 'sunday' ); ?></span>
                    </li>
                  <?php endwhile; ?>
                  
                </ul>
                <?php endif; ?>
                <div class="location__holiday-hours">
                <?php if ( $holiday_hours ): ?>
                  <?= $holiday_hours ?>
                <?php endif; ?>
                </div>
                
              </div>
            </div>
          </div>

          <div class="location__special-message margin-top-lg text-component">
            <?= $special_messages; ?>
          </div>
          
        </div>
        <div class="col-6@md col-12">
          <?php if( $location ): ?>
            <div class="location__map" data-zoom="18">
              <div class="location__map-marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>">
                <?= $location['address']; ?>
              </div>
            </div>
            <div class="location__contact bg-tertiary-500 padding-md margin-top-lg text-component text-white radius-lg">
              <?php if ( have_rows( 'contact_form' ) ) : ?>
                <?php while ( have_rows( 'contact_form' ) ) : the_row(); ?>
                  <h3><?php the_sub_field( 'title' ); ?></h3>
                  <?php echo  do_shortcode( get_sub_field( 'contact_form' ) ); ?>
                  
                <?php endwhile; ?>
              <?php endif; ?>
            </div>
          <?php endif; ?>
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
              <div class="media-wrapper--blueprint"><?= $blueprint_solutions; ?></div>
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

  <?php if ( $premium == true ) : ?>

    <?php if ( have_rows( 'introduction' ) ) : ?>
      <section class="location__introduction padding-y-xxl toc-item" id="our-clinic">
        <div class="container max-width-lg">
          <div class="grid grid-gap-xxxl">
            <?php while ( have_rows( 'introduction' ) ) : the_row(); ?>
              <div class="col-5@md col-12">
                <?php $image = get_sub_field( 'image' ); ?>
                <?php if ( $image ) : ?>
                  <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                  <?php else : ?>
                    <img loading="lazy" src="<?php echo get_template_directory_uri() . '/images/location-intro-image.jpg' ;?>" alt="Office introduction" class="lazyload radius-md shadow-md">
                <?php endif; ?>
              </div>
              <div class="col-7@md col-12 text-component">
                <?php the_sub_field( 'content' ); ?>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <?php if ( have_rows( 'staff' ) ) : ?>
      <section class="location__introduction padding-y-xxl bg-neutral-100 toc-item" id="staff">
        <div class="container max-width-lg">
          <div class="grid grid-gap-xxxl items-center">
            <?php while ( have_rows( 'staff' ) ) : the_row(); ?>
              <div class="col-6@md col-12 text-component">
                <?php the_sub_field( 'content' ); ?>
              </div>
              <div class="col-6@md col-12">
                <?php $staff_selector = get_sub_field( 'staff_selector' ); ?>
                <?php if ( $staff_selector ) : ?>
                  <ul class="staff__list flex item-center flex-wrap flex-gap-lg">
                    <?php foreach ( $staff_selector as $post ) : ?>
                      <?php setup_postdata ( $post ); ?>
                      <li class="staff__item text-center">
                        <?php the_post_thumbnail( '1:1', array( 'class' => 'lazyload shadow-md radius-md' ) );  ?>
                        
                        <h3 class="margin-top-md text-md"><?php the_title(); ?></h3>
                        <p class="text-sm font-primary text-uppercase margin-y-sm"><strong><?php echo the_field( 'job_title', $post->ID ); ?></strong></p>
                        <a href="<?php the_permalink(); ?>" class="btn--link btn--icon-arrow">View Profile</a>
                      </li>

                    <?php endforeach; ?>
                  </ul>
                  
                  <?php wp_reset_postdata(); ?>
                <?php endif; ?>
              </div>
              
            
            <?php endwhile; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <?php if ( have_rows( 'products_services' ) ) : ?>
      <section class="location__services-products padding-y-xxl toc-item" id="services-and-products">
        <div class="container max-width-lg">
          <?php while ( have_rows( 'products_services' ) ) : the_row(); ?>

            <div class="container max-width-md text-component text-center margin-bottom-xxl">
              <?php the_sub_field( 'introduction' ); ?>
            </div>

            <div class="grid grid-gap-xxl items-center">
              <div class="col-5@md col-12">
                <?php $services_image = get_sub_field( 'services_image' ); ?>
                <?php if ( $services_image ) : ?>
                  <img src="<?php echo esc_url( $services_image['url'] ); ?>" alt="<?php echo esc_attr( $services_image['alt'] ); ?>" />
                <?php else: ?>
                  <img loading="lazy" src="<?php echo get_template_directory_uri() . '/images/get-page_services-image.jpg' ;?>" alt="Office introduction" class="lazyload">
                <?php endif; ?>
              </div>

              <div class="col-7@md col-12 text-component">
                <?php the_sub_field( 'services_content' ); ?>
                <?php $services_list = get_sub_field( 'services_list' ); ?>
                <?php if ( $services_list ) : ?>
                  <ul class="icon-list icon-list--check icon-list--color-primary two-column-flex-list">
                    <?php foreach ( $services_list as $post ) : ?>
                      <?php setup_postdata ( $post ); ?>
                      <li><?php the_title(); ?></li>
                    <?php endforeach; ?>
                  </ul>
                  <?php wp_reset_postdata(); ?>
                <?php endif; ?>
                <?php $services_button = get_sub_field( 'services_button' ); ?>
                <?php if ( $services_button ) : ?>
                  <a class="btn btn--primary" href="<?php echo esc_url( $services_button); ?>">View Services</a>
                <?php endif; ?>
              </div>

            </div>
            
            <div class="grid grid-gap-xxl items-center margin-top-xl">

              <div class="col-7@md col-12 text-component">
                <?php the_sub_field( 'products_content' ); ?>
                <?php $products_list = get_sub_field( 'products_list' ); ?>
                <?php if ( $products_list ) : ?>
                  <ul class="icon-list icon-list--check icon-list--color-primary two-column-flex-list">
                    <?php foreach ( $products_list as $post ) : ?>
                      <?php setup_postdata ( $post ); ?>
                      <li><?php the_title(); ?></li>
                    <?php endforeach; ?>
                  </ul>
                  <?php wp_reset_postdata(); ?>
                <?php endif; ?>
                <?php $products_link = get_sub_field( 'products_link' ); ?>
                <?php if ( $products_link ) : ?>
                  <a href="<?php echo esc_url( $products_link); ?>" class="btn btn--primary">View Products</a>
                <?php endif; ?>
              </div>

              <div class="col-5@md col-12">
                <?php $products_image = get_sub_field( 'products_image' ); ?>
                <?php if ( $products_image ) : ?>
                  <img src="<?php echo esc_url( $products_image['url'] ); ?>" alt="<?php echo esc_attr( $products_image['alt'] ); ?>" />
                <?php else: ?>
                  <img loading="lazy" src="<?php echo get_template_directory_uri() . '/images/geo-page_hearing-aids.jpg' ;?>" alt="Hearing aids" class="lazyload">
                <?php endif; ?>
              </div>
            </div>
          <?php endwhile; ?>
        </div>

        <div class="location__product-list margin-top-xl">
          <div class="container">
            <?php 
              $brands_query = new WP_Query( array(
                'post_type' => 'products',
                'order' => 'ASC',
                'orderby' => 'menu_order title',
                'tax_query' => array(
                  array (
                      'taxonomy' => 'product_type',
                      'field' => 'slug',
                      'terms' => 'maufacturers',
                  )
                ),
              ) );
              $count = $brands_query->found_posts;
              if ( $brands_query->have_posts() ) : ?>
                <?php if ($count <= 4 ); ?>
                <div class="swiper-container logo-carousel logo-carousel--small-logo">
                    <div class="swiper-wrapper">
                      <?php while ( $brands_query->have_posts() ) : $brands_query->the_post(); ?>
                        <div class="swiper-slide">
                          <?php the_post_thumbnail( '4:2', array( 'class' => 'lazyload' ) );  ?>
                        </div>
                      <?php endwhile; ?>
                    </div>
                    <div class="swiper-navigation">
                      <div class="swiper-button-prev"></div>
                      <div class="swiper-pagination"></div>
                      
                      <div class="swiper-button-next"></div>
                    </div>
                  </div>
                <?php else : ?>
                <ul class="assocation__list flex justify-center flex-gap-lg list-reset">
                  <?php while ( $brands_query->have_posts() ) : $brands_query->the_post(); ?>
                    <?php the_post_thumbnail( '4:2', array( 'class' => 'lazyload' ) );  ?>
                  <?php endwhile; ?>
                </ul>
              <?php endif; wp_reset_postdata(); ?> 
          </div>
        </div>
      </section>
    <?php endif; ?>

    <?php if ( have_rows( 'reviews' ) ) : ?>
      <section class="location__reviews padding-y-xxl text-center toc-item" id="reviews" style="background-image: url(<?php echo get_template_directory_uri() . '/images/bg-location_reviews.jpg'; ?>);">
        <div class="location__reviews--overlay"></div>
        <div class="container max-width-md">
          <img src="<?php echo esc_url( $background_image['url'] ); ?>" alt="<?php echo esc_attr( $background_image['alt'] ); ?>" />
          <?php while ( have_rows( 'reviews' ) ) : the_row(); ?>
          <?php the_sub_field( 'introduction' ); ?>

          <div class="reviews_embed margin-y-md">
            <?php the_sub_field( 'reviews_embed' ); ?>
          </div>
    
          <a href="<?php echo esc_url( $button); ?>" class="btn btn--primary">View Reviews</a>
        </div>
      </section>
      
      <?php endwhile; ?>
    <?php endif; ?>

    <?php if ( have_rows( 'contact' ) ) : ?>
      <section class="location__schedule bg-neutral-100 padding-y-xxxl toc-item" id="schedule-online">
        <div class="container max-width-md text-component text-center">
          <?php while ( have_rows( 'contact' ) ) : the_row(); 
            $scheduler = get_sub_field( 'online_appointment_scheduler' );
            $introduction = get_sub_field( 'introduction' );
            $blueprint_solutions = get_sub_field( 'blueprint_solutions' );
            $sycle = get_sub_field( 'sycle' );
            $custom = get_sub_field( 'custom' );
          ?>
            <?php the_sub_field( 'introduction' ); ?>
            <?php if ( $scheduler == 'blueprint' ) : ?>
              <div class="media-wrapper"><?= $blueprint_solutions; ?></div>
            <?php elseif ( $scheduler == 'sycle' ) : ?>
              <script type="text/javascript">!function(){window.__ct = window.__ct || [];__ct.token='$sycle';__ct.adSource='1';var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://sycle.audiologydesign.com/assets/js/sycle_script.js";var e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(t,e)}();</script><!-- add below div in your html where do you wish to see the sycle widget--><div id="ad-sycle-form"></div>
            <?php elseif ( $scheduler == 'custom' ) : ?>
              <div class="media-wrapper"><?= $custom; ?></div>
            <?php endif; ?>
          <?php endwhile; ?>
        </div>
      </section>
    <?php endif; ?>

  <?php endif; ?>
</div>