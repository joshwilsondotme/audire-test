<?php /* Template Name: Page Builder */ 

  get_header();
  $custom_title_banner = get_field( 'custom_title_banner' );
  if ( $custom_title_banner == 'on' ) :
    get_template_part( 'template-parts/components/interior-banner' );
  else :
    get_template_part( 'template-parts/components/interior-banner--global' );
  endif;
  
  if(have_rows('layouts', $post->ID)) :

    $block_count = 0;

    while(have_rows('layouts' , $post->ID)) : the_row();

      ACF_Layout::render(get_row_layout(), $block_count);
      $block_count++;

    endwhile;

  endif; 
  get_footer();
?>