<?php

use Phinx\Seed\AbstractSeed;

class ImagesSeeder extends AbstractSeed {
    
  public function run() {
    $data = [
      [
        'alt' => 'Html5',
        'src' => '/assets/img/tech/html5_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Css3',
        'src' => '/assets/img/tech/css3_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Javascript',
        'src' => '/assets/img/tech/javascript_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Php',
        'src' => '/assets/img/tech/php_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'MariaDb',
        'src' => '/assets/img/tech/mariadb_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Sass',
        'src' => '/assets/img/tech/sass_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Atom',
        'src' => '/assets/img/tech/atom_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Git',
        'src' => '/assets/img/tech/git_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Composer',
        'src' => '/assets/img/tech/composer_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Gulp',
        'src' => '/assets/img/tech/gulp_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Docker',
        'src' => '/assets/img/tech/docker_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Ansible',
        'src' => '/assets/img/tech/ansible_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'JQuery',
        'src' => '/assets/img/tech/jquery_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Bootstrap',
        'src' => '/assets/img/tech/bootstrap_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Foundation',
        'src' => '/assets/img/tech/foundation_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Laravel',
        'src' => '/assets/img/tech/laravel_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Symfony',
        'src' => '/assets/img/tech/symfony_logo.png',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => "Site du Tenchido d'Orbernai",
        'src' => '/assets/img/projects/projectsTenchido.jpg',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Page de bienvenue du jeune Albin',
        'src' => '/assets/img/projects/projectsAlbin.jpg',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Jeu du Tic Tac Toe',
        'src' => '/assets/img/projects/projectsTicTacToe.jpg',
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'alt' => 'Application de prise de notes',
        'src' => '/assets/img/projects/porjectsNotesapp.jpg',
        'created' => date('Y-m-d H:i:s')
      ],
    ];

    $technologies = $this->table('images');
    $technologies->insert($data)->save();
  }
    
}
