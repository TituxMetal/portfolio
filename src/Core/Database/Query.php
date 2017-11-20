<?php

namespace Portfolio\Core\Database;

use Pagerfanta\Pagerfanta;
use PDO;
use PDOStatement;
use Portfolio\Core\Database\Exceptions\NoRecordException;
use Portfolio\Core\Database\Hydrator;
use Portfolio\Core\Database\PaginatedQuery;
use Portfolio\Core\Database\QueryResult;

/**
 * Description of Query
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Query {
  
  /**
   * @var string
   */
  private $entity;
  
  /**
   * @var array
   */
  private $from = [];
  
  /**
   * @var array
   */
  private $joins = [];
  
  /**
   * @var string
   */
  private $limit;
  
  /**
   * @var array
   */
  private $order = [];
  
  /**
   * @var array
   */
  private $params = [];
  
  /**
   * @var PDO|null
   */
  private $pdo;
  
  /**
   * @var string
   */
  private $select;
  
  /**
   * @var array
   */
  private $where = [];
  
  /**
   *
   * @param PDO|null $pdo
   */
  public function __construct($pdo = null) {
    $this->pdo = $pdo;
  }
  
  /**
   * Define the fields to get
   *
   * @param string[] ...$fields
   * @return Query
   */
  public function select(string ...$fields): self {
    $this->select = $fields;
    
    return $this;
  }
  
  /**
   * Define the FROM for the query
   *
   * @param string $table
   * @param string|null $alias
   * @return Query
   */
  public function from(string $table, $alias = null): self {
    
    if ($alias) {
      $this->from[$table] = $alias;
    } else {
      $this->from[] = $table;
    }
    
    return $this;
  }
  
  /**
   * Define the WHERE condition for the query
   *
   * @param string[] ...$condition
   * @return Query
   */
  public function where(string ...$condition): self {
    $this->where = array_merge($this->where, $condition);
    
    return $this;
  }
  
  /**
   * Define the JOIN for the query
   *
   * @param string $table
   * @param string $condition
   * @param string $type
   * @return Query
   */
  public function join(string $table, string $condition, string $type = 'left'): self {
    $this->joins[$type][] = [$table, $condition];
    
    return $this;
  }
  
  /**
   * Define the ORDER for the query
   *
   * @param string $order
   * @return Query
   */
  public function order(string $order): self {
    $this->order[] = $order;
    
    return $this;
  }
  
  /**
   * Define the LIMIT for the query
   *
   * @param int $length
   * @param int $offset
   * @return Query
   */
  public function limit(int $length, int $offset = 0): self {
    $this->limit = "$offset, $length";
    
    return $this;
  }
  
  /**
   * Make a COUNT query
   *
   * @return int
   */
  public function count(): int {
    $query = clone $this;
    $table = current($this->from);
    
    return $query->select("COUNT($table.id)")->execute()->fetchColumn();
  }
  
  /**
   * Define the parameters for the query
   *
   * @param array $params
   * @return Query
   */
  public function params(array $params): self {
    $this->params = array_merge($this->params, $params);
    
    return $this;
  }
  
  /**
   * Define the entity to use for the query
   *
   * @param string $entity
   * @return Query
   */
  public function into(string $entity): self {
    $this->entity = $entity;
    
    return $this;
  }
  
  /**
   * Return a result
   *
   * @return mixed
   */
  public function fetch() {
    $record = $this->execute()->fetch(PDO::FETCH_ASSOC);
    
    if ($record === false) {
      return false;
    }
    
    if ($this->entity) {
      return Hydrator::hydrate($record, $this->entity);
    }
    
    return $record;
  }
  
  /**
   * Return a result with $columnNumber column(s)
   *
   * @param int $columnNumber
   * @return mixed
   */
  public function fetchColumn(int $columnNumber = 0) {
    
    return $this->execute()->fetchColumn($columnNumber);
  }
  
  /**
   * Return a result or throw an exception if no records
   *
   * @return bool|mixed
   * @throws NoRecordException
   */
  public function fetchOrFail() {
    $record = $this->fetch();
    
    if ($record === false) {
      throw new NoRecordException("No record for this id");
    }
    
    return $record;
  }
  
  /**
   * Launch the query
   *
   * @return QueryResult
   */
  public function fetchAll(): QueryResult {
    
    return new QueryResult(
      $this->execute()->fetchAll(PDO::FETCH_ASSOC),
      $this->entity
    );
  }
  
  /**
   * Paginate a set of results
   *
   * @param int $perPage
   * @param int $currentPage
   * @return Pagerfanta
   */
  public function paginate(int $perPage, int $currentPage = 1): Pagerfanta {
    $paginator = new PaginatedQuery($this);
    
    return (new Pagerfanta($paginator))
      ->setMaxPerPage($perPage)
      ->setCurrentPage($currentPage);
  }
  
  /**
   * Generate the string query
   *
   * @return string
   */
  public function __toString() {
    $parts = ['SELECT'];
    $parts[] = ($this->select) ? join(', ', $this->select) : '*';
    
    $parts[] = 'FROM';
    $parts[] = $this->buildFrom();
    
    if (!empty($this->joins)) {
      
      foreach ($this->joins as $type => $joins) {
        $parts[] = $this->buildJoins($type, $joins);
      }
    }
    
    if (!empty($this->where)) {
      $parts[] = "WHERE";
      $parts[] = "(" . join(') AND (', $this->where) . ")";
    }
    
    if (!empty($this->order)) {
      $parts[] = "ORDER BY " . join(', ', $this->order);
    }
    
    if (!empty($this->limit)) {
      $parts[] = "LIMIT " . $this->limit;
    }
    
    return join(' ', $parts);
  }
  
  /**
   * Build a FROM for the query
   *
   * @return string
   */
  private function buildFrom(): string {
    $from = [];
    
    foreach ($this->from as $key => $value) {
      $from[] = (is_string($key)) ? "$key AS $value" : $value;
    }
    
    return join(', ', $from);
  }
  
  /**
   * Build a JOIN for the query
   *
   * @param string $type
   * @param array $joins
   * @return string
   */
  private function buildJoins(string $type, array $joins): string {
    
    foreach ($joins as $v) {
      $table = $v[0];
      $condition = $v[1];
      
      $query[] = strtoupper($type) . " JOIN $table ON $condition";
    }
    
    return join(' ', $query);
  }
  
  /**
   * Execute the query
   *
   * @return PDOStatement
   */
  private function execute(): PDOStatement {
    $query = $this->__toString();
    
    if (!empty($this->params)) {
      $statement = $this->pdo->prepare($query);
      $statement->execute($this->params);
        
      return $statement;
    }
    
    return $this->pdo->query($query);
  }
}
