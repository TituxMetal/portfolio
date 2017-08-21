<?php

use Phinx\Seed\AbstractSeed;

class ProjectsSeeder extends AbstractSeed {
    
  public function run() {
    $data = [
      [
        'name' => 'Tenchido Obernai',
        'description' => "Refonte design du site du club de karaté d'Obernai. J'avais carte blanche pour créer le design, en gardant les couleurs principales du club et le logo. J'ai réalisé l'intégration Html, Css et Javascript dans la structure Php existante. J'ai choisi de réaliser le style en utilisant le préprocesseur Sass, sans aucun framework.",
        'image' => 18,
        'main_link' => 1,
        'sources_link' => 2,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'name' => 'Bienvenue Albin',
        'description' => "Une page de présentation pour la naissance du fils à un ami. Page réalisée en Html, Css et Javascript. J'ai réalisé le style en utilisant le préprocesseur Sass, sans aucun framework. J'ai réalisé le diaporama en Javascript ES6.",
        'image' => 19,
        'main_link' => 3,
        'sources_link' => 4,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'name' => 'Jeu du Tic Tac Toe',
        'description' => "Petite application du jeu du Tic Tac Toe faite en javascript pendant ma formation à la 3WAcademy. J'ai récement fait quelques modifications au niveau du style et des couleurs.",
        'image' => 20,
        'main_link' => 5,
        'sources_link' => 6,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'name' => 'App de prise de notes',
        'description' => "Une application de prise de notes, réalisée en suivant une série de vidéos sur CodeCourse.com qui montre comment utiliser VueJs et Vuex.",
        'image' => 21,
        'main_link' => 7,
        'sources_link' => 8,
        'created' => date('Y-m-d H:i:s')
      ],
    ];

    $projects = $this->table('projects');
    $projects->insert($data)->save();
  }
    
}
