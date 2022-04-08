<?php
  wp_enqueue_script("truncate-text", get_template_directory_uri()."/dist/assets/js/truncate.js", [], false, true );

  wp_enqueue_script("table-of-contents", get_template_directory_uri()."/dist/assets/js/table-of-contents.js", [], false, true );

  //Page Title Settings
  if ( have_rows( 'title_design_options', 'staff-options' ) ) :
    while ( have_rows( 'title_design_options', 'staff-options' ) ) : the_row();
      $title_bg_color = get_sub_field( 'color_options' );
    endwhile;
  endif;

  // Introduction Settings
  // Introduction Background Settings
  if ( have_rows( 'staff_intro_banner', 'staff-options' ) ) :
    while ( have_rows( 'staff_intro_banner', 'staff-options' ) ) : the_row();
      $intro_bg_color = get_sub_field( 'color_options' );
    endwhile;
  endif;

  if ( have_rows( 'quick_links', 'staff-options' ) ) :
    while ( have_rows( 'quick_links', 'staff-options' ) ) : the_row();
      $toc_bg = get_sub_field( 'color_options' );
      $toc_text_color = get_sub_field( 'text_color' );
    endwhile;
  endif;

  // Image Position
  $image_position = get_field( 'image_position', 'staff-options' );
  $image_alignment = get_field( 'image_alignment', 'staff-options' );

  // Intro Text
  $intro_paragraph = get_field( 'intro_paragraph', 'staff-options' );

  // Association List
  if ( have_rows( 'associations_list', 'staff-options' ) ) :
    while ( have_rows( 'associations_list', 'staff-options' ) ) : the_row();
      $list_checked_options = get_sub_field( 'list' );
    endwhile;
  endif;
