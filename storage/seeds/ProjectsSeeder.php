<?php

use Phinx\Seed\AbstractSeed;

class ProjectsSeeder extends AbstractSeed {
    
  public function run() {
    $data = [
      [
        'title' => 'Tenchido Obernai',
        'description' => "Refonte design du site du club de karaté d'Obernai. J'avais carte blanche pour créer le design, en gardant les couleurs principales du club et le logo. J'ai réalisé l'intégration Html, Css et Javascript dans la structure Php existante. J'ai choisi de réaliser le style en utilisant le préprocesseur Sass, sans aucun framework.",
        'image' => 18,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Bienvenue Albin',
        'description' => "Une page de présentation pour la naissance du fils à un ami. Page réalisée en Html, Css et Javascript. J'ai réalisé le style en utilisant le préprocesseur Sass, sans aucun framework. J'ai réalisé le diaporama en Javascript ES6.",
        'image' => 19,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'Jeu du Tic Tac Toe',
        'description' => "Petite application du jeu du Tic Tac Toe faite en javascript pendant ma formation à la 3WAcademy. J'ai récement fait quelques modifications au niveau du style et des couleurs.",
        'image' => 20,
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'title' => 'App de prise de notes',
        'description' => "Une application de prise de notes, réalisée en suivant une série de vidéos sur CodeCourse.com qui montre comment utiliser VueJs et Vuex.",
        'image' => 21,
        'created' => date('Y-m-d H:i:s')
      ],
    ];

    $projects = $this->table('projects');
    $projects->insert($data)->save();
  }
    
}
