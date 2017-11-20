<?php

namespace Portfolio\Modules\Common\Entity;

/**
 * Description of Link
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Link {
  
  /**
   * @var int|null
   */
  private $id;
  
  /**
   * @var string|null
   */
  private $label;
  
  /**
   * @var string|null
   */
  private $iconClass;
  
  /**
   * @var string|null
   */
  private $type;
  
  /**
   * @var string|null
   */
  private $uri;
  
  /**
   * @var string|null
   */
  private $title;
  
  /**
   * Get the id of the picture
   *
   * @return int|null
   */
  public function getId() {
    
    return $this->id;
  }
  
  /**
   * Get the label of the link
   *
   * @return string|null
   */
  public function getLabel() {
    
    return $this->label;
  }
  
  /**
   * Get the iconClass of the link
   *
   * @return string|null
   */
  public function getIconClass() {
    
    return $this->iconClass;
  }
  
  /**
   * Get the type of the link
   *
   * @return string|null
   */
  public function getType() {
    
    return $this->type;
  }
  
  /**
   * Get the uri of the link
   *
   * @return string|null
   */
  public function getUri() {
    
    return $this->uri;
  }
  
  /**
   * Get the title of the link
   *
   * @return string|null
   */
  public function getTitle() {
    
    return $this->title;
  }
  
  /**
   * Set the id for the link
   *
   * @param int $id
   */
  public function setId(int $id): void {
    $this->id = $id;
  }
  
  /**
   * Set the label of the link
   * 
   * @param string|null $label
   */
  public function setLabel($label): void {
    $this->label = $label;
  }
  
  /**
   * Set the iconClass for the link
   * 
   * @param string|null $iconClass
   */
  public function setIconClass($iconClass): void {
    $this->iconClass = $iconClass;
  }
  
  /**
   * Set the type for the link
   * 
   * @param string|null $type
   */
  public function setType($type): void {
    $this->type = $type;
  }
  
  /**
   * Set the uri for the link
   *
   * @param string $uri
   */
  public function setUri(string $uri): void {
    $this->uri = $uri;
  }
  
  /**
   * Set the title for the link
   *
   * @param string $title
   */
  public function setTitle(string $title): void {
    $this->title = $title;
  }
}
