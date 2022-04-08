
<?php  if ( have_rows( 'introduction' ) ) : ?>
  <section class="location__introduction padding-y-xxl toc-item" id="our-clinic">
    <div class="container max-width-lg">
      <div class="grid grid-gap-xxxl flex-center">
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
                    <div class="staff__item-details">
                    <h3 class="margin-top-md text-md"><?php the_title(); ?></h3>
                    <p class="text-sm font-primary text-uppercase margin-y-sm"><strong><?php echo the_field( 'job_title', $post->ID ); ?></strong></p>
                    <a href="<?php the_permalink(); ?>" class="btn--link btn--icon-arrow">View Profile</a>                  
                    </div>
                    
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
    <?php 
      $brands_query = new WP_Query( array(
        'post_type' => 'products',
        'order' => 'ASC',
        'orderby' => 'title',
        'tax_query' => array(
          array (
              'taxonomy' => 'product_type',
              'field' => 'slug',
              'terms' => 'maufacturer',
          )
        ),
      ) );
      $count = $brands_query->found_posts;
      if ( $brands_query->have_posts() ) : ?>
        <div class="location__product-list margin-top-xl">
          <div class="container">
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
          </div>
        </div>
      <?php endif; wp_reset_postdata(); ?> 
  </section>
<?php endif; ?>

<?php if ( have_rows( 'reviews' ) ) : ?>
  <?php while ( have_rows( 'reviews' ) ) : the_row(); 
    $hide_section = get_sub_field( 'hide_section' );
  ?>
    <?php if ($hide_section == false ) : ?>
      <section class="location__reviews padding-y-xxl text-center toc-item" id="reviews" style="background-image: url(<?php echo get_template_directory_uri() . '/images/bg-location_reviews.jpg'; ?>);">
        <div class="location__reviews--overlay"></div>
        <div class="container max-width-md">

          
          <?php the_sub_field( 'introduction' ); ?>

          <div class="reviews_embed margin-y-md">
            <?php the_sub_field( 'reviews_embed' ); ?>
          </div>
    
          <a href="<?php echo esc_url( $button); ?>" class="btn btn--primary">View Reviews</a>
        </div>
      </section>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>

<?php if ( have_rows( 'contact' ) ) : ?>
  <?php while ( have_rows( 'contact' ) ) : the_row(); 
    $scheduler = get_sub_field( 'online_appointment_scheduler' );
    $introduction = get_sub_field( 'introduction' );
    $blueprint_solutions = get_sub_field( 'blueprint_solutions' );
    $sycle = get_sub_field( 'sycle' );
    $custom = get_sub_field( 'custom' );
    $background_color = get_sub_field( 'color_options' );
    $hide_section = get_sub_field( 'hide_section' );
  ?>
  <?php if ($hide_section == false): ?>
    <section class="location__schedule bg-<?= $background_color; ?> padding-y-xxxl toc-item" id="schedule-online">
      <div class="container max-width-md text-component text-center">
        <?php the_sub_field( 'introduction' ); ?>
        
        <?php if ( $scheduler == 'blueprint' ) : ?>
          <div class="media-wrapper"><?= $blueprint_solutions; ?></div>
        <?php elseif ( $scheduler == 'sycle' ) : ?>
          <script type="text/javascript">!function(){window.__ct = window.__ct || [];__ct.token='$sycle';__ct.adSource='1';var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://sycle.audiologydesign.com/assets/js/sycle_script.js";var e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(t,e)}();</script><!-- add below div in your html where do you wish to see the sycle widget--><div id="ad-sycle-form"></div>
        <?php elseif ( $scheduler == 'custom' ) : ?>
          <div class="media-wrapper"><?= $custom; ?></div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>