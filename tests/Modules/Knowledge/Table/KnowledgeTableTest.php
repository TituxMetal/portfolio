<?php

namespace Tests\Modules\Knowledge\Table;

use Portfolio\Modules\Knowledge\Entity\Knowledge;
use Portfolio\Modules\Knowledge\Table\KnowledgeTable;
use Tests\DatabaseTestCase;

/**
 * Description of KnowledgeTable
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class KnowledgeTableTest extends DatabaseTestCase {
  
  private $table;
  
  public function setUp() {
    parent::setUp();
    
    $this->table = new KnowledgeTable($this->pdo);
    $this->makeKnowledgeTable();
  }
  
  public function testGetAll() {
    $this->makeKnowledgeData();
    $test = $this->table->getAll();
    
    $this->assertInstanceOf(Knowledge::class, $test[0]);
    $this->assertEquals('aze1', $test[0]->getName());
    $this->assertCount(100, $test);
  }
  
  public function testFindPaginated() {
    $this->makeKnowledgeData();
    $test = $this->table->findPaginated(5);
    
    $this->assertCount(5, $test->getCurrentPageResults());
    $this->assertEquals(100/5, $test->getNbPages());
    $this->assertEquals('aze5', $test->getCurrentPageResults()[4]->getName());
  }
}
