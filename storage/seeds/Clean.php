<?php

use Phinx\Seed\AbstractSeed;

/**
 * Clean all the data in the database to avoid duplicate data.
 */
class Clean extends AbstractSeed {
    
  public function run() {
    $this->clearRelatedTable('knowledges');
    $this->clearRelatedTable('technologies');
    $this->clearRelatedTable('projects');
    $this->clearRelatedTable('images');
    $this->clearRelatedTable('links');
  }
  
  private function clearRelatedTable($tableName) {
    $this->execute("DELETE FROM {$tableName}");
    $this->execute("ALTER TABLE {$tableName} AUTO_INCREMENT=0");
  }
  
}
