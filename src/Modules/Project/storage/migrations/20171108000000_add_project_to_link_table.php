<?php

use Phinx\Migration\AbstractMigration;

class AddProjectToLinkTable extends AbstractMigration {
  
  public function change() {
    
    $this->table('Link')
      ->addColumn('project', 'integer', ['after' => 'iconClass', 'signed' => false])
      ->addIndex('project')
      ->addForeignKey('project', 'Project', 'id', ['delete' => 'cascade'])
      ->update();
  }
}
