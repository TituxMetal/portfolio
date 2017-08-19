<?php

use Phinx\Migration\AbstractMigration;

class CreateImagesTable extends AbstractMigration {
  
  public function up() {
    $images = $this->table('images');
    $images->addColumn('alt', 'string', ['limit' => 255])
      ->addColumn('src', 'string', ['limit' => 255])
      ->addColumn('created', 'timestamp')
      ->save();
  }
  
  public function down() {
    $this->dropTable('images');
  }
  
}
