<?php

/*
 * Twitwi
 */

namespace Trismegiste\Twitwi\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generate generates the site
 */
class Generate extends Command
{

    protected $twig;

    protected function configure()
    {
        $this
                ->setName('generate')
                ->setDescription('Make the job !');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $templatePath = dirname(__DIR__) . '/Resources/template';
        $loader = new \Twig_Loader_Filesystem($templatePath);
        $this->twig = new \Twig_Environment($loader);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo $this->twig->render('index.html.twig', array('name' => 'Fabien'));
    }

}