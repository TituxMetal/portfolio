<?php

use Phinx\Seed\AbstractSeed;

class TechnologySeeder extends AbstractSeed {
  
  public function run() {
    $pData = [
      [
        'title' => 'Html5',
        'uri' => '/assets/img/tech/html5Logo.png',
      ],
      [
        'title' => 'Css3',
        'uri' => '/assets/img/tech/css3Logo.png',
      ],
      [
        'title' => 'Javascript',
        'uri' => '/assets/img/tech/javascriptLogo.png',
      ],
      [
        'title' => 'Php',
        'uri' => '/assets/img/tech/phpLogo.png',
      ],
      [
        'title' => 'MariaDb',
        'uri' => '/assets/img/tech/mariadbLogo.png',
      ],
      [
        'title' => 'Sass',
        'uri' => '/assets/img/tech/sassLogo.png',
      ],
      [
        'title' => 'Atom',
        'uri' => '/assets/img/tech/atomLogo.png',
      ],
      [
        'title' => 'Git',
        'uri' => '/assets/img/tech/gitLogo.png',
      ],
      [
        'title' => 'Composer',
        'uri' => '/assets/img/tech/composerLogo.png',
      ],
      [
        'title' => 'Gulp',
        'uri' => '/assets/img/tech/gulpLogo.png',
      ],
      [
        'title' => 'Docker',
        'uri' => '/assets/img/tech/dockerLogo.png',
      ],
      [
        'title' => 'Ansible',
        'uri' => '/assets/img/tech/ansibleLogo.png',
      ],
      [
        'title' => 'JQuery',
        'uri' => '/assets/img/tech/jqueryLogo.png',
      ],
      [
        'title' => 'Bootstrap',
        'uri' => '/assets/img/tech/bootstrapLogo.png',
      ],
      [
        'title' => 'Foundation',
        'uri' => '/assets/img/tech/foundationLogo.png',
      ],
      [
        'title' => 'Laravel',
        'uri' => '/assets/img/tech/laravelLogo.png',
      ],
      [
        'title' => 'Symfony',
        'uri' => '/assets/img/tech/symfonyLogo.png',
      ],
    ];
    $datetime = date('Y-m-d H:i:s');
    $tData = [
      [
        'name' => 'Html5',
        'picture' => 5,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Css3',
        'picture' => 6,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Javascript',
        'picture' => 7,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Php',
        'picture' => 8,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'MariaDb',
        'picture' => 9,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Sass',
        'picture' => 10,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Atom',
        'picture' => 11,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Git',
        'picture' => 12,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Composer',
        'picture' => 13,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Gulp',
        'picture' => 14,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Docker',
        'picture' => 15,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Ansible',
        'picture' => 16,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'JQuery',
        'picture' => 17,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Bootstrap',
        'picture' => 18,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Foundation',
        'picture' => 19,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Laravel',
        'picture' => 20,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Symfony',
        'picture' => 21,
        'created' => $datetime,
        'updated' => $datetime,
      ],
    ];
    
    $this->table('Picture')
      ->insert($pData)
      ->save();
    
    $this->table('Technology')
      ->insert($tData)
      ->save();
  }
}
