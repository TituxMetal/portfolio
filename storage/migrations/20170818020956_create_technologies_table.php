<?php

use Phinx\Migration\AbstractMigration;

class CreateTechnologiesTable extends AbstractMigration {
  
  public function up() {
    $technologies = $this->table('technologies');
    $technologies->addColumn('title', 'string', ['limit' => 255])
      ->addColumn('created', 'timestamp')
      ->save();
  }
  
  public function down() {
    $this->dropTable('technologies');
  }
  
}
