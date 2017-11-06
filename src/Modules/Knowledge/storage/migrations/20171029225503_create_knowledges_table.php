<?php

use Phinx\Migration\AbstractMigration;

class CreateKnowledgesTable extends AbstractMigration
{
  public function change() {
    
    $this->table('Knowledges')
      ->addColumn('name', 'string')
      ->addColumn('created', 'datetime')
      ->addColumn('updated', 'datetime')
      ->create();
  }
}
