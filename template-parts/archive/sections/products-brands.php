<?php 
  $boxed_logos = get_sub_field( 'boxed_logos' );
  if ( have_rows( 'manufacturers_background' ) ) :
    while ( have_rows( 'manufacturers_background' ) ) : the_row();
      $manufacturers_bg = get_sub_field( 'color_options' );
      
    endwhile;
  endif; 
?>
<section class="products__section products__brands products__section--<? $blockcount; ?> padding-y-xxl bg-<?= $manufacturers_bg; ?>" id="brands">
  <div class="container max-width-md text-center text-component margin-bottom-xxl">
    <div class="col-12">
      <?php the_sub_field( 'content' ); ?>
    </div>  

  </div>
  <div class="container max-width-md text-component brands">
  <?php 
    $brands_query = new WP_Query( array(
      'post_type' => 'products',
      'posts_per_page' => -1,
      'orderby' => array(
        'menu_order' => 'ASC',
        'title' => 'ASC'
      ),
      'tax_query' => array(
          array (
              'taxonomy' => 'product_type',
              'field' => 'slug',
              'terms' => 'manufacturer',
          )
      ),
    ) );

    include( TEMPLATEPATH . '/template-parts/components/manufacturer-logos.php' ) ;

    if ( $brands_query->have_posts() ) : 
      while ( $brands_query->have_posts() ) : $brands_query->the_post(); 
      $item = $post->post_name;
    ?>
      <div class="grid grid-gap-xl brands__item <?= ($boxed_logos == true) ? 'brands__item--boxed' : '' ; ?>">
        <div class="col-3@sm col-12">
          <a href="<?= the_permalink(); ?>" title="<?= the_title(); ?>" class="brands__logo">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( '4:2', array( 'class' => 'lazyload width-100' ) );  ?>
            <?php else : ?>
              <img src="<?= $manufactuer[$item]['color-logo'] ?>" alt="<?= $item ?> logo" class="lazyload width-100">
            <?php endif; ?>
          </a>
        </div>
        <div class="col-12 col-9@sm">
          <h3><?php the_title(); ?></h3>
          <?php the_excerpt(  ); ?>
          <a href="<?php echo esc_url(the_permalink()); ?>" class="btn--link btn--icon-arrow">View All Products</a>
        </div>
      </div>

  <?php endwhile; endif; wp_reset_postdata(); ?>
  </div>
</section>
