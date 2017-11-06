<?php

namespace Portfolio\Modules\Knowledge\Table;

use DateTime;
use Portfolio\Core\Database\Table;
use Portfolio\Modules\Knowledge\Entity\Knowledge;

/**
 * Description of KnowledgeTable
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class KnowledgeTable extends Table {
  
  protected $entity = Knowledge::class;
  
  protected $table = 'Knowledges';
  
  protected $fields = [
    'id', 'name', 'created', 'updated'
  ];
  
  /**
   * Find the Knowledges for the home page.
   *
   * @param int $resultNb
   * @return type
   */
  public function findForHome(int $resultNb = 5) {
    
    return $this->findAll()
      ->limit($resultNb)
      ->order('created DESC')
      ->fetchAll();
  }
  
  /**
   * Paginate all items.
   *
   * @param int $perPage
   * @param int $currentPage
   * @return mixed
   */
  public function findPaginated(int $perPage = 15, int $currentPage = 1) {
    
    return $this->findAll()
      ->select($this->getFields())
      ->order('created DESC')
      ->paginate($perPage, $currentPage);
  }
}
