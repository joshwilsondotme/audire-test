<?php
/**
 * Single Staff Members
 *
 * @package \Template_Parts\Staff_Members
 */


wp_enqueue_script("accordion-js", get_template_directory_uri()."/dist/assets/js/accordion.js", [], false, true );

wp_enqueue_script("logo-carousel", get_template_directory_uri()."/dist/assets/js/logo-carousel.js", ['swiper-js'], false, true );

wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], false, true );



$jobTitle = get_field( 'job_title' );
$phone = get_field( 'phone' );
$email = get_field( 'email' );
$linkedin = get_field( 'linkedin' );
$education = get_field( 'education__training' );
$certification = get_field( 'licenses_&_certifications' );
$specialty = get_field( 'specialty_areas' );
$awards = get_field( 'awards' );
$memberships_associations_selected_options = get_field( 'memberships_associations' );
$contact_form_options_selected_option = get_field( 'contact_form_options' );
$contact_introduction = get_field( 'contact_introduction' );
$general_contact_form = get_field( 'general_contact_form' );
$blueprint_solutions = get_field( 'blueprint_solutions' );
$sycle = get_field( 'sycle' );
$contactBg = get_field( 'color_options');

if ( have_rows( 'title_design_options', 'staff-options' ) ) :
  while ( have_rows( 'title_design_options', 'staff-options' ) ) : the_row();
    $title_bg_color = get_sub_field( 'color_options' );
    $white_text = get_sub_field( 'text_color' );
  endwhile;
endif;

if ( have_rows( 'staff_intro_banner', 'staff-options' ) ) :
  while ( have_rows( 'staff_intro_banner', 'staff-options' ) ) : the_row();
    $intro_bg_color = get_sub_field( 'color_options' );
  endwhile;
endif;

if ( have_rows ( 'biography' ) ) :
  while ( have_rows ( 'biography' ) ) : the_row() ;
    $fullBio = get_sub_field( 'full' );
  endwhile;
endif; 

if ( have_rows ( 'quote' ) ) :
  while ( have_rows ( 'quote' ) ) : the_row() ;
    $blockquote = get_sub_field( 'quote' );
    $author = get_sub_field( 'author' );
  endwhile;
endif; 

$postType = get_post_type();

?>

