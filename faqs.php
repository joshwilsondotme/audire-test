<?php 
  /* Template Name: Frequent Asked Questions */ 
  /* Template Post Type: resources */
  wp_enqueue_script("table-of-contents", get_template_directory_uri()."/dist/assets/js/table-of-contents.js", [], false, true );

  if ( have_rows( 'title_design_options', 'resource-options' ) ) :
    while ( have_rows( 'title_design_options', 'resource-options' ) ) : the_row();
      $title_bg = get_sub_field( 'color_options' );
      $title_text_color = get_sub_field( 'text_color' );
    endwhile;
  endif;
  get_header(); ?>

  <div class="interior-page">
    <header class="padding-y-xl bg-<?= $title_bg; ?> <?= ($title_text_color == 'white') ? 'text-white' : ''; ?>">
      <div class="container max-width-md">
        <h1 class="single-post__title">
          <?php the_title(); ?>
        </h1>
      </div>
    </header>
    
    <section class="padding-top-xl padding-bottom-xxxl">
      <div class="container max-width-md page--frequently-asked-questions">

        <aside class="toc-container">
          <ul id="toc" class="table-contents__list list-reset">
          <h3 class="text-md margin-bottom-md">What's on this page.</h3>
          </ul>
        </aside>
        
        <main class="single-post__content text-component">
          <?php the_content(); ?>
        </main>
      </div>
    </section>
  </div>

  <?php get_footer(); ?>