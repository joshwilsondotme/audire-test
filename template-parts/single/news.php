<?php
/**
 * Single Post
 *
 * @package \Template_Parts\Single
 */
  $postType = get_post_type();

  if ( have_rows( 'branding', 'themes-options' ) ) :
    while ( have_rows( 'branding', 'themes-options' ) ) : the_row();
      $logo = get_sub_field( 'logo' );
      $alt_logo = get_sub_field( 'alt_logo' );
    endwhile;
  endif;

  $display_name = get_the_author_meta( 'display_name', $post->post_author );
  $post_id = $post->ID;

?>

<div class="blog__post">
  <div class="container max-width-md padding-top-xxl padding-bottom-xxl text-component" >
    <section <?php post_class(); ?>>

      <header class="blog__post-header">

      <?php if (has_post_thumbnail( $post_id )) :?>
        <div class="blog__post-image  radius-md">
          <?php the_post_thumbnail( '16:9', array( 'class' => 'lazyload width-100' ) );  ?>
        </div>
        <?php else : ?>
        <div class="blog__post-image blog__post-image--color radius-md">
          <img src="<?php echo esc_url( $alt_logo['url'] ); ?>" alt="<?php echo esc_attr( $alt_logo['alt'] ); ?>" />
        </div>
      <?php endif; ?>
      
      <div class="blog__single-post-meta text-component text-center">
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
        <h1><?php the_title(); ?></h1>
        <p class="blog__post-meta"><strong>By: <a href="<?= esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?= $display_name; ?></a> | <?= get_the_date( get_option('date_format') ); ?></strong></p>
      </header>

      <main class="single-post__content">
        <?php
          // the_content(  ); 
          wad_the_content_with_replacement();
        ?>
      </main>

    </section>
  </div>
</div>