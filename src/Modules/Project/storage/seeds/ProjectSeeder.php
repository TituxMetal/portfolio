<?php

use Phinx\Seed\AbstractSeed;

class ProjectSeeder extends AbstractSeed {
  
  public function run() {
    $pictData = [
      [
        'title' => "Site du Tenchido d'Orbernai",
        'uri' => '/assets/img/projects/projectTenchido.jpg',
      ],
      [
        'title' => 'Page de bienvenue du jeune Albin',
        'uri' => '/assets/img/projects/projectAlbin.jpg',
      ],
      [
        'title' => 'Jeu du Tic Tac Toe',
        'uri' => '/assets/img/projects/projectTicTacToe.jpg',
      ],
      [
        'title' => 'Application de prise de notes',
        'uri' => '/assets/img/projects/projectNotesapp.jpg',
      ],
    ];
    $datetime = date('Y-m-d H:i:s');
    $projData = [
      [
        'name' => 'Tenchido Obernai',
        'content' => "Refonte design du site du club de karaté d'Obernai. J'avais carte blanche pour créer le design, en gardant les couleurs principales du club et le logo. J'ai réalisé l'intégration Html, Css et Javascript dans la structure Php existante. J'ai choisi de réaliser le style en utilisant le préprocesseur Sass, sans aucun framework.",
        'picture' => 1,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Bienvenue Albin',
        'content' => "Une page de présentation pour la naissance du fils à un ami. Page réalisée en Html, Css et Javascript. J'ai réalisé le style en utilisant le préprocesseur Sass, sans aucun framework. J'ai réalisé le diaporama en Javascript ES6.",
        'picture' => 2,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'Jeu du Tic Tac Toe',
        'content' => "Petite application du jeu du Tic Tac Toe faite en javascript pendant ma formation à la 3WAcademy. J'ai récement fait quelques modifications au niveau du style et des couleurs.",
        'picture' => 3,
        'created' => $datetime,
        'updated' => $datetime,
      ],
      [
        'name' => 'App de prise de notes',
        'content' => "Une application de prise de notes, réalisée en suivant une série de vidéos sur CodeCourse.com qui montre comment utiliser VueJs et Vuex.",
        'picture' => 4,
        'created' => $datetime,
        'updated' => $datetime,
      ],
    ];
    $linkData = [
      [
        'label' => "Voir le projet",
        'iconClass' => 'fa-globe',
        'type' => 'main',
        'uri' => "http://tenchido.fr",
        'title' => "Karaté Tenchido Obernai après la refonte",
        'project' => 1,
      ],
      [
        'label' => "Projet avant refonte",
        'iconClass' => 'fa-globe',
        'type' => 'srcs',
        'uri' => "https://web.archive.org/web/20161028195201/http://www.tenchido.fr/",
        'title' => "Karaté Tenchido Obernai avant la refonte",
        'project' => 1,
      ],
      [
        'label' => "Voir le projet",
        'iconClass' => 'fa-globe',
        'type' => 'main',
        'uri' => "https://albinweyer.fr",
        'title' => "Page de bienvenue du jeune Albin",
        'project' => 2,
      ],
      [
        'label' => "Voir les sources",
        'iconClass' => 'fa-github',
        'type' => 'srcs',
        'uri' => "https://github.com/TituxMetal/welcomAlbin",
        'title' => "Code source de la page de bienvenue du jeune Albin",
        'project' => 2,
      ],
      [
        'label' => "Voir le projet",
        'iconClass' => 'fa-globe',
        'type' => 'main',
        'title' => "Jeu du Tic Tac Toe",
        'uri' => "https://tuxtactoe.ovh",
        'project' => 3,
      ],
      [
        'label' => "Voir les sources",
        'iconClass' => 'fa-github',
        'type' => 'srcs',
        'uri' => "https://github.com/TituxMetal/ticTacToe",
        'title' => "Code source du jeu du Tic Tac Toe",
        'project' => 3,
      ],
      [
        'label' => "Voir le projet",
        'iconClass' => 'fa-globe',
        'type' => 'main',
        'uri' => "https://notes.tuxlab.fr",
        'title' => "Application de prise de notes",
        'project' => 4,
      ],
      [
        'label' => "Voir les sources",
        'iconClass' => 'fa-github',
        'type' => 'srcs',
        'uri' => "https://github.com/TituxMetal/vuejsNotes",
        'title' => "Code source de l'application de prise de notes",
        'project' => 4,
      ],
    ];
    
    $this->table('Picture')
      ->insert($pictData)
      ->save();
    
    $this->table('Project')
      ->insert($projData)
      ->save();
    
    $this->table('Link')
      ->insert($linkData)
      ->save();
  }
}