<div class="staff">

  <section class="staff__header padding-y-xl bg-<?= $title_bg_color; ?> <?= ($white_text == 'white') ? 'text-white' : ''; ?> ">
    <div class="container max-width-lg text-center">
      <p class="text-xl font-headline text-uppercase">Our staff</p>
      <a href="<?php echo get_post_type_archive_link($postType); ?>" class="text-semibold"><i class="fal fa-long-arrow-left"></i> Back to Staff</a>
    </div>
  </section>

  <section class="staff__profile padding-y-xxl">
    <div class="container max-width-md">
      <div class="grid grid-gap-lg">
        <div class="col-4@md col-12">

          <div class="staff__photo margin-bottom-lg">
            <?php the_post_thumbnail( '4:3-vertical', array( 'class' => 'lazyload shadow-md' ) );  ?>
          </div>
          <div class="staff__details text-component">
            
            <h4><?php the_title(); ?></h4>

            <div class="flex">
              <p><?= $jobTitle; ?></p>
              <?= ($linkedin) ? '<a href="'. $linkedin .' " target="_blank" rel="noopener noreferrer" class="margin-left-md staff__social-link"><i class="fab fa-linkedin-in"></i></a>' : ''; ?>
            </div>

            <?= ($phone) ? '<p><i class="fal fa-phone-alt"></i> <a href="tel:'.$phone.'">'.$phone.'</a></p>' : '' ;?>
            <?= ($email) ? '<p><i class="fal fa-envelope"></i> <a href="mailto:'.$email.'">'.$email.'</a></p>' : '' ;?>

            
              <?php $provider_location = get_field( 'provider_location' ); ?>

              <?php if ( $provider_location ) : ?>
                <h4>Serving At: </h4>
                <?php foreach ( $provider_location as $post ) : ?>
                  <?php setup_postdata ( $post ); ?>
                  <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
              <?php endif; ?>
              <?php if ( have_rows ( 'quote' ) ) : ?>

              <?php if( $blockquote ): ?>
              <hr />

              <h4>Quote: </h4>

              <blockquote class=""><em><?= $blockquote; ?></em></blockquote>

              <?php if ($author) : ?>
                <cite class=""><?= $author; ?></cite>
              <?php endif; ?>
              <?php endif; ?>

            <?php endif; ?>
          </div>
        </div>

        <div class="col-8@md col-12">
          <div class="staff__bio text-component">

            <h1 class="text-lg">Meet <?= the_title(); ?></h1>

            <?= $fullBio; ?>

            <div id="accordionGroup" class="accordion margin-top-xl" data-allow-toggle>
              <?php if ( $education ) : ?>
                <div class="accordion__item">
                  <h3>
                    <button aria-expanded="false"
                            class="accordion__trigger"
                            aria-controls="sect-education"
                            id="accordion-education-id">
                      <span class="accordion__title">
                        Education/Training
                        <span class="accordion__icon"></span>
                      </span>
                    </button>
                  </h3>

                  <div id="sect-education"
                      role="region"
                      aria-labelledby="accordion-educationid"
                      class="accordion__panel"
                      hidden>
                    <div class="accordion__panel-inner">
                      <?= $education; ?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>

              <?php if ( $certification ) : ?>
                <div class="accordion__item">
                  <h3>
                    <button aria-expanded="false"
                            class="accordion__trigger"
                            aria-controls="sect-certification"
                            id="accordion-certification-id">
                      <span class="accordion__title">
                        Licenses & Certifications
                        <span class="accordion__icon"></span>
                      </span>
                    </button>
                  </h3>

                  <div id="sect-certification"
                      role="region"
                      aria-labelledby="accordion-certificationid"
                      class="accordion__panel"
                      hidden>
                    <div class="accordion__panel-inner">
                      <?= $certification; ?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
              
              <?php if ( $specialty ) : ?>
                <div class="accordion__item">
                  <h3>
                    <button aria-expanded="false"
                            class="accordion__trigger"
                            aria-controls="sect-specialty"
                            id="accordion-specialty-id">
                      <span class="accordion__title">
                        Specialty Areas
                        <span class="accordion__icon"></span>
                      </span>
                    </button>
                  </h3>

                  <div id="sect-specialty"
                      role="region"
                      aria-labelledby="accordion-specialtyid"
                      class="accordion__panel"
                      hidden>
                    <div class="accordion__panel-inner">
                      <?= $specialty; ?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>

              <?php if ( $awards ) : ?>
                <div class="accordion__item">
                  <h3>
                    <button aria-expanded="false"
                            class="accordion__trigger"
                            aria-controls="sect-awards"
                            id="accordion-awards-id">
                      <span class="accordion__title">
                        Awards & Honors
                        <span class="accordion__icon"></span>
                      </span>
                    </button>
                  </h3>

                  <div id="sect-awards"
                      role="region"
                      aria-labelledby="accordion-awardsid"
                      class="accordion__panel"
                      hidden>
                    <div class="accordion__panel-inner">
                      <?= $awards; ?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>

              <?php if ( $memberships_associations_selected_options ) :
                $arrayCount = count($memberships_associations_selected_options);
                include( TEMPLATEPATH . '/template-parts/components/association-logos.php' ) ;
              ?>
              <div class="accordion__item">
                <h3>
                  <button aria-expanded="true"
                          class="accordion__trigger"
                          aria-controls="sect-memberships"
                          id="accordion-memberships-id">
                    <span class="accordion__title">
                      Memberships & Associations
                      <span class="accordion__icon"></span>
                    </span>
                  </button>
                </h3>
                <div id="sect-memberships"
                      role="region"
                      aria-labelledby="accordion-memberships"
                      class="accordion__panel">
                    <div class="accordion__panel-inner">
                <?php if ( $arrayCount <= 4 ) : ?>
                  <!-- <ul class="assocation__list flex justify-center flex-gap-lg list-reset"> -->
                  <ul class="assocation__list list-inline logo-list">
                  <?php foreach ( $memberships_associations_selected_options as $memberships_associations_value ) : 
                    $item = '';
                    $item = $memberships_associations_value['value'];
                    // var_dump($memberships_associations_value[$item]);
                    ?>
                      <!-- <li class="assocation__item"> -->
                      <li class="logo-list__item">
                        <img src="<?= $assiociations_list[$item]['color-logo']; ?>" alt="<?= $item ?> logo">
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php else : ?>
                  <div class="swiper-container logo-carousel logo-carousel--large-logo">
                    <div class="swiper-wrapper">
                      <?php foreach ( $memberships_associations_selected_options as $memberships_associations_value ) : 
                        $item = '';
                        $item = $memberships_associations_value['value'];
                        ?>
                        <div class="swiper-slide"><img src="<?= $assiociations_list[$item]['color-logo']; ?>" alt="<?= $item ?> logo"></div>
                      <?php endforeach; ?>
                    </div>
                    <div class="swiper-navigation">
                      <div class="swiper-button-prev"></div>
                      <div class="swiper-pagination"></div>
                      
                      <div class="swiper-button-next"></div>
                    </div>
                  </div>
                <?php endif; ?>
                      </div>
                      </div>
              </div>
            <?php endif; ?>

            </div>
            
            
          </div>
        </div>
      </div>
    </div>
  </section>


  <?php if ($contact_form_options_selected_option['value'] != 'none' ) : ?>
    <section class="staff__contact padding-y-xxl bg-<?= $contactBg; ?>">
      <div class="container max-width-sm text-center text-component margin-bottom-xl">
        <?= $contact_introduction; ?>
      </div>

      <div class="container max-width-md">  
        <?php if( $contact_form_options_selected_option['value'] == 'general' ): ?>
          <?php echo do_shortcode( $general_contact_form ); ?>
        
        <?php elseif( $contact_form_options_selected_option['value'] == 'blueprint' ): ?>
          <div class="media-wrapper"><?= $blueprint_solutions; ?></div>
        <?php elseif( $contact_form_options_selected_option['value'] == 'sycle' ): ?>
          <script type="text/javascript">!function(){window.__ct = window.__ct || [];__ct.token='$sycle';__ct.adSource='1';var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://sycle.audiologydesign.com/assets/js/sycle_script.js";var e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(t,e)}();</script><!-- add below div in your html where do you wish to see the sycle widget--><div id="ad-sycle-form"></div>
        <?php endif; ?>
      </div>

    </section>
  <?php endif; ?>
</div>
<?php the_content(); ?>
