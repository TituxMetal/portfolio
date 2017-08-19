<?php

use Phinx\Seed\AbstractSeed;

class TechnologiesSeeder extends AbstractSeed {
    
  public function run() {
    $data = [
      [
        'title' => 'Html5',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Css3',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Javascript',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Php',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'MariaDb',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Sass',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Atom',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Git',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Composer',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Gulp',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Docker',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Ansible',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'JQuery',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Bootstrap',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Foundation',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Laravel',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Symfony',
        'created' => date('Y-m-d H:i:s')
      ],
    ];

    $technologies = $this->table('technologies');
    $technologies->insert($data)->save();
  }
    
}
