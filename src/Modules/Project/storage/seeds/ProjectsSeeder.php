<?php

use Phinx\Seed\AbstractSeed;

class ProjectsSeeder extends AbstractSeed {
  
  public function run() {
    $projData = [];
    $pictData = [];
    $faker = Faker\Factory::create('fr_FR');
    
    for ($i = 1; $i <= 100; ++$i) {
      $date = $faker->unixTime('now');
      $pictData[] = [
        'uri' => '/assets/img/tech/php_logo.png',
        'title' => $faker->catchPhrase,
        'created' => date('Y-m-d H:i:s', $date),
        'updated' => date('Y-m-d H:i:s', $date)
      ];
      $projData[] = [
        'name' => $faker->catchPhrase,
        'content' => $faker->text,
        'pictureId' => $i,
        'created' => date('Y-m-d H:i:s', $date),
        'updated' => date('Y-m-d H:i:s', $date)
      ];
    }
    
    $this->table('Pictures')
      ->insert($pictData)
      ->save();
    
    $this->table('Projects')
      ->insert($projData)
      ->save();
  }
}
