<?php

use Phinx\Seed\AbstractSeed;

class LinksSeeder extends AbstractSeed {
    
  public function run() {
    $data = [
      [
        'href' => "http://tenchido.fr",
        'label' => "Voir le projet",
        'title' => "Karaté Tenchido Obernai après la refonte",
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'href' => "https://web.archive.org/web/20161028195201/http://www.tenchido.fr/",
        'label' => "Projet avant refonte",
        'title' => "Karaté Tenchido Obernai avant la refonte",
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'href' => "https://albin.tuxlab.fr",
        'label' => "Voir le projet",
        'title' => "Page de bienvenue du jeune Albin",
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'href' => "https://github.com/TituxMetal/welcomAlbin",
        'label' => "Voir les sources",
        'title' => "Code source de la page de bienvenue du jeune Albin",
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'href' => "https://tuxtactoe.tuxlab.fr",
        'label' => "Voir le projet",
        'title' => "Jeu du Tic Tac Toe",
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'href' => "https://github.com/TituxMetal/ticTacToe",
        'label' => "Voir les sources",
        'title' => "Code source du jeu du Tic Tac Toe",
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'href' => "https://notes.tuxlab.fr",
        'label' => "Voir le projet",
        'title' => "App de prise de notes",
        'created' => date('Y-m-d H:i:s')
      ],
      [
        'href' => "https://github.com/TituxMetal/vuejsNotes",
        'label' => "Voir les sources",
        'title' => "Code source de l'application de prise de notes",
        'created' => date('Y-m-d H:i:s')
      ],
    ];

    $links = $this->table('links');
    $links->insert($data)->save();
  }
    
}
