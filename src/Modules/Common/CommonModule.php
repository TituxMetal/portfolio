<?php

namespace Portfolio\Modules\Common;

use Portfolio\Core\Modules\Module;

/**
 * Description of CommonModule
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class CommonModule extends Module {
  
  const MIGRATIONS = __DIR__ . '/storage/migrations';
  
  const SEEDS = __DIR__ . '/storage/seeds';
}
