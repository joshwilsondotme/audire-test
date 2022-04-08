<?php
  if ( have_rows( 'quick_links_background' ) ) :
	  while ( have_rows( 'quick_links_background' ) ) : the_row();
		$tocBg = get_sub_field( 'color_options' );
	  endwhile;
  endif;
?>

<section class="padding-y-lg bg-<?= $tocBg; ?>">
  <div class="container max-width-lg text-center">
      <div class="table-contents">
        <span class="padding-right-lg"><strong>On This Page:</strong></span>
        <ul id="toc" class="table-contents__list list-reset flex flex-center"></ul>
      </div>
  </div>
</section>