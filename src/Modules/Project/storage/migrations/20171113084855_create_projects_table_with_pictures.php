<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateProjectsTableWithPictures extends AbstractMigration {
  
  public function change() {
    
    $this->table('Projects', ['signed' => false])
      ->addColumn('name', 'string', ['limit' => 128])
      ->addColumn('content', 'text', ['limit' => MysqlAdapter::TEXT_LONG])
      ->addColumn('pictureId', 'integer')
      ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
      ->addColumn('updated', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
      ->addIndex('pictureId')
      ->addForeignKey('pictureId', 'Pictures', 'id', ['delete' => 'cascade'])
      ->create();
  }
}
