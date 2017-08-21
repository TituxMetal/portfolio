<?php

use Phinx\Migration\AbstractMigration;

class AddLinksRelationToProjectsTable extends AbstractMigration {
  
  public function up() {
    $projects = $this->table('projects');
    $projects->addColumn('sources_link', 'integer', ['after' => 'image'])
      ->addColumn('main_link', 'integer', ['after' => 'image'])
      ->addIndex('sources_link')
      ->addIndex('main_link')
      ->addForeignKey('sources_link', 'links', 'id')
      ->addForeignKey('main_link', 'links', 'id')
      ->save();
  }
  
  public function down() {
    $this->table('projects')
      ->dropForeignKey('sources_link')
      ->removeIndex('sources_link')
      ->removeColumn('sources_link')
      ->dropForeignKey('main_link')
      ->removeIndex('main_link')
      ->removeColumn('main_link')
      ->save();
  }
  
}
