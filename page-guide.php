<?php 
  /* Template Name: Guide to Hearing Aids */ 
  /* Template Post Type: resources */
  get_header(); ?>
  <div class="interior-page">
    <section class="guide-section padding-top-xxl">
      <div class="guide__top">
      <div class="container max-width-lg">
        <div class="text-center text-component">
          <h1 class="text-uppercase">Free E-Book:<br />Guide to hearing loss and hearing aids</h1>
          <h2 class="color">Over 20 pages of free information you need to know before purchasing hearing aids, including:</h2>
        </div>
    
          <ul class="guide__list">
            <li class="guide__list-item"><strong>Types of Hearing Loss</strong><br />
            Your type and degree of hearing loss will determine your treatment and hearing aid style.</li>
            <li class="guide__list-item"><strong>Signs of Hearing Loss and What to Do</strong><br />
            The sooner hearing loss is recognized and treated, the better the outcome.</li>
            <li class="guide__list-item"><strong>Choosing a Hearing Aid</strong><br />
            There are more options than ever before based on a variety of factors.</li>
            <li class="guide__list-item"><strong>What to Expect with Hearing Aids</strong><br />
            Get the maximum satisfaction out of your hearing aids with the proper expectations.</li>
          </ul>
    
          <p class="text-component margin-bottom-xxl text-center"><a class="btn btn--guide" href="#guide-contact">Get My Free Copy <i class="fal fa-arrow-down margin-left-xs"></i></a></p>
      </div>
    </section>
    <section class="guide__middle">
      <div class="container max-width-md text-center">
        <img loading="lazy" src="<?php echo get_template_directory_uri() . '/images/guide/guide-collage.png' ?>" alt="Otoscope" class="lazyload aligncenter">  
      </div>
    </section>
    <section>
      <div class="guide__bottom bg-contrast-200 padding-top-xxxl padding-bottom-xxl">
      <div class="container max-width-lg">
        <div class="text-center">
          <h2 style="text-align: center;">Know Before You GO</h2>
    
          <h3 style="text-align: center;">Get your free copy of &ldquo;Guide to Hearing Loss and Hearing Aids!&rdquo;</h3>
    
          <img loading="lazy" src="<?php echo get_template_directory_uri() . '/images/guide/image-content-value.png' ?>" alt="Guide Content Value" class="lazyload aligncenter margin-top-lg">  
    
          <div id="guide-contact">
            <div class="container max-width-xxs">
              <?php the_content(); ?>
            </div>
            
          </div>
        </div>
      </div>  
      </div>
    </section>
  </div>
  <?php get_footer(); ?>