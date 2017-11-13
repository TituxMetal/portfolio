<?php

namespace Portfolio\Modules\Project\Table;

use PDO;
use Portfolio\Core\Database\Table;
use Portfolio\Modules\Common\Table\PictureTable;
use Portfolio\Modules\Project\Entity\Project;

/**
 * Description of ProjectTable
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class ProjectTable extends Table {
  
  /**
   * @var string
   */
  protected $alias = 'Proj';
  
  /**
   * @var Project
   */
  protected $entity = Project::class;
  
  /**
   * @var PictureTable
   */
  protected $pictureTable;
  
  /**
   * @var string
   */
  protected $table = 'Projects';
  
  /**
   * @var array
   */
  protected $fields = [
    'id', 'name', 'content', 'pictureId', 'created', 'updated'
  ];
  
  /**
   * @var array
   */
  public $fillable = [
    'name', 'content', 'pictureId', 'mainLink', 'sourceLink', 'updated'
  ];
  
  public function __construct(PDO $pdo) {
    parent::__construct($pdo);
    $this->pictureTable = new PictureTable($pdo);
  }
  
  public function findWithPicture($order = null, $limit = null) {
    $currentIndexField = "$this->alias.pictureId";
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
   * @param int $resultNb
   * @return type
   */
  public function findForHome(int $resultNb = 12) {
    
    return $this->findWithPicture("$this->alias.created DESC", $resultNb);
  }
}
