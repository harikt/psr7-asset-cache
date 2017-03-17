<?php
namespace Hkt\Psr7AssetCache;

use Hkt\Psr7Asset\AssetLocator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

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
        $publicFolder = realpath($input->getArgument('docroot'));

        if (! $publicFolder) {
            $output->writeln("Cannot understand the path");
            return;
        }

        $assetFolder = $publicFolder . DIRECTORY_SEPARATOR . 'asset' . DIRECTORY_SEPARATOR;

        $assets = [];

        foreach ($this->assetLocator->getIterator() as $key => $value ) {
            $assets = array_merge($assets, $this->getAssets($key, $value));
        }

        foreach($assets as $map => $file) {
            $destination = $assetFolder . DIRECTORY_SEPARATOR . $map;
            if (! is_dir(dirname($destination))) {
                mkdir(dirname($destination), 0755, true);
            }
            copy($file, $assetFolder . $map);
        }
    }

    protected function getAssets($key, $value)
    {
        $assets = [];

        if (is_dir($value)) {
            $directory = new RecursiveDirectoryIterator($value, FilesystemIterator::SKIP_DOTS);
            $iterator = new RecursiveIteratorIterator($directory);
            foreach ($iterator as $info) {
                $map = str_replace($value, '', $info->getPathname());
                $assets[$key . $map] = $info->getPathname();
            }
        }

        if (is_file($value)) {
            $assets[$key] = $value;
        }

        return $assets;
    }
}
