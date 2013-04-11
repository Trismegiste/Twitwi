<?php

/*
 * Standalone Console
 *
 */

namespace Trismegiste\Twitwi;

require_once 'vendor/autoload.php';

use Trismegiste\Twitwi\Command\Generate;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new Generate());
$application->run();
