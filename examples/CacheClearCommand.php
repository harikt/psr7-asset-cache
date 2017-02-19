<?php
namespace Hkt\Psr7AssetCache;

use Hkt\Psr7Asset\Router;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class CacheClearCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('hkt:psr7-asset:cache-clear')
            ->setDescription('Clear psr7-asset cache.')
            ->addArgument('docroot', InputArgument::REQUIRED, 'The docroot of the website.')
            ->setHelp("This command allows you to cache psr7 assets");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Docroot: '.$input->getArgument('docroot'));
    }
}
