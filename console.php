<?php

/*
 * Standalone Console
 *
 */

namespace Trismegiste\Phytostatic;

require_once 'vendor/autoload.php';

use Trismegiste\Phytostatic\Command;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new Command\Generate());
$application->run();
