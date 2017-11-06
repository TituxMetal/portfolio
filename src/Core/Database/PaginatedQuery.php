<?php

namespace Portfolio\Core\Database;

use Pagerfanta\Adapter\AdapterInterface;
use Portfolio\Core\Database\Query;
use Portfolio\Core\Database\QueryResult;

/**
 * Description of PaginatedQuery
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class PaginatedQuery implements AdapterInterface {

  /**
   * @var string
   */
  private $query;

  /**
   * PaginatedQuery constructor.
   *
   * @param Query $query
   */
  public function __construct(Query $query) {
    $this->query = $query;
  }
  
  /**
   * Returns the number of results.
   *
   * @return integer The number of results.
   */
  public function getNbResults(): int {
    
    return $this->query->count();
  }

  /**
   * Returns a slice of the results.
   *
   * @param integer $offset The offset.
   * @param integer $length The length.
   * @return QueryResult
   */
  public function getSlice($offset, $length) {
    $query = clone $this->query;
    
    return $query->limit($length, $offset)->fetchAll();
  }
}
