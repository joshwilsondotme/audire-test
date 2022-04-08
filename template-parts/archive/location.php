<?php 
  wp_enqueue_script("map-js", get_template_directory_uri()."/dist/assets/js/location-map.js", [], false, true );

  wp_enqueue_script('google-map-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCajZKL139FWm3lDrHTz76xU0mvcPwLLmY', [], false, true );
  $location = get_field( 'location_information', $post->ID );
  $phone = get_field( 'phone' );
  $alt_phone = get_field( 'alt_phone' );
  $fax = get_field( 'fax' );
  $email = get_field( 'email' );
  $address = $location['address'];
  $building = get_field( 'building' );
  $special_messages = get_field( 'special_messages' );
  $holiday_hours = get_field( 'holiday_hours' );
  $premium = get_field( 'premium_layout' );
  
  /**
   * TODO:
   * Filter Options: Category type
   * Search: ZIP Code future enhancement
   * Layout Options: Single Location, Mutliple Locations, Multiple States, Multiple 
   * table of contents for states (logic )
   * Featured Clinic
   * Clinic Types
   * 
   * Address, Phone, Featured Image, Category(Clinic Type)
   */

  
?>
<div class="location-overview">
<section class="location-overview__header bg-neutral-200 padding-y-xxxl">
    <div class="container max-width-lg">
        <h1>All Locations</h1>
    </div>
  </section>
  <div class="container max-width-lg padding-top-xl">
    <section class="location-overview__map">
      <?php 
        $location_query = new WP_Query( array(
          'post_type' => 'location',
          'order' => 'ASC',
          'orderby' => 'menu_order title',
        ) );
      ?>
      <?php if ( $location_query->have_posts() ) : ?>
        <div class="location__map margin-bottom-xxl" data-zoom="18">
          <?php while ( $location_query->have_posts() ) : $location_query->the_post(); 
            $location = get_field( 'location_information', $post->ID );
            $phone = get_field( 'phone', $post->ID );
            $alt_phone = get_field( 'alt_phone', $post->ID );
            $fax = get_field( 'fax', $post->ID );
            $email = get_field( 'email', $post->ID );
            $address = $location['address'];
            $holiday_hours = get_field( 'holiday_hours', $post->ID );
            
          ?>
            <div class="location__map-marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>">
              <?= $location['address']; ?>
            </div>
          <?php endwhile; ?>
        </div>
        
      <?php endif; wp_reset_postdata(); ?>
    </section>
    <?php if ( have_posts() ) : ?>
      <div class="location-overview__list grid grid-gap-xxl">
        <?php while ( have_posts() ) : the_post(); 
          $location = get_field( 'location_information', $post->ID );
          $phone = get_field( 'phone', $post->ID );
          $alt_phone = get_field( 'alt_phone', $post->ID );
          $fax = get_field( 'fax', $post->ID );
          $email = get_field( 'email', $post->ID );
          $address = $location['address'];
          $city = $location['city'];
          $state = $location['state_short'];
          $state_long = $location['state'];
          $holiday_hours = get_field( 'holiday_hours', $post->ID );
        ?>
        <div class="col-6@md col-12">
          <div class="location-overview__card ">
            <?php if ( has_post_thumbnail( $post_id ) ) : ?>
              <div class="location-overview__image">
                <div class="location-overview__city"><?= $city; ?>, <?= $state; ?></div>
                <?php the_post_thumbnail( '4:3-vertical', array( 'class' => 'lazyload' ) );  ?>
              </div>
            <?php endif; ?>
            <div class="location-overview__details text-component">
              <h2 class="text-md"><?php the_title(); ?></h2>
              <p class="location__phone location__detail-item">
                  <a href="tel:<?= $phone; ?>"><strong><?= $phone; ?></strong></a>
              </p>
              <p class="location__address location__detail-item">
                <?php echo $address; ?>
              </p>
              <a href="<?php the_permalink(); ?>" class="btn btn--primary width-100">Contact Clinic</a>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>
</div>