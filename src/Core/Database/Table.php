<?php

namespace Portfolio\Core\Database;

use PDO;
use Portfolio\Core\Database\Query;
use stdClass;

/**
 * Description of Table.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Table {

  /**
   * @var PDO
   */
  private $pdo;
  
  /**
   * @var array
   */
  protected $fields = [];
  
  /**
   * Name of the table in database.
   *
   * @var string
   */
  protected $table;
  
  /**
   * Name of the entity to use.
   *
   * @var string
   */
  protected $entity = stdClass::class;

  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }
  
  /**
   * Find all items.
   *
   * @return Query
   */
  public function findAll() {
    
    return $this->makeQuery();
  }
  
  /**
   * Find an item by its id.
   *
   * @param int $id
   * @return mixed
   * @throws NoRecordException
   */
  public function find(int $id) {
    
    return $this->makeQuery()
      ->select($this->getFields())
      ->where("id = $id")
      ->fetchOrFail();
  }
  
  /**
   * Paginate all items.
   *
   * @param int $perPage
   * @param int $currentPage
   * @return mixed
   */
  public function findPaginated(int $perPage = 15, int $currentPage = 1) {
    
    return $this->makeQuery()
      ->select($this->getFields())
      ->paginate($perPage, $currentPage);
  }
  
  /**
   * Find an item by its $fieldName.
   *
   * @param string $fieldName
   * @param string $value
   * @return mixed
   */
  public function findBy(string $fieldName, string $value) {
    
    return $this->makeQuery()
      ->select($this->getFields())
      ->where("$fieldName = :field")
      ->params(['field' => $value])
      ->fetchOrFail();
  }
  
  /**
   * Returns a list of items.
   *
   * @return array
   */
  public function findList(): array {
    $results = $this->pdo
      ->query("SELECT {$this->getFields()} FROM {$this->table} ")
      ->fetchAll(PDO::FETCH_NUM);
    
    $list = [];
    
    foreach ($results as $result) {
      $list[$result[0]] = $result[1];
    }
    
    return $list;
  }
  
  /**
   * Returns the number of items.
   *
   * @return int
   */
  public function count(): int {
    
    return $this->makeQuery()->count();
  }
  
  /**
   * Insert an item in database.
   *
   * @param array $params
   * @return bool
   */
  public function insert(array $params): bool {
    $fieldsParams = array_keys($params);
    $values = join(',', array_map(function ($field) {
      return ":{$field}";
    }, $fieldsParams));
    $fields = join(',', $fieldsParams);
    
    $statement = $this->pdo->prepare(
      "INSERT INTO {$this->table}
      ({$fields}) VALUES ({$values})"
    );
    
    if ($this->entity) {
      $statement->setFetchMode(PDO::FETCH_CLASS, $this->entity);
    }
    
    return $statement->execute($params);
  }
  
  /**
   * Update an item in database.
   *
   * @param int $id
   * @param array $params
   * @return bool
   */
  public function update(int $id, array $params): bool {
    $fieldQuery = $this->buildFielsQuery($params);
    $params['id'] = $id;
    
    $statement = $this->pdo->prepare(
      "UPDATE {$this->table}
      SET {$fieldQuery}
      WHERE id = :id"
    );
    
    if ($this->entity) {
      $statement->setFetchMode(PDO::FETCH_CLASS, $this->entity);
    }
    
    return $statement->execute($params);
  }
  
  /**
   * Delete an item in database.
   *
   * @param int $id
   * @return bool
   */
  public function delete(int $id): bool {
    $statement = $this->pdo->prepare(
      "DELETE FROM {$this->table} WHERE id = ?"
    );
    
    return $statement->execute([$id]);
  }
  
  /**
   * Check if a record exists.
   *
   * @param type $id
   * @return bool
   */
  public function exists($id): bool {
    $statement = $this->pdo->prepare("
      SELECT id
      FROM {$this->table}
      WHERE id = ?
    ");
    $statement->execute([$id]);
    
    return $statement->fetchColumn() !== false;
  }
  
  /**
   * Make a query with the query builder.
   *
   * @return Query
   */
  public function makeQuery(): Query {
    
    return (new Query($this->pdo))
      ->from($this->table, $this->table[0])
      ->into($this->entity);
  }
  
  /**
   * Get the PDO instance.
   *
   * @return PDO
   */
  public function getPdo(): PDO {
    
    return $this->pdo;
  }
  
  /**
   * Returns the table to use.
   *
   * @return string
   */
  public function getTable(): string {
    
    return $this->table;
  }
  
  /**
   * Returns the entity to use.
   *
   * @return string
   */
  public function getEntity(): string {
    
    return $this->entity;
  }
  
  /**
   * Returns the last inserted id.
   *
   * @return int
   */
  public function getLastInsertId() {
    
    return $this->pdo->lastInsertId();
  }
  
  /**
   * Returns the fields separated by a comma.
   *
   * @return string
   */
  protected function getFields(): string {
    
    return $this->fields ? implode(', ', $this->fields) : '*';
  }
  
  /**
   * Builds the fields query from the parameters.
   *
   * @param array $params
   * @return string
   */
  private function buildFielsQuery(array $params): string {
    
    return join(', ', array_map(function ($field) {
      return "{$field} = :{$field}";
    }, array_keys($params)));
  }
}
