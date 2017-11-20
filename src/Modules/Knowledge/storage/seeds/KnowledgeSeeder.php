<?php

use Phinx\Seed\AbstractSeed;

class KnowledgeSeeder extends AbstractSeed {
  
  public function run() {
    $datetime = date('Y-m-d H:i:s');
    $data = [
        [
          'name' => 'Développement back-end',
          'created' => $datetime,
          'updated' => $datetime,
        ],
        [
          'name' => 'Intégration front-end',
          'created' => $datetime,
          'updated' => $datetime,
        ],
        [
          'name' => 'Responsive web design',
          'created' => $datetime,
          'updated' => $datetime,
        ],
        [
          'name' => 'Optimisation seo',
          'created' => $datetime,
          'updated' => $datetime,
        ],
        [
          'name' => 'Gestion de versions du code source',
          'created' => $datetime,
          'updated' => $datetime,
        ],
        [
          'name' => 'Administration de serveurs Linux',
          'created' => $datetime,
          'updated' => $datetime,
        ],
      ];
    
    $this->table('Knowledge')
      ->insert($data)
      ->save();
  }
}
