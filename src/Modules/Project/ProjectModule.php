<?php

namespace Portfolio\Modules\Project;

use Portfolio\Core\Modules\Module;

/**
 * Description of ProjectModule
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class ProjectModule extends Module {
  
  const DEFINITIONS = __DIR__ . '/config.php';
  
  const MIGRATIONS = __DIR__ . '/storage/migrations';
  
  const SEEDS = __DIR__ . '/storage/seeds';
}
