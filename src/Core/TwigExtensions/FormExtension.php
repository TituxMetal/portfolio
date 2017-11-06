<?php

namespace Portfolio\Core\TwigExtensions;

use DateTime;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Description of FormExtension
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class FormExtension extends Twig_Extension {
  
  public function getFunctions(): array {
    
    return [
      new Twig_SimpleFunction('field', [$this, 'field'], [
        'is_safe' => ['html'],
        'needs_context' => true
      ]),
      new Twig_SimpleFunction('errorField', [$this, 'errorField'], [
        'is_safe' => ['html'],
        'needs_context' => true
      ])
    ];
  }
  
  public function field(array $context, string $key, $fieldValue, string $label, array $options = []): string {
    $type = $options['type'] ?? 'text';
    $class = $options['class'] ?? 'default-class';
    $isError = $context['errors'] ?? false;
    $errorClass = $options['errorClass'] ?? 'field-error';
    $fieldError = $options['fieldError'] ?? false;
    $htmlError = '';
    $value = $this->convertValue($fieldValue);
    $attributes = [
      'name' => $key,
      'id' => $key,
    ];
    
    if ($isError) {
      $class .= " $errorClass";
    }
    
    if ($type === 'textarea') {
      $input = $this->textarea($value, $attributes);
    } elseif ($type === 'datetime') {
      $attributes['class'] = 'datepicker';
      $input = $this->input($value, $attributes, $type);
    } elseif (array_key_exists('options', $options)) {
      $input = $this->select($value, $options['options'], $attributes);
    } else {
      $input = $this->input($value, $attributes);
    }
    
    if ($fieldError === true) {
      $htmlError = $this->getHtmlError($context, $key);
    }
    
    return "
      <div class=\"$class\">
        <label for=\"$key\">
          $label
        </label>
        $input
        $htmlError
      </div>";
  }
  
  public function errorField(array $context, string $errorClass = null) {
    if (array_key_exists('errors', $context)) {
      $keys = array_keys($context['errors']) ?? false;
      if (!$errorClass) {
        $class = 'super-error-class';
      } else {
        $class = $errorClass;
      }
      
      
      $errors = implode('', array_map(function ($key) use ($context) {
        return "<li>" . $this->getHtmlError($context, $key) . "</li>";
      }, $keys));
      
      return "<ul class=\"$class\">" . $errors . "</ul>";
    }
  }
  
  private function textarea($value = '', array $attributes = []): string {
    
    return "<textarea " . $this->getHtmlFromArray($attributes) . ">$value</textarea>";
  }
  
  private function input($value = '', array $attributes = [], string $type = 'text'): string {
    return "<input type=\"$type\" " . $this->getHtmlFromArray($attributes) . " value=\"$value\">";
  }
  
  private function select(string $value, array $options, array $attributes): string {
    $htmlOptions = array_reduce(array_keys($options), function (string $html, string $key) use ($options, $value) {
      $params = ['value' => $key, 'selected' => $key === $value];
      
      return $html . '<option ' . $this->getHtmlFromArray($params) . '>' . $options[$key] . '</option>';
    }, "");
    
    return "<select " . $this->getHtmlFromArray($attributes) . ">$htmlOptions</select>";
  }
  
  private function getHtmlError(array $context, string $key) {
    $error = $context['errors'][$key] ?? false;
    
    if ($error) {
      return "<span>$error</span>";
    }
  }
  
  private function getHtmlFromArray(array $attributes) {
    $htmlParts = [];
    
    foreach ($attributes as $key => $value) {
      if (is_bool($value)) {
        $htmlParts[] = $value === true ? (string) $key : false;
      } else {
        $htmlParts[] = "$key=\"$value\"";
      }
    }
    
    return trim(implode(' ', $htmlParts));
  }

  private function convertValue($value): string {
    if ($value instanceof DateTime) {
      return $value->format('Y-m-d H:i:s');
    }
    
    return (string) $value;
  }
}
