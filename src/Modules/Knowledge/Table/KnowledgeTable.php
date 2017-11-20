<?php

namespace Portfolio\Modules\Knowledge\Table;

use Portfolio\Core\Database\Table;
use Portfolio\Modules\Knowledge\Entity\Knowledge;

/**
 * Description of KnowledgeTable
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class KnowledgeTable extends Table {
  
  protected $entity = Knowledge::class;
  
  protected $table = 'Knowledge';
  
  protected $fields = [
    'id', 'name', 'created', 'updated'
  ];
  
  /**
   * Find the Knowledges for the home page.
   *
   * @param int $resultNb
   * @return Knowledge[]
   */
  public function getAll() {
    
    return $this->findAll()
      ->order('created DESC')
      ->fetchAll();
  }
}
