<?php
  wp_enqueue_script("accordion-js", get_template_directory_uri()."/dist/assets/js/accordion.js", [], false, true );
  
  wp_enqueue_script("table-of-contents", get_template_directory_uri()."/dist/assets/js/table-of-contents.js", [], false, true );
  wp_enqueue_script("tabs-js", get_template_directory_uri()."/dist/assets/js/tabs.js", [], false, true );
  
?>

<?php if ( have_rows( 'introduction_microsite' ) ) : ?>
	<?php while ( have_rows( 'introduction_microsite' ) ) : the_row(); 
    $bg_color = get_sub_field( 'color_options' );
  ?>
    <section class="location__introduction padding-y-xxl toc-item bg-<?= $bg_color; ?>" id="our-practice">
      <div class="container max-width-lg">
        
          <?php if ( have_rows( 'introduction' ) ) : ?>
            <?php while ( have_rows( 'introduction' ) ) : the_row();
              $photo_side = get_sub_field( 'image_position' );
            ?>
              <div class="grid grid-gap-xl justify-center items-center">
                <?php if ( get_sub_field( '2_column_layout' ) == false ) : ?>
                  <div class="col-8@md col-12 text-component "><?php the_sub_field( 'content' ); ?></div>
                <?php else : ?>
                  
                  <div class="col-6@md col-12 text-component <?= ($photo_side == 'left') ? 'order-2' : 'order-1';?>"><?php the_sub_field( 'content' ); ?></div>
                  <div class="col-6@md col-12 text-component <?= ($photo_side == 'left') ? 'order-1' : 'order-2';?>">
                    <?php $image = get_sub_field( 'image' ); ?>
                    <?php if ( $image ) : ?>
                      <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" class="shadow-sm radius-md" />
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>

          <?php if ( have_rows( 'staff' ) ) : ?>
            <?php while ( have_rows( 'staff' ) ) : the_row(); ?>
              <div class="grid justify-center margin-top-xxl">
                <div class="col-6@md col-12 text-component">
                  <?php the_sub_field( 'content' ); ?>
                </div>
              </div>
              
              <?php $staff_selector = get_sub_field( 'staff_selector' ); ?>
              <?php if ( $staff_selector ) : ?>
                <ul class="staff__list staff__list--micro flex item-center justify-center flex-gap-lg margin-top-xl">
                  <?php foreach ( $staff_selector as $post ) : ?>
                    <?php setup_postdata ( $post ); ?>
                    <li class="staff__item staff__item--micro text-center flex items-center">
                      <?php the_post_thumbnail( '1:1', array( 'class' => 'lazyload shadow-md radius-md' ) );  ?>
                      <div class="staff__item-details">
                        <h3 class="margin-top-md text-md"><?php the_title(); ?></h3>
                        <p class="text-sm font-primary text-uppercase margin-y-sm"><strong><?php echo the_field( 'job_title', $post->ID ); ?></strong></p>
                        <a href="<?php the_permalink(); ?>" class="btn--link btn--icon-arrow">View Profile</a>
                      </div>
                    </li>
                    </li>
                  <?php endforeach; ?>
                  <?php wp_reset_postdata(); ?>
                </ul>
              <?php endif; ?>
            <?php endwhile; ?>
          <?php endif; ?>
        
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>
<?php 
  // Services Section
  if ( have_rows( 'services_microsite' ) ) : ?>
  <section class="location__services padding-y-xxl toc-item" id="services">
	<?php while ( have_rows( 'services_microsite' ) ) : the_row(); 
    $columns = get_sub_field( 'accordion_style' );
  ?>
    <div class="container max-width-lg">
      <div class="grid grid-gap-xxl <?= (get_sub_field( 'vertical_align_content' ) == true ) ? 'items-center' : '' ;?>">
        <div class="col-6@md col-12">
          <?php the_sub_field( 'content' ); ?>
        </div>
        <div class="col-6@md col-12">
          <?php $image = get_sub_field( 'image' ); ?>
          <?php if ( $image ) : ?>
            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" class="shadow-sm radius-md" />
          <?php endif; ?>
        </div>
      </div>
    </div>
		<div class="container max-width-lg margin-top-xxl">
      <div class="grid grid-gap-xxl">
        
          <?php if ( $columns == 'one' ) : ?>
            <div class="col-6@md col-12">
              <?php 
                $services_list = get_sub_field( 'services_list' );
                if ( $services_list ) : 
                $count = 0;
                $i = 0;
              ?>
                <div id="accordionGroup-left" class="accordion" data-allow-toggle data-allow-multiple>
                  <?php foreach ( $services_list as $post ) : 
                    $count++; $i++;
                    setup_postdata ( $post );
                    
                  ?>
                    <div class="accordion__item">
                      <h3>
                        <button aria-expanded="<?= ($i == 1) ? "true" : "false" ?>"
                                class="accordion__trigger"
                                aria-controls="hearing-tests-sec<?= $count; ?>"
                                id="hearing-tests-accordion<?= $count; ?>id">
                          <span class="accordion__title">
                            <?php the_title(); ?>
                            <span class="accordion__icon"></span>
                          </span>
                        </button>
                      </h3>

                      <div id="hearing-tests-sec<?= $count; ?>"
                          role="region"
                          aria-labelledby="hearing-tests-accordion<?= $count; ?>id"
                          class="accordion__panel"
                          <?= ($i == 1) ? "" : "hidden" ?>>
                        <div class="accordion__panel-inner">
                          <?php the_excerpt(  ); ?>
                          <a href="<?php the_permalink(); ?>" class="btn--link btn--icon-arrow">More on <?php the_title(); ?></a>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                  <?php wp_reset_postdata(); ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <?php if ( $columns == "two"): ?>
            <div class="col-6@lg col-12 text-component">
              <?php
                $services_list = get_sub_field( 'services_list' );
                if ( $services_list ) : 
                $count = 0;
                $i = 0;  ?>

                  <div id="accordionGroup-left" class="accordion" data-allow-toggle data-allow-multiple>

                  <?php 
                    foreach ( $services_list as $post ) : 
                    $count++; $i++;
                    setup_postdata ( $post );
                    $post_count = count($services_list);
                    $alternative_excerpt = get_field( 'alternative_excerpt' );
                  ?>

                    <div class="accordion__item">
                      <h3>
                        <button aria-expanded="<?= ($i == 1) ? "true" : "false" ?>"
                                class="accordion__trigger"
                                aria-controls="hearing-tests-sec<?= $count; ?>"
                                id="hearing-tests-accordion<?= $count; ?>id">
                          <span class="accordion__title">
                            <?php the_title(); ?>
                            <span class="accordion__icon"></span>
                          </span>
                        </button>
                      </h3>

                      <div id="hearing-tests-sec<?= $count; ?>"
                          role="region"
                          aria-labelledby="hearing-tests-accordion<?= $count; ?>id"
                          class="accordion__panel"
                          <?= ($i == 1) ? "" : "hidden" ?>>
                        <div class="accordion__panel-inner">
                          <?php if ( $alternative_excerpt ) : ?>
                            <p><?= $alternative_excerpt; ?></p>
                          <?php else : ?>
                            <?php the_excerpt(  ); ?>
                          <?php endif; ?>
                          
                          <a href="<?php the_permalink(); ?>" class="btn--link btn--icon-arrow">More on <?php the_title(); ?></a>
                        </div>
                      </div>
                    </div>
                    
                <?php
                    
                  if ( $i == ceil($post_count / 2) ):
                    echo '</div></div><div class="col-6@lg col-12 text-component"><div id="accordionGroup-right" class="accordion" data-allow-toggle data-allow-multiple>';
                    $i = 0;
                  endif;
                    
                endforeach;
                  
                  echo '</div></div>';
                endif;
                wp_reset_postdata();
                
                ?>
                
              </div>
            </div>
          <?php endif; ?>
	<?php endwhile; ?>
  </section>
