<?php

namespace Tests\Core\Validation;

use Portfolio\Core\Database\Table;
use Portfolio\Core\Validation\Validator;
use ReflectionClass;
use Tests\DatabaseTestCase;

/**
 * Description of ValidatorTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class ValidatorTest extends DatabaseTestCase {
  
  public function setUp() {
    parent::setUp();
  }
  
  public function testIsValid() {
    $params = ['name' => 'joe'];
    
    $isValid = $this->makeValidator($params)
      ->required('name')->isValid();
    
    $this->assertTrue($isValid);
    
    $isNotValid = $this->makeValidator($params)
      ->required('name')->notEmpty('content')->isValid();
    
    $this->assertFalse($isNotValid);
  }
  
  public function testRequiredFail() {
    $errors = $this->makeValidator(['name' => 'joe'])
      ->required('name', 'content')
      ->getErrors();
    
    $this->assertCount(1, $errors);
    $this->assertEquals("Ce champs est requis", (string) $errors['content']);
  }
  
  public function testRequiredSuccess() {
    $errors = $this->makeValidator(['name' => 'joe', 'content' => 'demo'])
      ->required('name', 'content')
      ->getErrors();
    
    $this->assertCount(0, $errors);
  }
  
  public function testValidEmail() {
    $errors = $this->makeValidator(['email' => 'test@demo.com'])
      ->email('email')
      ->getErrors();
    
    $this->assertCount(0, $errors);
  }
  
  public function testNotValidEmail() {
    $errors = $this->makeValidator(['email' => 'testInvalidEmail'])
      ->email('email')
      ->getErrors();
    
    $this->assertCount(1, $errors);
    $this->assertEquals("Le champs email doit être valide", (string) $errors['email']);
  }
  
  public function testSlugSuccess() {
    $errors = $this->makeValidator(['slug' => 'demo-test', 'slug2' => 'demo'])
      ->slug('slug')
      ->slug('slug2')
      ->getErrors();
    
    $this->assertCount(0, $errors);
  }
  
  public function testNotEmpty() {
    $errors = $this->makeValidator(['name' => '', 'content' => ''])
      ->required('name', 'content')
      ->notEmpty('content')
      ->getErrors();
    
    $this->assertCount(1, $errors);
  }
  
  public function testSlugFail() {
    $errors = $this->makeValidator([
      'slug' => '-demo-',
      'slug1' => 'demo-Test42',
      'slug2' => 'demo_Test42',
      'slug3' => 'demo--test-ok-ok42',
      'slug4' => '-demo-ok-42'
    ])
      ->slug('slug')
      ->slug('slug1')
      ->slug('slug2')
      ->slug('slug3')
      ->slug('slug4')
      ->slug('emptySlug')
      ->getErrors();
    
    $this->assertCount(5, $errors);
  }
  
  public function testLength() {
    $params = ['name' => '123456789'];
    
    $minError = $this->makeValidator($params)->length('name', 12)->getErrors();
    $this->assertCount(1, $minError);
    $this->assertEquals("Minimum requis 12 caractères", (string) $minError['name']);
    
    $maxError = $this->makeValidator($params)->length('name', null, 8)->getErrors();
    $this->assertCount(1, $maxError);
    $this->assertEquals("Maximum requis 8 caractères", (string) $maxError['name']);
    
    $betweenError = $this->makeValidator($params)->length('name', 3, 4)->getErrors();
    $this->assertCount(1, $betweenError);
    $this->assertEquals("Minimum requis entre 3 et 4 caractères", (string) $betweenError['name']);
    
    $this->assertCount(0, $this->makeValidator($params)->length('name', 3)->getErrors());
    
    $this->assertCount(0, $this->makeValidator($params)->length('name', 3, 20)->getErrors());
  }
  
  public function testDatetime() {
    $this->assertCount(0, $this->makeValidator(['datetime' => '2010-06-30 12:13:14'])->dateTime('datetime')->getErrors());
    $this->assertCount(0, $this->makeValidator(['datetime' => '2010-08-31 00:00:00'])->dateTime('datetime')->getErrors());
    $this->assertCount(1, $this->makeValidator(['datetime' => '1977-08-18 37:13:00'])->dateTime('datetime')->getErrors());
    $this->assertCount(1, $this->makeValidator(['datetime' => '2010-13-11 00:00:00'])->dateTime('datetime')->getErrors());
    $this->assertCount(1, $this->makeValidator(['datetime' => '2010-12-37 00:00:00'])->dateTime('datetime')->getErrors());
    $this->assertCount(1, $this->makeValidator(['datetime' => '2015-02-29 00:00:00'])->dateTime('datetime')->getErrors());
    $this->assertCount(1, $this->makeValidator(['datetime' => ''])->dateTime('datetime')->getErrors());
    
    $errorMessage = $this->makeValidator(['datetime' => '2010-08-31'])->dateTime('datetime')->getErrors();
    $this->assertEquals("La date et l'heure doivent être valide (Y-m-d H:i:s)", (string) $errorMessage['datetime']);
  }
  
  public function testDate() {
    $this->assertCount(0, $this->makeValidator(['date' => '2010-06-30'])->date('date')->getErrors());
    $this->assertCount(0, $this->makeValidator(['date' => '2010-08-31'])->date('date')->getErrors());
    $this->assertCount(1, $this->makeValidator(['date' => '1977-80-18'])->date('date')->getErrors());
    $this->assertCount(1, $this->makeValidator(['date' => '2010-13-11'])->date('date')->getErrors());
    $this->assertCount(1, $this->makeValidator(['date' => '2010-12-37'])->date('date')->getErrors());
    $this->assertCount(1, $this->makeValidator(['date' => '2015-02-29'])->date('date')->getErrors());
    $this->assertCount(1, $this->makeValidator(['date' => ''])->date('date')->getErrors());
    
    $errorMessage = $this->makeValidator(['date' => '2010-06-31'])->date('date')->getErrors();
    $this->assertEquals("La date doit être valide (Y-m-d)", (string) $errorMessage['date']);
  }
  
  public function testTime() {
    $this->assertCount(0, $this->makeValidator(['time' => '13:37:42'])->time('time')->getErrors());
    $this->assertCount(1, $this->makeValidator(['time' => '2015-09-11 13:37:42'])->time('time')->getErrors());
    $this->assertCount(1, $this->makeValidator(['time' => '37:13:42'])->time('time')->getErrors());
    $this->assertCount(1, $this->makeValidator(['time' => '13:73:42'])->time('time')->getErrors());
    $this->assertCount(1, $this->makeValidator(['time' => '13:42:73'])->time('time')->getErrors());
    $this->assertCount(1, $this->makeValidator(['time' => ''])->time('time')->getErrors());
    
    $errorMessage = $this->makeValidator(['time' => '37:73:73'])->time('time')->getErrors();
    $this->assertEquals("L'heure doit être valide (H:i:s)", (string) $errorMessage['time']);
  }
  
  public function testExists() {
    $table = new Table($this->pdo);
    
    $reflection = new ReflectionClass($table);
    $property = $reflection->getProperty('table');
    $property->setAccessible(true);
    $property->setValue($table, 'test');
    
    for ($i = 1; $i <= 5; ++$i) {
      $table->insert(['title' => "test{$i}"]);
    }
    
    $this->assertTrue(
      $this->makeValidator(['category' => 3])
      ->exists('category', $table)
      ->isValid()
    );
    
    $this->assertTrue(
      $this->makeValidator(['category' => 5])
      ->exists('category', $table)
      ->isValid()
    );
    
    $this->assertFalse(
      $this->makeValidator(['category' => 10])->exists('category', $table)->isValid()
        );
  }
  
  private function makeValidator(array $params) {
    
    return new Validator($params);
  }
}
