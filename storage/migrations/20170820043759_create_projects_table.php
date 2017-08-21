<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateProjectsTable extends AbstractMigration {
  
  public function up() {
    $project = $this->table('projects');
    $project->addColumn('name', 'string', ['limit' => 255])
      ->addColumn('description', 'text', ['limit' => MysqlAdapter::TEXT_LONG])
      ->addColumn('created', 'timestamp')
      ->save();
  }
  
  public function down() {
    $this->dropTable('projects');
  }
  
}
