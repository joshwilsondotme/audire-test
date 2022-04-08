<?php
 
/*
 * TO DO
 *
 * Full viewport / Partial viewport options
 * Split Content
 *
 */
    
class StandardBlock extends Block {
    public $columns;
    
    public function __construct($row, $block_count = null) {
      /*
       * Make sure we call the parent constructor
       * to initialize all section-level options.
       */
      parent::__construct($row);
      
      if( !empty($columns = $this->row['columns']) ) {

        foreach ($columns as $column) {          
          $columnClass = 'Column' . str_replace(' ', '', ucwords(str_replace('_', ' ', $column['content_type'])));
          $this->columns[] = new $columnClass($column);
        }
        
      }
    }
    
    /*
     * This method is called by the parent's render()
     * method and should never be called directly. Use
     * it to define output for the inner content
     * containers of the child class for each block type.
     */
    protected function renderContent() {
      foreach ($this->columns as $column) {
        $column->render();
      }
    }
}