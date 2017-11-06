<?php

namespace Tests\Core\Database;

use Portfolio\Core\Database\Exceptions\NoRecordException;
use Portfolio\Core\Database\Table;
use ReflectionClass;
use stdClass;
use Tests\DatabaseTestCase;

/**
 * Description of TableTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class TableTest extends DatabaseTestCase {
  
  /**
   *
   * @var Table
   */
  private $table;
  
  public function setUp() {
    parent::setUp();
    
    $this->table = new Table($this->pdo);
    
    $reflection = new ReflectionClass($this->table);
    $property = $reflection->getProperty('table');
    $property->setAccessible(true);
    $property->setValue($this->table, 'test');
  }
  
  public function testFind() {
    $this->makeData();
    $test = $this->table->find(1);
    
    $this->assertInstanceOf(stdClass::class, $test);
    $this->assertEquals('aze1', $test->title);
  }
  
  public function testFindList() {
    $this->makeData(2);
    
    $this->assertEquals(['1' => 'aze1', '2' => 'aze2'], $this->table->findList());
  }
  
  public function testFindAll() {
    $this->makeData(2);
    
    $test = $this->table->findAll()->fetchAll();
    
    $this->assertCount(2, $test);
    $this->assertInstanceOf(stdClass::class, $test[0]);
    $this->assertEquals('aze1', $test[0]->title);
    $this->assertEquals('aze2', $test[1]->title);
  }
  
  public function testFindAllPaginate() {
    $this->makeData();
    
    $test = $this->table->findAll()->paginate(5);
    
    $this->assertCount(5, $test->getCurrentPageResults());
    $this->assertEquals(100/5, $test->getNbPages());
    $this->assertEquals('aze5', $test->getCurrentPageResults()[4]->title);
  }
  
  public function testFindBy() {
    $this->pdo->exec('INSERT INTO test (title) VALUES ("a1")');
    $this->pdo->exec('INSERT INTO test (title) VALUES ("a2")');
    $this->pdo->exec('INSERT INTO test (title) VALUES ("a1")');
    
    $test = $this->table->findBy('title', 'a1');
    
    $this->assertInstanceOf(stdClass::class, $test);
    $this->assertEquals(1, (int) $test->id);
  }
  
  public function testExists() {
    $this->makeData(2);
    
    $this->assertTrue($this->table->exists(1));
    $this->assertTrue($this->table->exists(2));
    $this->assertFalse($this->table->exists(1337));
  }
  
  public function testCount() {
    $this->pdo->exec('INSERT INTO test (title) VALUES ("a1")');
    $this->pdo->exec('INSERT INTO test (title) VALUES ("a2")');
    $this->pdo->exec('INSERT INTO test (title) VALUES ("a1")');
    
    $this->assertEquals(3, $this->table->count());
  }

  public function testFindNotFoundRecord() {
    $this->expectException(NoRecordException::class);
    
    $this->table->find(1);
  }
  
  public function testUpdate() {
    $this->table->insert(['title' => 'a1', 'slug' => 'a-1']);
    $this->table->insert(['title' => 'a2', 'slug' => 'a-2']);
    $this->table->update(1, ['title' => 'Demo', 'slug' => 'demo']);
    $test = $this->table->find(1);
    
    $this->assertInstanceOf(stdClass::class, $test);
    $this->assertEquals($test->title, 'Demo');
    $this->assertEquals($test->slug, 'demo');
  }
  
  public function testInsert() {
    $this->table->insert([
      'title' => 'Demo',
      'slug' => 'demo'
    ]);
    $test = $this->table->find(1);
    
    $this->assertInstanceOf(stdClass::class, $test);
    $this->assertEquals($test->title, 'Demo');
    $this->assertEquals($test->slug, 'demo');
  }
  
  public function testDelete() {
    $this->table->insert(['title' => 'a1', 'slug' => 'a-1']);
    $this->table->insert(['title' => 'a2', 'slug' => 'a-2']);
    
    $this->assertEquals(2, $this->table->count());
    
    $this->table->delete(1);
    
    $this->assertEquals(1, $this->table->count());
  }
}
