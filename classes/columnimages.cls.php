<?php

class ColumnImages extends Column {

  public $images;
  public $image_layout;
  public $image_gap;
    
  public function __construct($data) {
    parent::__construct($data);
    
    $this->images       = $data[$this->content_type . '_content_settings'][$this->content_type]['images'];
    $this->image_layout = $data[$this->content_type . '_content_settings'][$this->content_type]['image_layout'];
    $this->image_gap    = $data[$this->content_type . '_content_settings'][$this->content_type]['image_gap'];
  }
    
  protected function renderContent() {
    if ( !empty( $this->image_layout )) {
      call_user_func(array($this, 'render' . ucfirst($this->image_layout)));
    }
  }
  
  /* Individual Layout Render Functions */
  protected function renderRow() {
    echo '<div class="image-block image-row">';
    
    foreach($this->images as $i => $image) {
      $theImage   = new Image($image['image_design_options']);
      $img        = $image['image_design_options']['image'];
      $hasContent = $image['hover_content'] ? 'has-content' : '';
      $content    = $image['hover_content'] ? $image['content'] : '';
      $whRatio    = round($img['width'] / $img['height'], 4);
      
      echo '<div class="image-row__item ' . $hasContent . '" style="flex: ' . $whRatio . '; ' . ($i > 0 ? 'margin-left: ' . $this->image_gap . 'px;' : '') . '">';
      
      $theImage->render();
        
      if ( !empty($content) ) {
        $hwRatio = round(100 * $img['height'] / $img['width'], 2);
        
        echo '<div class="image-cluster__item image-content" style="padding-top: ' . $hwRatio . '%">
          <div class="image-content-inner">' . $content . '</div>
        </div>';
      }
      
      echo '</div>';
    }
    
    echo '</div>';
  }
  
  protected function renderOverlapRow() {
    $this->renderRow();
  }
  
  protected function renderCluster() {
    $count = (count($this->images) > 3) ? 3 : count($this->images);
    echo '<div class="image-block image-cluster image-cluster-' . $count . '">';
    
    foreach($this->images as $i => $image) {
      $theImage   = new Image($image['image_design_options']);
      $img        = $image['image_design_options']['image'];
      $hasContent = $image['hover_content'] ? 'has-content' : '';
      $content    = $image['hover_content'] ? $image['content'] : '';
      
      echo '<div class="image-cluster__item ' . $hasContent . '">';
      
      $theImage->render();
    
      if ( !empty($content) ) {
        $hwRatio = round(100 * $img['height'] / $img['width'], 2);
        
        echo '<div class="image-cluster__item image-content" style="padding-top: ' . $hwRatio . '%">
          <div class="image-content-inner">' . $content . '</div>
        </div>';
      }
      
      echo '</div>';
      
      // Limit the max number of images in a cluster
      if (++$i >= 3) break;
    }
    
    echo '</div>';
  }
  
  protected function renderGallery() {    
    echo '<div class="image-gallery">
    <div class="swiper swiperGalleryLarge" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff">
      <div class="swiper-wrapper">';
            
    foreach($this->images as $i => $image) {
      $theImage   = new Image($image['image_design_options']);
      $img        = $image['image_design_options']['image'];
        
      echo '<div class="swiper-slide">';
      
      $theImage->render();
      
      echo '</div>';
    }
            
    echo '</div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
    <div thumbsSlider="" class="swiper swiperGalleryThumbs">
      <div class="swiper-wrapper">';
      
    foreach($this->images as $i => $image) {
      $img = $image['image'];
        
      echo '<div class="swiper-slide">
        <img src="' . $img['url'] . '" alt="' . $img['alt'] . '" title="' . $img['title'] . '" />
      </div>';
    }
    
    echo '</div>
      <div class="swiper-pagination"></div>
    </div>
    </div>';
    
    // Include Swiper & Necessary Javascript
    $swiperInit = '<script>
      var swiper = new Swiper(".swiperGalleryThumbs", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
      });
      var swiper2 = new Swiper(".swiperGalleryLarge", {
        loop: true,
        spaceBetween: 10,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        thumbs: {
          swiper: swiper,
        },
      });
    </script>';
    
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], false, true );
    wp_add_inline_script('swiper-js', $swiperInit, 'after');
    
  }
  
  protected function renderGalleryRow() {
    echo 'Rendering Images as Gallery Row.';
  }
}