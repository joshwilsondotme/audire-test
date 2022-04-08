<?php
/**
 * Single Product
 *
 * @package \Template_Parts\Product
 */

/*
if ( have_rows( 'title_section_background_options' ) ) :
	while ( have_rows( 'title_section_background_options' ) ) : the_row();
		$title_bg = get_sub_field( 'color_options' );
	endwhile;
endif;
*/

if ( have_rows( 'title_design_options', 'resource-options' ) ) :
  while ( have_rows( 'title_design_options', 'resource-options' ) ) : the_row();
    $title_bg = get_sub_field( 'color_options' );
    $title_text_color = get_sub_field( 'text_color' );
  endwhile;
endif;

?>
<div class="interior-page">
  <header class="padding-y-xl bg-<?= $title_bg; ?> <?= ($title_text_color == 'white') ? 'text-white' : ''; ?>">
    <div class="container max-width-md">
      <h1 class="single-post__title">
        <?php the_title(); ?>
      </h1>
    </div>
  </header>
  <section class="padding-y-xxxl">
    <div class="container max-width-md">
      <main class="single-post__content text-component">
        <?php the_content(); ?>
      </main>
    </div>
  </section>
</div>
