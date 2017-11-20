<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateProjectTable extends AbstractMigration {
  
  public function change() {
    
    $this->table('Project', ['signed' => false])
      ->addColumn('name', 'string', ['limit' => 128])
      ->addColumn('content', 'text', ['limit' => MysqlAdapter::TEXT_LONG])
      ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
      ->addColumn('updated', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
      ->create();
  }
}