<?php endif; ?>
<?php 
  // Product Section
  if ( have_rows( 'products_microsite' ) ) : ?>
  <section class="location__products padding-bottom-xxl toc-item" id="products">
    <?php while ( have_rows( 'products_microsite' ) ) : the_row(); ?>
    <div class="container max-width-lg">
      <div class="grid grid-gap-xxl justify-center">
        <div class="col-8@md col-12 text-component text-center"><?php the_sub_field( 'content' ); ?></div>
      </div>
    </div>
    <div class="container max-width-lg">
      <div class="grid grid-gap-xxl justify-center">
        <div class="col-8@md col-12">
          <section class="tabs horizontal-demo margin-top-xxl">
          <dl class="responsive-tabs shadow-sm">
            <?php while ( have_rows( 'tabbed_content' ) ) : the_row(); ?>
              <dt><?php the_sub_field( 'tab_title' ); ?></dt>
              <dd class="bg-neutral-100">
                <div class="text-component">
                  <div class="grid grid-gap-xxl">
                    <div class="col-8@md col-12 margin-bottom-0">
                      <?php the_sub_field( 'tab_content' ); ?>
                    </div>
                    <div class="col-4@md col-12 margin-bottom-0">
                      <?php $tab_image = get_sub_field( 'tab_image' ); ?>
                      <?php if ( $tab_image ) : ?>
                        <img src="<?php echo esc_url( $tab_image['sizes']['1:1-retina'] ); ?>" alt="<?php echo esc_attr( $tab_image['alt'] ); ?>" class="radius-md shadow-sm" />
                      <?php endif; ?>
                    </div>
                  </div>
                  
                </div>
              </dd>
            <?php endwhile; ?>
          </dl>
          </section>
        </div>
      </div>
    </div>
    <div class="container margin-top-xl">
      <div class="grid">
        <div class="col-12">
          <?php the_sub_field( 'manufacturers_title' ); ?>
          <?php 
            $manufacturer_list_selected_options = get_sub_field( 'manufacturer_list' );
            $logo_count = count($manufacturer_list_selected_options);
            if ( $manufacturer_list_selected_options ) : 
            include( TEMPLATEPATH . '/template-parts/components/manufacturer-logos.php' ) ;
          ?>
            <?php if ( $logo_count <= 4 ): ?>
              <ul class="list-inline logo-list logo-list--manufacturers justify-center">
                <?php foreach ( $manufacturer_list_selected_options as $manufacturer_list_selected_option ) : 
                  $item = $manufacturer_list_selected_option['value'];
                ?>
                  <li class="logo-list__item"><span class="text-headline text-uppercase">
                    <img src="<?= $manufactuer[$item]['color-logo']?>" alt="<?= $item; ?> logo">
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php 
              elseif ( $logo_count >= 5 ) : 
                wp_enqueue_script("carousel", get_template_directory_uri()."/dist/assets/js/carousel.js", ['swiper-js'], false, true );
                wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], false, true );
            ?>
              <div class="swiper-container logo-list__carousel logo-list__carousel--manufacturers ">
                <div class="swiper-wrapper logo-list__wrapper">
              
                <?php foreach ( $manufacturer_list_selected_options as $manufacturer_list_selected_option ) : 
                  $item = $manufacturer_list_selected_option['value'];
                ?>
                  <div class="swiper-slide text-component">
                    <img src="<?= $manufactuer[$item]['color-logo']?>" alt="<?= $item; ?> logo">
                  </div>
                <?php endforeach; ?>
                </div>
              </div>
              <div class="navigation-inline"><div class="swiper-navigation"><div class="swiper-button-prev swiper-button-prev--manufacturers"></div><div class="swiper-pagination swiper-pagination--manufacturers swiper-pagination--logo-list"></div><div class="swiper-button-next swiper-button-next--manufacturers"></div></div></div>
            <?php endif; ?>
        <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
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
          <?php $button = get_sub_field( 'button' ); ?>
          <?php if ( $button ) : ?>
            <a href="<?php echo esc_url( $button); ?>" class="btn btn--primary">View Reviews</a>
          <?php endif; ?>
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