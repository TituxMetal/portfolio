<?php

namespace Tests\Modules\Technology\Table;

use Portfolio\Modules\Common\Entity\Picture;
use Portfolio\Modules\Technology\Entity\Technology;
use Portfolio\Modules\Technology\Table\TechnologyTable;
use Tests\DatabaseTestCase;

/**
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class TechnologyTableTest extends DatabaseTestCase {
  
  private $table;
  
  public function setUp() {
    parent::setUp();
    
    $this->table = new TechnologyTable($this->pdo);
    $this->makeTechnologiesTable();
  }
  
  public function testFindForHome() {
    $this->makeTechnologiesData();
    $test = $this->table->findForHome(5);
    
    $this->assertInstanceOf(Technology::class, $test[0]);
    $this->assertInstanceOf(Picture::class, $test[0]->getPicture());
    $this->assertInstanceOf(\DateTime::class, $test[0]->getCreated());
    $this->assertEquals('aze1', $test[0]->getName());
    $this->assertEquals('/assets/pictures/aze1', $test[0]->getPicture()->getUri());
    $this->assertEquals(1, $test[0]->getPictureId());
    $this->assertCount(5, $test);
  }
  
  public function testFindPaginated() {
    $this->makeTechnologiesData();
    $test = $this->table->findPaginated(5);
    
    $this->assertInstanceOf(Technology::class, $test->getCurrentPageResults()[0]);
    $this->assertInstanceOf(\DateTime::class, $test->getCurrentPageResults()[0]->getUpdated());
    $this->assertCount(5, $test->getCurrentPageResults());
    $this->assertEquals(100/5, $test->getNbPages());
    $this->assertEquals('aze5', $test->getCurrentPageResults()[4]->getName());
  }
}
