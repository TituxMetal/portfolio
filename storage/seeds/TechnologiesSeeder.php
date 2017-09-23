<?php

use Phinx\Seed\AbstractSeed;

class TechnologiesSeeder extends AbstractSeed {
    
  public function run() {
    $data = [
      [
        'title' => 'Html5',
        'image' => 1,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Css3',
        'image' => 2,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Javascript',
        'image' => 3,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Php',
        'image' => 4,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'MariaDb',
        'image' => 5,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Sass',
        'image' => 6,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Atom',
        'image' => 7,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Git',
        'image' => 8,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Composer',
        'image' => 9,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Gulp',
        'image' => 10,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Docker',
        'image' => 11,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Ansible',
        'image' => 12,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'JQuery',
        'image' => 13,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Bootstrap',
        'image' => 14,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Foundation',
        'image' => 15,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Laravel',
        'image' => 16,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Symfony',
        'image' => 17,
        'created' => date('Y-m-d H:i:s')
      ],
    ];

    $technologies = $this->table('technologies');
    $technologies->insert($data)->save();
  }
    
}
