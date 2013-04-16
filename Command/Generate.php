<?php

/*
 * Twitwi
 */

namespace Trismegiste\Twitwi\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Generate generates the site
 */
class Generate extends Command
{

    protected $twig;
    protected $appRoot;
    protected $srcDir;

    protected function configure()
    {
        $this
                ->setName('generate')
                ->setDescription('Recursively transforms all *.html.twig from <srcDir> into ./web')
                ->addArgument('srcDir', InputArgument::REQUIRED, 'the source directory for content (*.html.twig)')
                ->setHelp('Uses the Twig engine to transform all files ending by *.html.twig from <srcDir>' . PHP_EOL
                        . 'and puts the resulting html files into ./web. It also does a copy of 3 assets' . PHP_EOL
                        . 'directories from ./Resources/template [img,css,js].' . PHP_EOL);
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->appRoot = dirname(__DIR__);
        $this->srcDir = $input->getArgument('srcDir');
        $templatePath = array(
            $this->srcDir,
            $this->appRoot . '/Resources/template'
        );
        $loader = new \Twig_Loader_Filesystem($templatePath);
        $this->twig = new \Twig_Environment($loader);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $scan = new Finder();
        $fs = new Filesystem();
        $scan->files()->in($this->srcDir)->name('*.html.twig');
        foreach ($scan as $fch) {
            $source = $fch->getRelativePathname();
            $targetDir = $this->appRoot . "/web/" . $fch->getRelativePath();
            $fs->mkdir($targetDir);
            $target = $targetDir . $fch->getBasename('.twig');
            $fs->touch($target);
            file_put_contents($target, $this->twig->render($source));
        }
        // And Now for Something Completely Different
        $baseDir = $this->appRoot . '/Resources/template/';
        $targetDir = $this->appRoot . "/web/";
        foreach (array('css', 'img', 'js') as $asset) {
            $fs->mirror($baseDir . $asset, $targetDir . $asset);
        }
    }

}