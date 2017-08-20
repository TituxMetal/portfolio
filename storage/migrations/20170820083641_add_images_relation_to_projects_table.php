<?php

use Phinx\Migration\AbstractMigration;

class AddImagesRelationToProjectsTable extends AbstractMigration {
  
  public function up() {
    $projects = $this->table('projects');
    $projects->addColumn('image', 'integer', ['after' => 'description'])
      ->addIndex('image')
      ->addForeignKey('image', 'images', 'id')
      ->save();
  }
  
  public function down() {
    $this->table('projects')
      ->dropForeignKey('image')
      ->removeIndex('image')
      ->removeColumn('image')
      ->save();
  }
  
}
