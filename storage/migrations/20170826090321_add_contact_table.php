<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AddContactTable extends AbstractMigration {
  
  public function up() {
    $contact = $this->table('contacts');
    $contact->addColumn('name', 'string', ['limit' => 255])
      ->addColumn('email', 'string', ['limit' => 255])
      ->addColumn('subject', 'string', ['limit' => 255])
      ->addColumn('message', 'text', ['limit' => MysqlAdapter::TEXT_LONG])
      ->addColumn('created', 'timestamp')
      ->save();
  }
  
  public function down() {
    $this->dropTable('contacts');
  }
  
}
