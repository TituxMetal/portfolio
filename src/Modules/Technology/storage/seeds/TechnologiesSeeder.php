<?php

use Phinx\Seed\AbstractSeed;

class TechnologiesSeeder extends AbstractSeed {
  
  public function run() {
    $pData = [];
    $tData = [];
    $faker = Faker\Factory::create('fr_FR');
    
    for ($i = 1; $i <= 100; ++$i) {
      $date = $faker->unixTime('now');
      $pData[] = [
        'uri' => '/assets/img/tech/php_logo.png',
        'title' => $faker->catchPhrase,
        'created' => date('Y-m-d H:i:s', $date),
        'updated' => date('Y-m-d H:i:s', $date)
      ];
      $tData[] = [
        'name' => $faker->catchPhrase,
        'pictureId' => $i,
        'created' => date('Y-m-d H:i:s', $date),
        'updated' => date('Y-m-d H:i:s', $date)
      ];
    }
    
    $this->table('Pictures')
      ->insert($pData)
      ->save();
    
    $this->table('Technologies')
      ->insert($tData)
      ->save();
  }
}
