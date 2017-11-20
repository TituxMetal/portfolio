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
  protected $alias = 'Pict';
  
  /**
   * @var Picture
   */
  protected $entity = Picture::class;
  
  /**
   * @var array
   */
  public $fields = [
    'id', 'uri', 'title'
  ];
  
  /**
   * @var array
   */
  public $fillable = [
    'uri', 'title'
  ];
  
  /**
   * @var string
   */
  protected $table = 'Picture';
}
