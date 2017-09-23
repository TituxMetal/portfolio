<?php

use Phinx\Migration\AbstractMigration;

class CreateKnowledgesTable extends AbstractMigration {
  
  public function up() {
    $knowledges = $this->table('knowledges');
    $knowledges->addColumn('title', 'string', ['limit' => 255])
      ->addColumn('created', 'timestamp')
      ->save();
  }
  
  public function down() {
    $this->dropTable('knowledges');
  }
  
}
