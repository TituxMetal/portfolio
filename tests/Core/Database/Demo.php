<?php

namespace Tests\Core\Database;

/**
 * Description of Demo
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Demo {
  
  private $title;
  
  private $slug;
  
  public function getTitle() {
    
    return $this->title;
  }
  
  public function setTitle($title) {
    $this->title = $title;
  }
  
  public function getSlug() {
    
    return $this->slug;
  }
  
  public function setSlug($slug) {
    $this->slug = $slug . 'demo';
  }
}
