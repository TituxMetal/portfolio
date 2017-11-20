<?php

use Phinx\Migration\AbstractMigration;

class AddPictureToProjectTable extends AbstractMigration {
  
  public function change() {
    
    $this->table('Project')
      ->addColumn('picture', 'integer', ['after' => 'content', 'signed' => false])
      ->addIndex('picture')
      ->addForeignKey('picture', 'Picture', 'id', ['delete' => 'cascade'])
      ->update();
  }
}
