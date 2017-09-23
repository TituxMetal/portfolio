<?php

use Phinx\Migration\AbstractMigration;

class AddImagesRelationToTechnologiesTable extends AbstractMigration {
  
  public function up() {
    $technologies = $this->table('technologies');
    $technologies->addColumn('image', 'integer', ['after' => 'title'])
      ->addIndex('image')
      ->addForeignKey('image', 'images', 'id')
      ->save();
  }
  
  public function down() {
    $this->table('technologies')
      ->dropForeignKey('image')
      ->removeIndex('image')
      ->removeColumn('image')
      ->save();
  }
  
}
