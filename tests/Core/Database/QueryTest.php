<?php

namespace Tests\Core\Database;

use Portfolio\Core\Database\Exceptions\NoRecordException;
use Portfolio\Core\Database\Query;
use Tests\DatabaseTestCase;
use Tests\Core\Database\Demo;

/**
 * Description of QueryTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class QueryTest extends DatabaseTestCase {
  
  public function testSimpleQuery() {
    $query = (new Query($this->pdo))->from('test')->select('a1', 'a2');
    
    $this->assertEquals('SELECT a1, a2 FROM test', (string) $query);
  }
  
  public function testWithWhere() {
    $query = (new Query($this->pdo))
      ->from('test', 't')
      ->where('a = :a OR b = :b', 'c = :c');
    $query2 = (new Query($this->pdo))
      ->from('test', 't')
      ->where('a = :a OR b = :b')
      ->where('c = :c');
    
    $this->assertEquals('SELECT * FROM test AS t WHERE (a = :a OR b = :b) AND (c = :c)', (string) $query);
    $this->assertEquals('SELECT * FROM test AS t WHERE (a = :a OR b = :b) AND (c = :c)', (string) $query2);
  }
  
  public function testFetch() {
    $this->makeData();
    
    $test = (new Query($this->pdo))
      ->select('title, slug')
      ->from('test')
      ->where('id = 2')
      ->fetch();
    
    $this->assertEquals('aze2', $test['title']);
  }
  
  public function testFetchAll() {
    $this->makeData();
    
    $test100 = (new Query($this->pdo))
      ->from('test', 't')
      ->count();
    
    $this->assertEquals(100, $test100);
    
    $test29 = (new Query($this->pdo))
      ->from('test', 't')
      ->where('t.id < :number')
      ->params(['number' => 30])
      ->count();
    
    $this->assertEquals(29, $test29);
  }
  
  public function testFetchColumn() {
    $this->makeData();
    
    $test = (new Query($this->pdo))
      ->from('test', 't')
      ->fetchColumn();
    
    $this->assertEquals(1, $test);
  }
  
  public function testFetchOrFail() {
    $this->makeData();
    
    $test = (new Query($this->pdo))
      ->from('test')
      ->where('title = :title')
      ->params(['title' => 'aze3'])
      ->into(Demo::class)
      ->fetchOrFail();
    
    $this->assertEquals($test->getTitle(), 'aze3');
    
    $this->expectException(NoRecordException::class);
    (new Query($this->pdo))
      ->from('test')
      ->where('title = :title')
      ->params(['title' => 'test'])
      ->fetchOrFail();
  }
  
  public function testHydrateEntity() {
    $this->makeData();
    
    $tests = (new Query($this->pdo))
      ->from('test', 't')
      ->into(Demo::class)
      ->fetchAll();
    
    $this->assertEquals('demo', substr($tests[0]->getSlug(), -4));
  }
  
  public function testLimitOrder() {
    $query = (new Query($this->pdo))
      ->from('test', 't')
      ->select('title')
      ->order('id DESC')
      ->order('title ASC')
      ->limit(10, 5);
    
    $this->assertEquals(
      'SELECT title FROM test AS t ORDER BY id DESC, title ASC LIMIT 5, 10',
      (string) $query
    );
  }
  
  public function testLazyHydrate() {
    $this->makeData();
    
    $tests = (new Query($this->pdo))
      ->from('test', 't')
      ->into(Demo::class)
      ->fetchAll();
    
    $test1 = $tests[0];
    $test2 = $tests[0];
    
    $this->assertSame($test1, $test2);
  }
  
  public function testJoinQuery() {
    $tests = (new Query($this->pdo))
      ->from('test', 't')
      ->select('title')
      ->join('demo AS d', 'd.id = t.demo_id')
      ->join('demo AS d2', 'd2.id = t.demo_id', 'inner');
    
    $this->assertEquals(
      'SELECT title ' . 'FROM test AS t ' . 'LEFT JOIN demo AS d ON d.id = t.demo_id ' . 'INNER JOIN demo AS d2 ON d2.id = t.demo_id',
      (string) $tests
        );
  }
}
