<?php

namespace Tests\Core\TwigExtensions;

use PHPUnit\Framework\TestCase;
use Portfolio\Core\TwigExtensions\FormExtension;

/**
 * Description of FormExtensionTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class FormExtensionTest extends TestCase {
  
  /**
   * @var FormExtension
   */
  private $formExtension;
  
  /**
   * @var array
   */
  private $context;

  public function setUp() {
    $this->formExtension = new FormExtension();
    $this->context = [
      'errors' => [
        'title' => 'error'
      ]
    ];
  }
  
  public function testInputText() {
    $html = $this->formExtension->field(
      [],
      'title',
      "demo",
      'Titre de test'
    );
    
    $this->assertSimilar("
    <div class=\"default-class\">
      <label for=\"title\">
        Titre de test
      </label>
      <input type=\"text\" name=\"title\" id=\"title\" value=\"demo\">
    </div>", $html);
  }
  
  public function testInputDatetime() {
    $html = $this->formExtension->field(
      [],
      'datetime',
      "2017/01/01 00:00:00",
      'Date time',
      ['type' => 'datetime']
    );
    
    $this->assertSimilar("
    <div class=\"default-class\">
      <label for=\"datetime\">
        Date time
      </label>
      <input type=\"datetime\" name=\"datetime\" id=\"datetime\" class=\"datepicker\" value=\"2017/01/01 00:00:00\">
    </div>", $html);
  }
  
  public function testFieldWithErrors() {
    $textInput = $this->formExtension->field(
      $this->context,
      'title',
      "demo",
      'Titre de test',
      ['fieldError' => true, 'errorClass' => 'custom-error-class']
    );
    
    $this->assertSimilar("
    <div class=\"default-class custom-error-class\">
      <label for=\"title\">
        Titre de test
      </label>
      <input type=\"text\" name=\"title\" id=\"title\" value=\"demo\">
      <span>
        error
      </span>
    </div>", $textInput);
    
    $textarea = $this->formExtension->field(
      $this->context,
      'title',
      "demo",
      'Titre de test',
      ['type' => 'textarea', 'fieldError' => true]
    );
    
    $this->assertSimilar("
    <div class=\"default-class field-error\">
      <label for=\"title\">
        Titre de test
      </label>
      <textarea name=\"title\" id=\"title\">demo</textarea>
      <span>
        error
      </span>
    </div>", $textarea);
  }
  
  public function testTextarea() {
    $html = $this->formExtension->field(
      [],
      'title',
      "demo",
      'Titre de test',
      ['type' => 'textarea']
    );
    
    $this->assertSimilar("
    <div class=\"default-class\">
      <label for=\"title\">
        Titre de test
      </label>
      <textarea name=\"title\" id=\"title\">demo</textarea>
    </div>", $html);
  }
  
  public function testSelect() {
    $html = $this->formExtension->field(
      [],
      'title',
      2,
      'Titre',
      ['options' => [1 => 'Demo', '2' => 'Demo 2']]
    );
    
    $this->assertSimilar("
      <div class=\"default-class\">
      <label for=\"title\">
        Titre
      </label>
      <select name=\"title\" id=\"title\">
        <option value=\"1\">Demo</option>
        <option value=\"2\" selected>Demo 2</option>
      </select>
    </div>
      ", $html);
  }
  
  public function testErrorField() {
    $error = $this->formExtension->errorField($this->context);
    
    $this->assertSimilar("
    <ul class=\"super-error-class\">
      <li>
        <span>
          error
        </span>
      </li>
    </ul>", $error);
  }
  
  public function testNoErrorField() {
    $error = $this->formExtension->errorField([]);
    
    $this->assertEquals("", $error);
  }
  
  public function testErrorFieldWithCustomErrorClass() {
    $error = $this->formExtension->errorField(
      $this->context,
      'custom-error-class'
    );
    
    $this->assertSimilar("
    <ul class=\"custom-error-class\">
      <li>
        <span>
          error
        </span>
      </li>
    </ul>", $error);
  }
  
  private function trim(string $string): string {
    
    return implode('', array_map('trim', explode(PHP_EOL, $string)));
  }
  
  private function assertSimilar(string $expected, string $actual) {
    $this->assertEquals($this->trim($expected), $this->trim($actual));
  }
}
