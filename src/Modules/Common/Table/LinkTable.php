<?php

namespace Portfolio\Modules\Common\Table;

use Portfolio\Core\Database\Table;
use Portfolio\Modules\Common\Entity\Link;

/**
 * Description of LinkTable
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class LinkTable extends Table {
  
  /**
   * @var string
   */
  protected $alias = 'Link';
  
  /**
   * @var Link
   */
  protected $entity = Link::class;
  
  /**
   * @var array
   */
  public $fields = [
    'id', 'label', 'iconClass', 'uri', 'title'
  ];
  
  /**
   * @var array
   */
  public $fillable = [
    'label', 'iconClass', 'uri', 'title'
  ];
  
  /**
   * @var string
   */
  protected $table = 'Link';
}
