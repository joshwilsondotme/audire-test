<?php

class ColumnText extends Column {

  public $content;
    
  public function __construct($data) {
    parent::__construct($data);
    
    $this->content = $data[$this->content_type . '_content_settings'][$this->content_type]['content'];
  }
    
  protected function renderContent() {
    echo $this->content;
  }
}