<?php

namespace Tests\Core\Validation;

use PHPUnit\Framework\TestCase;
use Portfolio\Core\Validation\Validator;

/**
 * Description of ValidatorTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class ValidationErrorTest extends TestCase {
  
  public function testRequiredFail() {
    $errorMessage = $this->makeValidator(['name' => 'joe'])->required('name', 'content')->getErrors();
    $this->assertEquals("Ce champs est requis", (string) $errorMessage['content']);
  }
  
  public function testNotEmptyErrorMessage() {
    $errorMessage = $this->makeValidator(['name' => ''])->notEmpty('content')->getErrors();
    $this->assertEquals("Ce champs est obligatoire", (string) $errorMessage['content']);
  }
  
  public function testEmailErrorMessage() {
    $errorMessage = $this->makeValidator(['email' => 'test'])->email('email')->getErrors();
    $this->assertEquals("Le champs email doit être valide", (string) $errorMessage['email']);
  }
  
  public function testSlugMessageError() {
    $errorMessage = $this->makeValidator(['slug' => '-demo-'])->slug('slug')->getErrors();
    $this->assertEquals("Ce champs n'est pas valide (a-z 0-9 -)", (string) $errorMessage['slug']);
  }
  
  public function testLengthErrorMessage() {
    $params = ['name' => '123456789'];
    
    $minError = $this->makeValidator($params)->length('name', 12)->getErrors();
    $this->assertEquals("Minimum requis 12 caractères", (string) $minError['name']);
    
    $maxError = $this->makeValidator($params)->length('name', null, 8)->getErrors();
    $this->assertEquals("Maximum requis 8 caractères", (string) $maxError['name']);
    
    $betweenError = $this->makeValidator($params)->length('name', 3, 4)->getErrors();
    $this->assertEquals("Minimum requis entre 3 et 4 caractères", (string) $betweenError['name']);
  }
  
  public function testDatetimeErrorMessage() {
    $errorMessage = $this->makeValidator(['datetime' => '2010-08-31'])->dateTime('datetime')->getErrors();
    $this->assertEquals("La date et l'heure doivent être valide (Y-m-d H:i:s)", (string) $errorMessage['datetime']);
  }
  
  public function testDateErrorMessage() {
    $errorMessage = $this->makeValidator(['date' => '2010-06-31'])->date('date')->getErrors();
    $this->assertEquals("La date doit être valide (Y-m-d)", (string) $errorMessage['date']);
  }
  
  public function testTimeErrorMessage() {
    $errorMessage = $this->makeValidator(['time' => '37:73:73'])->time('time')->getErrors();
    $this->assertEquals("L'heure doit être valide (H:i:s)", (string) $errorMessage['time']);
  }
  
  private function makeValidator(array $params) {
    
    return new Validator($params);
  }
}
