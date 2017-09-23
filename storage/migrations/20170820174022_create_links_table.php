<?php

use Phinx\Migration\AbstractMigration;

class CreateLinksTable extends AbstractMigration {
  
  public function up() {
    $links = $this->table('links');
    $links->addColumn('href', 'string', ['limit' => 255])
      ->addColumn('title', 'string', ['limit' => 255])
      ->addColumn('label', 'string', ['limit' => 255])
      ->addColumn('created', 'timestamp')
      ->save();
  }
  
  public function down() {
    $this->dropTable('links');
  }
  
}
