<?php 
  $boxed_logos = get_sub_field( 'boxed_logos' );

  if ( have_rows( 'ald_background' ) ) :
    while ( have_rows( 'ald_background' ) ) : the_row();
      $ald_bg = get_sub_field( 'color_options' );
    endwhile;
  endif; 
?>
<section class="products__section products__assitive products__section--<? $blockcount; ?> padding-y-xxl bg-<?= $ald_bg; ?>" id="assistive-listening-devices">
  <div class="container max-width-md text-component text-center">
    <?php the_sub_field( 'content' ); ?>
  </div>
  <div class="container max-width-lg">
    <?php 
      $brands_query = new WP_Query( array(
        'post_type' => 'products',
        'order'   => 'ASC',
        'orderby' => 'title',
        'tax_query' => array(
            array (
                'taxonomy' => 'product_type',
                'field' => 'slug',
                'terms' => 'assistive-listening-device',
            )
        ),
      ) );

      include( TEMPLATEPATH . '/template-parts/components/manufacturer-logos.php' ) ;

      if ( $brands_query->have_posts() ) :  ?>
      <ul class="brands__list logo-list list-inline flex-gap-lg margin-top-lg justify-center">
      <?php while ( $brands_query->have_posts() ) : $brands_query->the_post(); 
        $item = $post->post_name;
      ?>
        <li class="brands__item <?= ($boxed_logos == true) ? 'brands__item--boxed' : '' ; ?>">
          <a href="<?= the_permalink(); ?>" title="<?= the_title(); ?>" class="brands__logo">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( '4:2', array( 'class' => 'lazyload width-100' ) );  ?>
            <?php else : ?>
              <img src="<?= $manufactuer[$item]['color-logo'] ?>" alt="<?= $item ?> logo" class="lazyload width-100">
            <?php endif; ?>
          </a>
        </li>

    <?php endwhile; endif; wp_reset_postdata(); ?>
      
    </ul>
  </div>
</section