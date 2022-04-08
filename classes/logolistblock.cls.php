<?php

    
class LogoListBlock extends Block {
    public $logoListLayout;
    public $logolist;
    
    public function __construct($row, $block_count = null) {
      /*
       * Make sure we call the parent constructor
       * to initialize all section-level options.
       */
      parent::__construct($row);

      // $this->logoListLayout = $this->row['style'];
      // $this->logolist = $this->row[$this->logoListLayout];
     
    }
    
    /*
     * This method is called by the parent's render()
     * method and should never be called directly. Use
     * it to define output for the inner content
     * containers of the child class for each block type.
     */
    protected function renderContent() {
      $listType = $this->row['list_type'];

      if ($listType == 'custom') {
        include( TEMPLATEPATH . '/acf-layouts/sub-layouts/logo-list--custom.php' ) ;
      }

      if($listType == 'manufacturers') {
        include( TEMPLATEPATH . '/acf-layouts/sub-layouts/logo-list--manufacturers.php');
      }

      if($listType == 'associations') {
        
        include( TEMPLATEPATH . '/acf-layouts/sub-layouts/logo-list--associations.php');
      }
    }
}