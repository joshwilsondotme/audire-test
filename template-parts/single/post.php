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
    
    <?php
      // Latest Posts
      $latest_args = array(
        'posts_per_page' => 3,
        'post__in' => get_option( 'sticky_posts' ),
        'ignore_sticky_posts' => 1
      );
    
      $latest_query = new WP_Query( $latest_args );
    ?>

    <?php if ( have_rows( 'call_to_action' ) ) : ?>
      <?php while ( have_rows( 'call_to_action' ) ) : the_row(); ?>
        <?php if ( get_sub_field( 'select_option' ) == 1 ) : ?>
          <?php the_sub_field( 'content' ); ?>
        <?php else : ?>
          <?php // echo 'false'; ?>
        <?php endif; ?>
      <?php endwhile; ?>
    <?php endif; ?>

    <?php 
      $tags = get_the_tags();
      $separator = ', ';
      $output = '';
      if ( ! empty( $tags ) ) {
        foreach( $tags as $tag ) {
          $output .= '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $tag->name ) ) . '">' . esc_html( $tag->name ) . '</a>' . $separator;
        }
        echo '<p class="margin-bottom-0"><strong>Tags: </strong>' . trim( $output, $separator ) . '</p>';
      }
    ?>
  </div>
</div>



<?php if( $latest_query->have_posts() ) : ?>
  <section class="blog__latest-posts">
    <div class="container max-width-lg">
      <div class="blog__featured-intro margin-bottom-xl padding-bottom-md text-sm flex justify-between items-center">
        <h2>Read our latest blogs</h2>
        <p><a href="<?php echo get_post_type_archive_link($postType); ?>" class="btn--link btn--icon-arrow link--hover text-uppercase blog__link">Read more</a></p>
      </div>
      <div class="grid grid-gap-lg">
        <?php while( $latest_query->have_posts() ) : $latest_query->the_post(); ?>
          
          <div class="col-4@md col-12">
            <?php get_template_part( 'template-parts/components/card-blog'); ?>
          </div>

        <?php endwhile; ?>
      </div>
    </div>
  </section>
<?php endif; ?>
