<?php

use Phinx\Seed\AbstractSeed;

class KnowledgesSeeder extends AbstractSeed {
    
    public function run() {
      $data = [
        [
          'title' => 'Développement back-end',
          'created' => date('Y-m-d H:i:s')
        ],
        [
          'title' => 'Intégration front-end',
          'created' => date('Y-m-d H:i:s')
        ],
        [
          'title' => 'Responsive web design',
          'created' => date('Y-m-d H:i:s')
        ],
        [
          'title' => 'Optimisation seo',
          'created' => date('Y-m-d H:i:s')
        ],
        [
          'title' => 'Gestion de versions du code source',
          'created' => date('Y-m-d H:i:s')
        ],
        [
          'title' => 'Administration de serveurs Linux',
          'created' => date('Y-m-d H:i:s')
        ],
      ];
      
      $knowledges = $this->table('knowledges');
      $knowledges->insert($data)->save();
    }
    
}
