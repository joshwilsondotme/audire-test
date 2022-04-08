<section>

  <header>
    <h1 class="single-post__title">
      <?php the_title(); ?>
    </h1>
  </header>

  <main class="single-post__content">
    <?php the_excerpt(  ); ?>
    <a href="<?php the_permalink(); ?>">Read More</a>
  </main>

</section>