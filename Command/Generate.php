<?php

/*
 * Phytostatic
 */

namespace Trismegiste\Phytostatic\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generate generates the site
 */
class Generate extends Command
{

    protected function configure()
    {
        $this
                ->setName('phyto:gene')
                ->setDescription('Make the job !');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo "nothing";
    }

}