<?php

use Phinx\Migration\AbstractMigration;

class CreateKnowledgeTable extends AbstractMigration
{
  public function change() {
    
    $this->table('Knowledge', ['signed' => false])
      ->addColumn('name', 'string', ['limit' => 128])
      ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
      ->addColumn('updated', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
      ->create();
  }
}
