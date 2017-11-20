<?php

namespace Portfolio\Modules\Project\Table;

use PDO;
use Portfolio\Core\Database\Hydrator;
use Portfolio\Core\Database\Query;
use Portfolio\Core\Database\Table;
use Portfolio\Modules\Common\Table\LinkTable;
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
   * @var LinkTable
   */
  protected $linkTable;
  
  /**
   * @var string
   */
  protected $table = 'Project';
  
  /**
   * @var array
   */
  protected $fields = [
    'id', 'name', 'content', 'picture', 'created', 'updated'
  ];
  
  /**
   * @var array
   */
  public $fillable = [
    'name', 'content', 'picture', 'mainLink', 'srcsLink', 'updated'
  ];
  
  public function __construct(PDO $pdo) {
    parent::__construct($pdo);
    $this->pictureTable = new PictureTable($pdo);
    $this->linkTable = new LinkTable($pdo);
  }
  
  public function findAllWithRelations($order = null, $limit = null) {
    $projectAlias = $this->getAlias();
    $pictureTable = $this->pictureTable;
    $link = $this->linkTable;
    
    $query = $this->makeQuery()
      ->select(
        $this->getAliasedFields('_'),
        $this->makeAliasedPrefixedFields($pictureTable->getFields(), 'pict', 'picture'),
        $this->makeAliasedPrefixedFields($link->getFields(), 'mainLink', 'main'),
        $this->makeAliasedPrefixedFields($link->getFields(), 'srcsLink', 'source')
      )
      ->from($this->table, $this->alias)
      ->join($pictureTable->getTable() . " AS pict", "pict.id = {$projectAlias}.picture")
      ->join($link->getTable() . " AS mainLink", "mainLink.type = 'main'")
      ->join($link->getTable() . " AS srcsLink", "srcsLink.type = 'srcs' OR srcsLink.type = 'revs'")
      ->where("mainLink.project = {$projectAlias}.id AND srcsLink.project = {$projectAlias}.id");
    
    if ($order) {
      $query->order($order);
    }
    
    if ($limit) {
      $query->limit($limit);
    }
    
    $queryResults = $this->getPdo()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    
    $queryResultsCount = count($queryResults);
    $filterResults = [];
    $items = [];
    $setPicture = 'setPicture';
    $setMainLink = 'setMainLink';
    $setSourceLink = 'setSourceLink';
    
    for ($i = 0; $i < $queryResultsCount; ++$i) {
      $results = $queryResults[$i];
      
      foreach ($results as $key => $value) {
        $filterResults[$i]['projects'][$this->rmPrefix('_', $key)] = $value;
        $filterResults[$i]['picture'][$this->rmPrefix('picture', $key)] = $value;
        $filterResults[$i]['main'][$this->rmPrefix('main', $key)] = $value;
        $filterResults[$i]['source'][$this->rmPrefix('source', $key)] = $value;
      }
      
      $filterResults[$i]['projects'] = $this->clearFields($filterResults[$i]['projects'], $this->fields);
      $filterResults[$i]['picture'] = $this->clearFields($filterResults[$i]['picture'], $this->pictureTable->fields);
      $filterResults[$i]['main'] = $this->clearFields($filterResults[$i]['main'], $this->linkTable->fields);
      $filterResults[$i]['source'] = $this->clearFields($filterResults[$i]['source'], $this->linkTable->fields);
      $items[$i] = Hydrator::hydrate($filterResults[$i]['projects'], $this->getEntity());
      $items[$i]->$setPicture(Hydrator::hydrate($filterResults[$i]['picture'], $this->pictureTable->getEntity()));
      $items[$i]->$setMainLink(Hydrator::hydrate($filterResults[$i]['main'], $this->linkTable->getEntity()));
      $items[$i]->$setSourceLink(Hydrator::hydrate($filterResults[$i]['source'], $this->linkTable->getEntity()));
    }
    
    return $items;
  }
  
  /**
   * Find the items for the home page.
   *
   * @param int $resultNb
   * @return type
   */
  public function getAll() {
    
    return $this->findAllWithRelations("$this->alias.created DESC");
  }
  
  /**
   * Make a query with multiple join relations and returns it to execution.
   * 
   * @param Table|mixed $current The current table for the relation.
   * @param mixed[] $related The related tables for the relations.
   * @param array $indexFields The index fields for the relations.
   * @return Query The query with the relation to execute.
   */
  private function makeMultiRelationsQuery($current, array $related = [], array $indexFields = []) {
    
  }
}
