<?php

/*
 * Standalone Console
 *
 */

namespace Trismegiste\Phytostatic;

require_once 'vendor/autoload.php';

use Trismegiste\Phytostatic\Command\Generate;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new Generate());
$application->run();
