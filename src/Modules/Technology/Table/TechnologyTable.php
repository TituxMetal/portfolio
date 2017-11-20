<?php

namespace Portfolio\Modules\Technology\Table;

use PDO;
use Portfolio\Core\Database\Table;
use Portfolio\Modules\Common\Table\PictureTable;
use Portfolio\Modules\Technology\Entity\Technology;

/**
 * Description of TechnologyTable
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class TechnologyTable extends Table {
  
  /**
   * @var string
   */
  protected $alias = 'Tech';
  
  /**
   * @var Technology
   */
  protected $entity = Technology::class;
  
  /**
   * @var PictureTable
   */
  protected $pictureTable;
  
  /**
   * @var string
   */
  protected $table = 'Technology';
  
  /**
   * @var array
   */
  protected $fields = [
    'id', 'name', 'picture', 'created', 'updated'
  ];
  
  /**
   * @var array
   */
  public $fillable = [
    'name', 'picture', 'updated'
  ];
  
  public function __construct(PDO $pdo) {
    parent::__construct($pdo);
    $this->pictureTable = new PictureTable($pdo);
  }
  
  public function find(int $id) {
    $currentIndexField = "$this->alias.pictureId";
    $query = $this->makeRelationQuery($this, $this->pictureTable, $currentIndexField);
    $query->where("$this->alias.id = $id");
    
    return $this->makeRelationResult($query, 'picture', $this, $this->pictureTable);
  }
  
  public function findWithPicture($order = null, $limit = null) {
    $currentIndexField = "$this->alias.picture";
    $query = $this->makeRelationQuery($this, $this->pictureTable, $currentIndexField);
    
    if ($limit) {
      $query->limit($limit);
    }
    
    if ($order) {
      $query->order($order);
    }
    
    return $this->makeRelationResults($query, 'picture', $this, $this->pictureTable);
  }
  
  /**
   * Find the items for the home page.
   *
   * @return Technology[]
   */
  public function getAll() {
    
    return $this->findWithPicture("$this->alias.created DESC");
  }
  
  /**
   * Paginate all items.
   *
   * @param int $perPage
   * @param int $currentPage
   * @return mixed
   */
  public function findPaginated(int $perPage = 15, int $currentPage = 1) {
    $relatedTable = $this->pictureTable->getTable();
    
    return $this->findAll()
      ->select($this->getAliasedFields(), $this->pictureTable->getAliasedFields())
      ->from($this->table, $this->alias)
      ->order("$this->alias.created DESC")
      ->join($relatedTable, "$relatedTable.id = $this->alias.pictureId")
      ->paginate($perPage, $currentPage);
  }
  
  /**
   * Delete an item in database.
   *
   * @param int $id
   * @return bool
   */
  public function delete(int $id): bool {
    $item = $this->find($id);
    $statement = $this->getPdo()->prepare(
      "DELETE FROM {$this->table} WHERE id = ?"
    );
    
    if ($statement->execute([$id])) {
      
      return $this->pictureTable->delete($item->getPictureId());
    }
  }
}
