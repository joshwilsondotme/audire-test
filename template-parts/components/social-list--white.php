<?php if ( have_rows( 'social_media_profiles', 'themes-options' ) ) : ?>
    <?php while ( have_rows( 'social_media_profiles', 'themes-options' ) ) : the_row(); ?>
      <?php 
        $provider_name = get_sub_field( 'provider' );
        $provider_icon = get_sub_field( 'provider' ); 
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
          case 'linked-in':
            $provider_icon = '<i class="fab fa-linkedin-in"></i>';
            break;
          case 'tiktok':
            $provider_icon = '<i class="fab fa-tiktok"></i>';
            break;
          case 'bbb':
            $provider_icon = '<img src="'. get_template_directory_uri().'/images/svgs/better-business-bureau_icon-white.svg" alt="Better Business Bureau logo icon">';
            break;
          case 'healthy-hearing':
            $provider_icon = '<img src="'. get_template_directory_uri().'/images/svgs/healthy-hearing_icon-white.svg" alt="Healthy Hearing logo icon">';
          break;
          default:
        }
        $provider_url = get_sub_field( 'url' );
      ?>
      
      <li class="social-list__item">
        <a class="social-list__link social-list__link social-list__link--<?= $provider_name; ?>" href="<?php echo esc_url( $provider_url ); ?>" target="_blank"><?= $provider_icon; ?></a>
      </li>

    <?php endwhile; ?>
  <?php endif; ?>