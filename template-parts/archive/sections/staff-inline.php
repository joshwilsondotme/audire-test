<div class="col-5@sm col-12">
  <div class="staff__profile-image">
    <?php the_post_thumbnail( '1:1', array( 'class' => 'lazyload shadow-md' ) );  ?>
  </div>
</div>

<div class="col">
  <div class="staff__profile">
    <h3 class="staff__name"><?= the_title(); ?></h3>
    <h4 class="staff__title letter-spacing-xxxxs text-uppercase text-ms font-primary color-secondary"><strong><?php the_field( 'job_title' ); ?></strong></h4>
    <?php if ( $link_to_profile === true ) : ?>
      <a class="btn--link btn--icon-arrow" href="<?= esc_url(the_permalink()); ?>">Read More</a>
    <?php endif; ?>
  </div>
</div>