?>
<div class="staff">
  <section class="staff__hero bg-<?= $title_bg_color; ?>">
    <div class="container max-width-md padding-y-xl">
      <div class="grid grid-gap-lg">
        <div class="col-12 text-center text-component">
          <?php the_field( 'archive_title', 'staff-options' ); ?>
        </div>
      </div>
    </div>
  </section>

  <section class="padding-y-lg bg-<?= $toc_bg; ?>">
    <div class="container max-width-lg text-center">
        <div class="table-contents <?= ($toc_text_color == 'white') ? 'text-white' : ''; ?>">
          <span class="padding-right-lg"><strong>On This Page:</strong></span>
          <ul id="toc" class="table-contents__list list-reset flex flex-center"></ul>
        </div>
    </div>
  </section>
  <?php if( !empty($list_checked_options) || !empty($intro_paragraph) ) : ?>
  <section class="staff__introduction padding-y-xxl bg-<?= $intro_bg_color; ?>">
    <div class="container max-width-lg">
      <?php if( !empty( $intro_paragraph ) ) : ?>
      <div class="grid grid-gap-xxl <?= ($image_alignment == 'center') ? 'flex-center' : ''; ?>  <?= ( !empty($list_checked_options) ) ? 'margin-bottom-xl' : ''; ?>">
        <div class="col-12 col-6@sm text-component <?= ($image_position === 'right') ? "order-1" : "order-2"?>">
          <?= $intro_paragraph; ?>
        </div>
        <div class="col-12 col-6@sm <?= ($image_position === 'right') ? "order-2" : "order-1"?>" >
          <?php $intro_image = get_field( 'intro_image', 'staff-options' ); ?>
          <?php if ( $intro_image ) : ?>
            <img loading="lazy" class="lazyload shadow-md width-100" src="<?php echo esc_url( $intro_image['url'] ); ?>" alt="<?php echo esc_attr( $intro_image['alt'] ); ?>" />
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>
      
      <?php if ( have_rows( 'associations_list', 'staff-options' ) ) : ?>
        
        <?php while ( have_rows( 'associations_list', 'staff-options' ) ) : the_row(); 
          $list_title = get_sub_field( 'title' );
        ?>
          <?php if ( !empty($list_checked_options) ) : ?>
          <div class="staff__associations">
          <?php if( !empty( $list_title ) ) : ?>
            <h3 class="text-center margin-bottom-lg"><?= $list_title; ?></h3>
          <?php endif; ?>

          <?php if ( $list_checked_options ): 
            $arrayCount = count($list_checked_options);
            include( TEMPLATEPATH . '/template-parts/components/association-logos.php' ) ;
            ?>
            <?php if( $arrayCount < 5) : ?>
            <ul class="assocation__list list-inline logo-list justify-center">
              <?php foreach ( $list_checked_options as $list_checked_option ): 
                $item = $list_checked_option['value'];
                ?>
                <li class="assocation__item flex items-center">
                  <div class="swiper-slide"><img src="<?= $assiociations_list[$item]['color-logo']; ?>" alt="<?= $item ?> logo"></div>
                </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <?php if( $arrayCount > 4 ) : 
              wp_enqueue_script("carousel", get_template_directory_uri()."/dist/assets/js/carousel.js", ['swiper-js'], false, true );

              wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], false, true );
            ?>
              <div class="swiper-container logo-list__carousel logo-list__carousel--associations">
                <div class="swiper-wrapper logo-list__wrapper">
                <?php 
                  foreach ($list_checked_options as $list_checked_option) {
                    $item = $list_checked_option['value'];
                    echo '<div class="swiper-slide text-component">';
                    echo '<img src="'.$assiociations_list[$item]['color-logo'].'" alt="'.$item .' logo">';
                    echo '</div>'; // end slide
                  }
                ?>
                </div>
              </div>
              <div class="navigation-inline margin-top-lg"><div class="swiper-navigation"><div class="swiper-button-prev swiper-button-prev--associations"></div><div class="swiper-pagination swiper-pagination--associations swiper-pagination--logo-list"></div><div class="swiper-button-next swiper-button-next--associations"></div></div></div>
            <?php endif; ?>
          <?php endif; ?>
          </div>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>
      
    </div>
  </section>
  <?php endif; ?>

  <?php if ( have_rows( 'layouts', 'staff-options' ) ) : 
      $block_count = 0;
    ?>
    
    <?php while ( have_rows( 'layouts', 'staff-options' ) ) : the_row(); ?>
      
      <?php 
        $block_count++;
        $staff_type = get_sub_field( 'staff_type' ); 
        $section_desc = get_sub_field( 'section_description' );

        if ( have_rows( 'layout_options' ) ) :
          while ( have_rows( 'layout_options' ) ) : the_row();

            // Array value is needed for class for column of staff profile
            $template_row_layout = get_sub_field( 'template_row_layout' );

            // True / False for link to full profile
            $link_to_profile = get_sub_field( 'link_to_profile' );
            
            // True / False for accordion profiles
            $accordion_profile = get_sub_field( 'accordion_profile' );

            // True / False for stacked profiles
            $stacked = get_sub_field( 'stacked' );

            // Section background color options
            if ( have_rows( 'background_options' ) ) :
              while ( have_rows( 'background_options' ) ) : the_row();
                $staff_bg_color = get_sub_field( 'color_options' );
              endwhile;
            endif;
            
          endwhile;
        endif;
      ?>
        
      <?php 
        $staff_query = new WP_Query( array(
          'post_type' => 'staff_member',
          'posts_per_page' => '-1',
          'orderby' => array(
            'menu_order' => 'ASC',
            'title' => 'ASC'
          ),
          'tax_query' => array(
              array (
                  'taxonomy' => 'staff_type',
                  'field' => 'id',
                  'terms' => $staff_type,
              )
          ),
        ) );

        if ( $staff_type ) :
          $get_terms_args = array(
            'taxonomy' => 'staff_type',
            'hide_empty' => 0,
            'include' => $staff_type,
          );
        endif;

        $terms = get_terms( $get_terms_args );

        if ( $terms ) :
          foreach ( $terms as $term ) :
            $term_slug = $term->slug;
          endforeach;
        endif;
      ?>

      <section class="staff__section staff__section--<?= $block_count; ?> bg-<?= $staff_bg_color; ?> padding-y-xxl" id="<?= $term_slug; ?>">

        <div class="container max-width-md">
          <div class="staff__introduction text-component margin-bottom-xxxl">
            <?= $section_desc; ?>
          </div>
        </div>

        <div class="container max-width-lg text-component">
          
          <div class="grid grid-gap-xl ">
            <?php while ( $staff_query->have_posts() ) : $staff_query->the_post();?>
              <div class="<?= $template_row_layout['value']; ?>">
                <div class="grid grid-gap-lg ">
                  
                  <?php if ( $template_row_layout['label'] <= '2' ): ?>
                    <?php include( 'sections/staff-two-column.php' ) ;?>
                  <?php endif; ?>

                  <?php if ( $template_row_layout['label'] === '3' && $stacked === 'stacked' ) : ?>
                    <?php include( 'sections/staff-stacked.php' ) ;?>
                  <?php endif; ?>

                  <?php if ( $template_row_layout['label'] === '3' && $stacked === 'inline' ) : ?>
                    <?php include( 'sections/staff-inline.php' ) ;?>
                  <?php endif; ?>

                  <?php if ( $template_row_layout['label'] === '4' ) : ?>
                    <?php include( 'sections/staff-stacked-small.php' ) ;?>
                  <?php endif; ?>
                  
                </div>
              </div>
            <?php endwhile; ?>  
          </div>
          
        </div>
        
        <?php wp_reset_postdata(); ?>
      </section>

    <?php endwhile; ?>
  <?php endif; ?>
</div>