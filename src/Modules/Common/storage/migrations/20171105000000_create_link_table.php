<?php

use Phinx\Migration\AbstractMigration;

class CreateLinkTable extends AbstractMigration {
  
  public function change() {
    
    $this->table('Link', ['signed' => false])
      ->addColumn('label', 'string', ['limit' => 128])
      ->addColumn('iconClass', 'string', ['limit' => 64])
      ->addColumn('type', 'string', ['limit' => 16])
      ->addColumn('uri', 'string', ['limit' => 128])
      ->addColumn('title', 'string', ['limit' => 128])
      ->create();
  }
}
