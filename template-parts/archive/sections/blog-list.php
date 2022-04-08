<?php
  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  $non_sticky_query = new WP_Query( 
    array( 
      'post__not_in' => get_option( 'sticky_posts' ) ,
      'paged' => $paged
    ) 
  );

  if ( $non_sticky_query->have_posts() ) : ?>
  <section class="blog__list padding-top-xxl">
    <div class="container max-width-lg">
      <?php if ( is_home() ) : ?>
        <h2 class="sub-heading text-center margin-bottom-xl">Discover More of Our Blog</h2>
      <?php endif; ?>
      <div class="grid grid-gap-lg">
        <?php while ( $non_sticky_query->have_posts() ) : $non_sticky_query->the_post(); $post_id = get_the_ID(); ?>
        <div class="col-4@md col-12">
          <?php get_template_part( 'template-parts/components/card-blog', null, array('post_id' => $post_id)); ?>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <section class="blog__pagination padding-y-xxl">
    <div class="container max-width-sm text-center">
      <?php echo paginate_links(); ?>
    </div>
  </section>
