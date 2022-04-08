<?php
if ( have_rows( 'branding', 'themes-options' ) ) :
  while ( have_rows( 'branding', 'themes-options' ) ) : the_row();
    $logo = get_sub_field( 'logo' );
    $alt_logo = get_sub_field( 'alt_logo' );
  endwhile;
endif;

$post_id = $post_id = $post->ID;;
$excerpt = get_the_excerpt(); 

$excerpt = substr( $excerpt, 0, 75 ); // Only display first 75 characters of excerpt
$result = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );

$display_name = get_the_author_meta( 'display_name', $post->post_author );

?>
<article <?php post_class( 'blog__article' ); ?>>
  <?php if (has_post_thumbnail( $post_id ) && !empty(get_the_post_thumbnail())) :?>
    <div class="blog__post-image">
      <?php the_post_thumbnail( '16:10', array( 'class' => 'lazyload width-100 radius-md' ) );  ?>
    </div>
    <?php else : ?>
    <div class="blog__post-image blog__post-image--color radius-md">
      <img src="<?php echo esc_url( $alt_logo['url'] ); ?>" alt="<?php echo esc_attr( $alt_logo['alt'] ); ?>" />
    </div>
  <?php endif; ?>

  <main class="blog__post-content">
    <?php 
        $categories = get_the_category();
        $separator = ' ';
        $output = '';
        if ( ! empty( $categories ) ) {
          foreach( $categories as $category ) {
            $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
          }
          echo '<p class="blog__post-category margin-bottom-0 text-semibold text-sm text-uppercase">' . trim( $output, $separator ) . '</p>';
        }
      ?>
      <h3 class="blog__post-title margin-bottom-sm" ><a href="<?php the_permalink( ); ?>"><?php the_title(  ); ?></a></h3>

      <p class="blog__post-excerpt"><?= $result; ?></p>
      
      <p><a href="<?php the_permalink(); ?>" title="Read more about <?php the_title(); ?>" class="btn--link btn--icon-arrow link--hover text-uppercase blog__link">Read More</a></p>

      <p class="blog__post-meta text-sm"><strong>By: <a href="<?= esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?= $display_name; ?></a> | <?= get_the_date( get_option('date_format') ); ?></strong></p>
  </main>

</article>