<?php

namespace Portfolio\Modules\Technology\Table;

use Portfolio\Core\Database\Table;
use Portfolio\Modules\Technology\Entity\Technology;

/**
 * Description of TechnologyTable
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class TechnologyTable extends Table {
  
  protected $entity = Technology::class;
  
  protected $table = 'Technologies';
  
  protected $fields = [
    'id', 'name', 'created', 'updated'
  ];
  
  /**
   * Find the items for the home page.
   *
   * @param int $resultNb
   * @return type
   */
  public function findForHome(int $resultNb = 12) {
    
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
