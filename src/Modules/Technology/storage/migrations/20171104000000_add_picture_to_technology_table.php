<?php

use Phinx\Migration\AbstractMigration;

class AddPictureToTechnologyTable extends AbstractMigration {
  
  public function change() {
    $this->table('Technology')
      ->addColumn('picture', 'integer', ['after' => 'name', 'signed' => false])
      ->addIndex('picture')
      ->addForeignKey('picture', 'Picture', 'id', ['delete' => 'cascade'])
      ->update();
  }
}
