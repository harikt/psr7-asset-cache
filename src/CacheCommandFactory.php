<?php
namespace Hkt\Psr7AssetCache;

class CacheCommandFactory
{
    public function __invoke($container)
    {
        return new CacheCommand($container->get('Hkt\Psr7Asset\AssetLocator'));
    }
}
