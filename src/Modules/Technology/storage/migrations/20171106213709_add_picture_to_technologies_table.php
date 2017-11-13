<?php

use Phinx\Migration\AbstractMigration;

class AddPictureToTechnologiesTable extends AbstractMigration {
  
  public function change() {
    $this->table('Technologies')
      ->addColumn('pictureId', 'integer', ['after' => 'name'])
      ->addIndex('pictureId')
      ->addForeignKey('pictureId', 'Pictures', 'id', ['delete' => 'cascade'])
      ->update();
  }
}
