<?php

use Phinx\Migration\AbstractMigration;

class CreatePictureTable extends AbstractMigration {
  
  public function change() {
    $this->table('Pictures')
      ->addColumn('uri', 'string')
      ->addColumn('title', 'string')
      ->addColumn('created', 'datetime')
      ->addColumn('updated', 'datetime')
      ->create();
  }
}
