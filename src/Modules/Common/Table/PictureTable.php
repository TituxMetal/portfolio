<?php

namespace Portfolio\Modules\Common\Table;

use Portfolio\Core\Database\Table;
use Portfolio\Modules\Common\Entity\Picture;

/**
 * Description of PictureTable
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class PictureTable extends Table {
  
  /**
   * @var string
   */
  protected $alias = 'Pictures';
  
  /**
   * @var Picture
   */
  protected $entity = Picture::class;
  
  /**
   * @var array
   */
  protected $fields = [
    'id', 'uri', 'title', 'created', 'updated'
  ];
  
  /**
   * @var array
   */
  public $fillable = [
    'uri', 'title', 'created', 'updated'
  ];
  
  /**
   * @var string
   */
  protected $table = 'Pictures';
}
