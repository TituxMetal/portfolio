<?php

use Phinx\Seed\AbstractSeed;

class TechnologiesSeeder extends AbstractSeed {
  
  public function run() {
    $data = [];
    $faker = Faker\Factory::create('fr_FR');
    
    for ($i = 1; $i <= 100; ++$i) {
      $date = $faker->unixTime('now');
      $data[] = [
        'name' => $faker->catchPhrase,
        'created' => date('Y-m-d H:i:s', $date),
        'updated' => date('Y-m-d H:i:s', $date)
      ];
    }
    
    $this->table('Technologies')
      ->insert($data)
      ->save();
  }
}
