<?php
namespace Hkt\Psr7AssetCache;

use Hkt\Psr7Asset\AssetLocator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class CacheCommand extends Command
{
    protected $assetLocator;

    public function __construct(AssetLocator $assetLocator)
    {
        $this->assetLocator = $assetLocator;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('hkt:psr7-asset:cache')
            ->setDescription('Cache psr7-assets.')
            ->addArgument('docroot', InputArgument::REQUIRED, 'The docroot of the website.')
            ->setHelp("This command allows you to cache psr7 assets");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Docroot: '.$input->getArgument('docroot'));

        foreach ($this->assetLocator->getIterator() as $key => $value ) {
            echo "$key $value " . PHP_EOL;
        }
    }
}
