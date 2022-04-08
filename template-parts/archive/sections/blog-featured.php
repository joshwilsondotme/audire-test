<?php
  if ( have_rows( 'branding', 'themes-options' ) ) :
    while ( have_rows( 'branding', 'themes-options' ) ) : the_row();
      $logo = get_sub_field( 'logo' );
      $alt_logo = get_sub_field( 'alt_logo' );
    endwhile;
  endif;

  $sticky_args = array(
    'posts_per_page' => 3,
    'post__in' => get_option( 'sticky_posts' ),
    'ignore_sticky_posts' => 1
  );

  $sticky_query = new WP_Query( $sticky_args );

  $excerpt = get_the_excerpt(); 
 
  $excerpt = substr( $excerpt, 0, 180 ); // Only display first 180 characters of excerpt
  $result = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );

  $display_name = get_the_author_meta( 'display_name', $post->post_author );

?>
  <?php if ( $sticky_query->have_posts()  ) : ?>
    <section class="blog__featured padding-top-xxl">
      <div class="container max-width-lg">
        <div class="blog__featured-intro margin-bottom-xl padding-bottom-md text-sm">
          <h2>Our Featured Blog Posts</h2>
        </div>
        <div class="blog__featured-list">
          <?php  while ( $sticky_query->have_posts() ) : $sticky_query->the_post(); $post_id = get_the_ID(); ?>
            <div class="blog__featured-item text-component">
              <?php if (has_post_thumbnail( $post_id ) && !empty(get_the_post_thumbnail())) :?>
                <div class="blog__featured-image">
                  <?php the_post_thumbnail( '16:10', array( 'class' => 'lazyload width-100 radius-md' ) );  ?>
                </div>
                <?php else : ?>
                <div class="blog__featured-image blog__featured-image--color radius-md">
                  <img src="<?php echo esc_url( $alt_logo['url'] ); ?>" alt="<?php echo esc_attr( $alt_logo['alt'] ); ?>" />
                </div>
              <?php endif; ?>
              
              <div class="blog__featured-content padding-y-md padding-x-lg">
                <?php 
                  $categories = get_the_category();
                  $separator = ' ';
                  $output = '';
                  if ( ! empty( $categories ) ) {
                    foreach( $categories as $category ) {
                      $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                    }
                    echo '<p class="margin-bottom-0 text-semibold text-sm text-uppercase">' . trim( $output, $separator ) . '</p>';
                  }
                ?>
                <h3 class="blog__featured-title margin-bottom-sm text-md" ><a href="<?php the_permalink( ); ?>"><?php the_title(  ); ?></a></h3>

                <p class="blog__featured-excerpt"><?= $result; ?></p>

                <p><a href="<?php the_permalink(); ?>" class="btn--link btn--icon-arrow link--hover text-uppercase blog__link" title="Read more about <?php the_title(); ?>">Read More</a></p>

                <p class="blog__featured-meta text-sm"><strong>By: <a href="<?= esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?= $display_name; ?></a> | <?= get_the_date( get_option('date_format') ); ?></strong></p>
              </div>
              

            </div>
          <?php endwhile; ?>
        </div>
        
      </div>
    </section>
    
<?php endif; wp_reset_postdata();?>
