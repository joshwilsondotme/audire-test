<div class="col-4@sm col-12">
  <div class="staff__profile-image">
    <?php the_post_thumbnail( '4:3-vertical', array( 'class' => 'lazyload shadow-md width-100' ) );  ?>
  </div>
</div>

<div class="col">
  <div class="staff__profile">
    <h3 class="staff__name"><?= the_title(); ?></h3>
    <h4 class="staff__title letter-spacing-xxxxs text-uppercase text-ms font-primary color-secondary"><strong><?php the_field( 'job_title' ); ?></strong></h4>
    <?php if ( have_rows( 'biography' ) ): ?>
      <?php while ( have_rows( 'biography' ) ) : the_row(); ?>
        
        <?php if ( $link_to_profile === true ) : ?>
          <div class="staff__bio--excerpt">
            <p><?php the_sub_field( 'exceprt' ); ?></p>
            <a class="btn--link btn--icon-arrow" href="<?= esc_url(the_permalink()); ?>">Read More</a>
          </div>
          
          <?php else: ?>
            <?php if ( $accordion_profile === true) :?>
              <div class="staff__bio-full staff__bio-full--accordion" data-options="90">
                <?php the_sub_field( 'full' ); ?>
              </div>  
            <?php else: ?>
              <div class="staff__bio-full">
                <?php the_sub_field( 'full' ); ?>
              </div>
            <?php endif; ?>
        <?php endif; ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>
