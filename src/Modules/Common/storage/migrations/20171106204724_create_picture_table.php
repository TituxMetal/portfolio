<?php

use Phinx\Migration\AbstractMigration;

class CreatePictureTable extends AbstractMigration {
  
  public function change() {
    $this->table('Pictures')
      ->addColumn('uri', 'string')
      ->addColumn('title', 'string')
      ->addColumn('updated', 'datetime')
      ->addColumn('created', 'datetime')
      ->create();
  }
}
