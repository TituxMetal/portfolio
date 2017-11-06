<?php

use Phinx\Migration\AbstractMigration;

class CreateTechnologiesTable extends AbstractMigration {
  
  public function change() {
    
    $this->table('Technologies')
      ->addColumn('name', 'string')
      ->addColumn('created', 'datetime')
      ->addColumn('updated', 'datetime')
      ->create();
  }
}
