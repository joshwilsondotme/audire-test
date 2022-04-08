<?php 
  include( TEMPLATEPATH . '/acf-layouts/settings/settings-section.php' ) ;
  include( TEMPLATEPATH . '/acf-layouts/settings/settings-column.php' ) ;
  global $wpsl_settings, $wpsl;
  
  $args = array(
    'post_type' => 'wpsl_stores'
  );
  $the_query = new WP_Query( $args );
  
 
  // The Loop
  if ( $the_query->have_posts() ) : ?>
  <section 
    class="hp-section hp-section__location hp-section__location--single_confined hp-section__location-<?= $count; ?> padding-top-<?=$section_pad_top;?> padding-bottom-<?=$section_pad_bottom; ?> bg-<?= $section_bg; ?>"

    <?php echo ($section_bg_image) ? 'style="background-image:url('.$bg_image.'); background-size: cover; background-position:' .$section_bg_x_pos.' '.$section_bg_y_pos.';"' : '' ;?>
  >
    <?php if( $section_bg_overlay == 1 ) : ?>
      <div class="hp-section__overlay bg-<?= $overlay_color; ?>" style="opacity: <?= $overlay_opacity; ?>%"></div>
    <?php endif; ?>

    <div class="container max-width-<?= $section_container; ?> justify-center">
      <div class="container__inner bg-contrast-100 padding-md radius-md shadow-md">
      <div class="grid grid-gap-xl justify-center">

        <?php while ( $the_query->have_posts() ) : $the_query->the_post();
          $phone = get_post_meta(get_the_ID(), 'wpsl_phone', true);
          $phone = wad_calltracking_replace(wad_return_calltracking_number(), $phone);
          $fax = get_post_meta(get_the_ID(), 'wpsl_fax', true);
          $address = get_post_meta(get_the_ID(), 'wpsl_address', true);
          $suite = get_post_meta(get_the_ID(), 'wpsl_address2', true);
          $city = get_post_meta(get_the_ID(), 'wpsl_city', true);
          $state = get_post_meta(get_the_ID(), 'wpsl_state', true);
          $zip = get_post_meta(get_the_ID(), 'wpsl_zip', true);
          $destination = $address . ',' . $city . ',' . $zip;
          $direction_url = "https://maps.google.com/maps?saddr=&daddr=" . urlencode($destination) . "&travelmode=driving";
        ?>
          <div class="col-7@md col-12">
            <?php echo do_shortcode( '[wpsl_map id="'. get_the_ID() .'" zoom="19"]'); ?>
          </div>
          <div class="col-5@md col-12 text-component">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail( '16:10', array( 'class' => 'lazyload shadow-md radius-md margin-bottom-md' ) );  ?>
            <?php endif; ?>

            <h2 class="text-lg"><?php the_title(); ?></h2>
            
            <p class="location__address location__detail-item" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
              <span>
                <span itemprop="streetAddress"><?php echo $address ?></span> 
                <?php if(!empty($suite)): ?>
                    <span><?php echo $suite; ?></span> 
                <?php endif; ?>
                <span itemprop="addressLocality"><?php echo $city ?></span>, <span itemprop="addressRegion"><?php echo $state ?></span> <span itemprop="postalCode"><?php echo $zip ?></span> <br>
              </span>
            </p>
            
            <p class="location__phone location__detail-item">
              <a href="tel:<?= $phone; ?>"><strong><?= $phone; ?></strong></a>
            </p>

            <a href="<?php echo esc_url(the_permalink()); ?>" class="btn btn--primary btn--sm">Contact Clinic</a> 

            <a href="<?= $direction_url; ?>" class="btn btn--secondary btn--sm" target="_blank" rel="noopener noreferrer">Get Directions</a>
            
          </div>
        <?php endwhile; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
  
<?php wp_reset_postdata(); ?>
