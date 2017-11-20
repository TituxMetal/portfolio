<?php

use Phinx\Migration\AbstractMigration;

class CreatePictureTable extends AbstractMigration {
  
  public function change() {
    $this->table('Picture', ['signed' => false])
      ->addColumn('uri', 'string', ['limit' => 128])
      ->addColumn('title', 'string', ['limit' => 128])
      ->create();
  }
}
